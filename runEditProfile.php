<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// SQL to update a record
$sql = "UPDATE student SET name='" . $_POST["name"] . "', password='" . $_POST["password"] . "', confirmPassword='" . $_POST["confirmPassword"] . "' WHERE email='" . $_SESSION["email"] . "'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
