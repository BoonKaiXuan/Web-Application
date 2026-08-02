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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Event Booking</title>
    <style>
        * {
            text-decoration: none;
        }

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>My Profile</h1>
    <table>
        <tr>
            <th width="100">User ID</th>
            <th width="150">First Name</th>
            <th width="150">Last Name</th>
            <th width="300">Email</th>
        </tr>

        <?php
        $query = "SELECT * FROM customers WHERE userID='$userID'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['userID']; ?></td>
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['lastName']; ?></td>
                <td><?php echo $row['email']; ?></td>
            </tr>

        <?php
        }
        ?>
    </table>

    <!-- Booking -->
    <h2>My Bookings</h2>
    <table>
        <tr>
            <th width="100">Booking ID</th>
            <th width="100">Event Date</th>
            <th width="100">Event ID</th>
            <th width="200">Event Name</th>
        </tr>

        <?php
        // JOIN booking and event_slots
        $bookingQuery = "
            SELECT b.bookingID, e.eventDate, b.slotID, e.eventName FROM booking b
            JOIN event_slots e ON b.slotID = e.slotID
            WHERE b.userID = ?";

        $bookingResult = $conn->execute_query($bookingQuery, [$userID]);

        if ($bookingResult->num_rows > 0) {
            while ($booking = $bookingResult->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $booking['bookingID']; ?></td>
                    <td><?php echo $booking['eventDate']; ?></td>
                    <td><?php echo $booking['slotID']; ?></td>
                    <td><?php echo $booking['eventName']; ?></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4'>No bookings found.</td></tr>";
        }

        $conn->close();
        ?>

    </table>
    <br>
    <a href="booking.php"><button>Continue Booking</button></a>
</body>

</html>