<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
//$email = $_SESSION['email'];
if (isset($_SESSION['UID'])) {
    $uid = $_SESSION['UID'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week11 - Games</title>
</head>

<body>
    <div>
        <h2>Game 1</h2>
        <a href="game1.php">Play Game 1</a>
        <br>
        <h2>Game 2</h2>
        <a href="game2.php">Play Game 2</a>
        <br>
        <h2>Game 3</h2>
        <a href="game3.php">Play Game 3</a>
    </div>
</body>

</html>