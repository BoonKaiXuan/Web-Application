<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* automatically assign a cusID */
$fName = $_POST['firstName'];
$lName = $_POST['lastName'];
$cusEmail = strtolower($_POST['email']);
$cusNo = $_POST['contactNo'];
$cusPassW = $_POST['password'];
$confirmPassW = $_POST['confirmPassW'];

//---All fields empty
if (empty($fName) || empty($lName) || empty($cusEmail) || empty($cusNo) || empty($cusPassW) || empty($confirmPassW)) {
    $error_message = 'Please fill in all the fields.';
    header("Location:register.php?error_message=" . $error_message);

    //---Email format
} else if (!filter_var($cusEmail, FILTER_VALIDATE_EMAIL)) {
    $error_message = 'Please enter a valid email address (e.g. name@example.com).';
    header("Location:register.php?error_message=" . $error_message);

    //---Phone No format
} else if (!is_numeric($cusNo)) {
    $error_message = 'Please enter a valid contact number.';
    header("Location:register.php?error_message=" . $error_message);

    //---Password length
} else if (strlen($cusPassW) < 8) {
    $error_message = 'Password must be at least 8 characters long.';
    header("Location:register.php?error_message=" . $error_message);

    //---confirm Password
} else if ($confirmPassW !== $cusPassW) {
    $error_message = 'Password does not match.';
    header("Location:register.php?error_message=" . $error_message);
}

//---check if email alr exists
$checkEmailSQL = "SELECT cusID FROM customers WHERE email = '$cusEmail'";

$result = $conn->query($checkEmailSQL);

if ($result->num_rows > 0) {
    $error_message = 'This email has been registered. Please sign in instead.';
    header("Location:register.php?error_message=" . $error_message);
}

//---register customers
$insertSQL = "INSERT INTO customers (firstName, lastName, email, contactNo, password)
VALUES ('$fName', '$lName', '$cusEmail', '$cusNo', '$cusPassW')";



mysqli_close($conn);
