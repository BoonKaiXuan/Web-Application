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

$cusID = $_POST['customerID'];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$phone = $_POST["customerPhoneNo"];

if (empty($firstName) || empty($lastName) || empty($password) || empty($confirmPassword) || empty($phone)) {
    $empty = '*Please fill in all the fields.';
    header("Location:editCustomer.php?customerID=$cusID&empty=" . $empty);
} else if ($password !== $confirmPassword) {
    $confirmPW = '*Passwords do not match.';
    header("Location:editCustomer.php?customerID=$cusID&confirmPW=" . $confirmPW);
} else if (strlen($password) < 6) {
    $errorPW = '*Password must be at least 6 characters long.';
    header("Location:editCustomer.php?customerID=$cusID&errorPW=" . $errorPW);
} else {

    $sql = "UPDATE customers SET firstName='$firstName', lastName='$lastName', password='$password', customerPhoneNo='$phone' WHERE customerID='$cusID'";

    if (mysqli_query($conn, $sql)) {
        header("Location:customer.php");
    }
}

mysqli_close($conn);
