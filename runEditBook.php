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


$title = $_POST["title"];
$author = $_POST["author"];
$description = $_POST["description"];
$price = $_POST["price"];
$isbn = $_POST["isbn"];

// SQL to update a record
$sql = "UPDATE booklist SET title='$title', author='$author', description='$description', price='$price' WHERE ISBN='$isbn'";


if (mysqli_query($conn, $sql)) {
    header("Location:booklist.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
