<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$customerID = $_GET['customerID'];

$sql = "DELETE FROM customers WHERE customerID='$customerID'";

if ($conn->query($sql) === TRUE) {

    header("Location:customer.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
