<?php
$servername = "localhost";
$username = "event_booking";
$password = "ouB]8YU4L/yrWL@S";
$dbname = "event_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$userID = $_SESSION["userID"];
$slotID = $_GET['slotID'];

//Check if the user has already booked the slot or if the capacity is full
$checkQuery = "
    SELECT 
        (SELECT COUNT(*) FROM booking WHERE userID = ? AND slotID = ?) AS alreadyBooked,
        (SELECT capacity FROM event_slots WHERE slotID = ?) AS currentCapacity";
$checkResult = $conn->execute_query($checkQuery, [$userID, $slotID, $slotID]);
$status = $checkResult->fetch_assoc();

//Validate both conditions
if ($status['alreadyBooked'] > 0) {
    $error_message = "You have already booked this slot!";
    header("Location:booking.php?error_message=" . $error_message);
} else if ($status['currentCapacity'] === null) {
    $error_message = "Event slot does not exist.";
    header("Location:booking.php?error_message=" . $error_message);
} else if ($status['currentCapacity'] <= 0) {
    $error_message = "Sorry, this slot is fully booked!";
    header("Location:booking.php?error_message=" . $error_message);
} else {
    //after both conditions are validated, proceed to book the slot
    $conn->begin_transaction();
    try {
        // Deduct 1 from capacity
        $updateQuery = "UPDATE event_slots SET capacity = capacity - 1 WHERE slotID = ?";
        $conn->execute_query($updateQuery, [$slotID]);

        // Insert booking
        $insertQuery = "INSERT INTO booking (userID, slotID) VALUES (?, ?)";
        $conn->execute_query($insertQuery, [$userID, $slotID]);

        $conn->commit();
        header("Location: profile.php");
    } catch (Exception $e) {
        $conn->rollback();
        $error_message = "Booking failed due to a system error. Please try again.";
        header("Location:booking.php?error_message=" . $error_message);
    }
}
