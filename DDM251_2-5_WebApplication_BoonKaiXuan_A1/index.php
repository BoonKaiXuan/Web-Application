<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

//$error_message = "";
$keep_username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['username'])) {
        $keep_username = htmlspecialchars($_POST['username']);
    }

    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "*Please enter your username and password.";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM customers WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
                header("Location:welcome.php");
            } else {
                echo "*Invalid password. Please try again.";
            }
        } else {
            echo "*Invalid username. Please try again.";
        }
    }

    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Alice Shop - Sign In</title>
</head>

<body>
    <div>
        <h1>Welcome to Alice Shop</h1>
        <p>
            Please sign in to continue shopping with us!
        </p>
    </div>

    <div id="login">
        <form taget="_self" method="POST">

            <div>
                <h2>Username:</h2>
                <input type="text" name="username">
            </div>

            <div>
                <h2>Password:</h2>
                <input type="password" name="password">
            </div>

            <div>
                <input type="submit" value="Sign In">
            </div>

        </form>
    </div>
</body>

</html>