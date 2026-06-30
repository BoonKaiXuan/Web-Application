<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST["customerID"];
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["customerEmail"];
    $password = $_POST["password"];
    $phone = $_POST["customerPhoneNo"];

    $sql = "INSERT INTO customers (customerID, username, firstName, lastName, customerEmail, password, customerPhoneNo)
VALUES ('$customerID', '$username', '$firstName', '$lastName', '$email', '$password', '$phone')";

    if (mysqli_query($conn, $sql)) {
        header("Location:customer.php");
    }
}
mysqli_close($conn);
