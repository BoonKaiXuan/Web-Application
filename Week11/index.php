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

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["age"])) {
    // Get user input from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    /* -1: becuz 1st char pos is 0, if last char pos is 61  & without -1, php could choose pos 62 which X exist*/
    for ($i = 0; $i < 6; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    $uid = date('YmdHis') . "_" . $code;
    $sql = "INSERT INTO game (name, email, age, UID) VALUES ('$name', '$email', '$age', '$uid')";


    if ($conn->query($sql) === TRUE) {
        //$_SESSION['email'] = $email;
        $_SESSION['UID'] = $uid;
        header("Location:game.php");
    } else {
        echo "User Not Found";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week11 - Registration</title>
</head>

<body>
    <div>
        <form target="_self" method="POST">
            <h2>Name:</h2>
            <input type="text" name="name">
            <br>
            <h2>Email:</h2>
            <input type="text" name="email">
            <br>
            <h2>Age</h2>
            <input type="number" name="age">
            <br>
            <br>
            <input type="submit">
        </form>
    </div>


</body>

</html>