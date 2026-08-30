<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fName = $_POST['firstName'];
$lName = $_POST['lastName'];
$cusEmail = strtolower($_POST['email']);
$cusNo = $_POST['contactNo'];
$cusPassW = $_POST['password'];
$confirmPassW = $_POST['confirmPassword'];

//---All fields empty
if (empty($fName) || empty($lName) || empty($cusEmail) || empty($cusNo) || empty($cusPassW)) {
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
} else {

    //---check if email alr exists
    $checkEmailSQL = "SELECT email FROM customers WHERE email = '$cusEmail'";

    $result = $conn->query($checkEmailSQL);

    if ($result->num_rows > 0) {
        $error_message = 'This email has been registered. Please sign in instead.';
        header("Location:register.php?error_message=" . $error_message);
    } else {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        $uid = date('YmdHis') . "_" . $code;

        //---register customers
        $insertSQL = "INSERT INTO customers (customerID, firstName, lastName, email, contactNo, password)
VALUES ('$uid', '$fName', '$lName', '$cusEmail', '$cusNo', '$cusPassW')";

        if ($conn->query($insertSQL) === TRUE) {
            $_SESSION['customerID'] = $uid;
            header("Location:survey.php");
        } else {
            $error_message = 'Registration failed. Please try again.';
            header("Location:register.php?error_message=" . $error_message);
        }
    }
}
mysqli_close($conn);
