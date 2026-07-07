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

$name = $_POST["name"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$yearjoin = $_POST["yearjoin"];

$error_message = "";

//no need update confirmPassword cuz backend doesnt hv this, it's only for checking
// SQL to update a record

if (empty($password) || empty($confirmPassword) || empty($name) || empty($yearjoin)) {
    $error_message = 'Please fill in all the fields.';
    header("Location:editProfile.php?error_message=" . $error_message);

    //go back to editProfile pg, error_message is the var name, and we glue the message to it, so when in editProfile, we can use $_GET to get the message

} else if ($password !== $confirmPassword) {
    $error_message = 'Passwords do not match.';
    header("Location:editProfile.php?error_message=" . $error_message);
} else if ($yearjoin > date("Y")) {
    $error_message = 'Year of joining cannot be in the future.';
    header("Location:editProfile.php?error_message=" . $error_message);
} else {
    $sql = "UPDATE student SET password='$password', name='$name', yearjoin='$yearjoin' WHERE email='" . $_SESSION["email"] . "'";

    if (mysqli_query($conn, $sql)) {
        header("Location:profile.php");
    }
}



mysqli_close($conn);
