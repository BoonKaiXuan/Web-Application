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

$isbn = $_POST["ISBN"];
$title = $_POST["title"];
$author = $_POST["author"];
$description = $_POST["description"];
$price = $_POST["price"];

$sql = "INSERT INTO booklist (ISBN, title, author, description, price)
VALUES ('$isbn', '$title', '$author', '$description', '$price')";

if (empty($isbn) || empty($title) || empty($author) || empty($description) || empty($price)) {
    $error_message = 'Please fill in all the fields.';
    header("Location:addBook.php?error_message=" . $error_message);
} else if (strlen($isbn) < 13) {
    $error_message = 'ISBN must be at least 13 characters long.';
    header("Location:addBook.php?error_message=" . $error_message);
} else if (!is_numeric($isbn)) {
    $error_message = 'ISBN must be numeric.';
    header("Location:addBook.php?error_message=" . $error_message);
} else if (!is_numeric($price)) {
    $error_message = 'Price must be numeric.';
    header("Location:addBook.php?error_message=" . $error_message);
} else if (mysqli_query($conn, $sql)) {
    header("Location:booklist.php");
}

mysqli_close($conn);
