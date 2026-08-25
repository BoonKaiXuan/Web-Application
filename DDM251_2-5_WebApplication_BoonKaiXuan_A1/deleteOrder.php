<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderID = $_GET['orderID'];

$sql1 = "DELETE FROM orderdetails WHERE orderID='$orderID'";
mysqli_query($conn, $sql1);

$sql2 = "DELETE FROM orders WHERE orderID='$orderID'";
mysqli_query($conn, $sql2);

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    header("Location:order.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
