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
$prodID = $_GET['prodID'];

$sql = "DELETE FROM products WHERE prodID='$prodID'";

if ($conn->query($sql) === TRUE) {
    header("Location:products.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
