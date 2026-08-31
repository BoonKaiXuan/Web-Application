<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();
$cusID = $_SESSION['customerID'];
$prizeType = $_POST['prizeType'];
$prizeStatus = "";
$awardedDate = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "UPDATE customers SET prizeType = '$prizeType', prizeStatus = 'awarded', awardedDate = NOW() WHERE customerID = '$cusID' AND prizeType IS NULL";

    $conn->query($sql);

    if ($conn->affected_rows === 1) {
        header("Location: profile.php");
        exit;
    } else {
        echo "You have already claimed a prize";
    }
}
