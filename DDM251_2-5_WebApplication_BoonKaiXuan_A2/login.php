<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();


if (isset($_SESSION["email"])) {

    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tealive New Product Launch</title>

    <style>
        * {
            font-size: 16px;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>

</head>

<body>

    <div>
        <h1>Welcome Back!</h1>
        <p>Seek, Sip & Win Big! Sign in to explore our new product and claim your rewards!</p>

        <div>
            <form taget="_self" method="POST">

                <!--         <div class="error-msg">
                    <?php
                    echo $error_message;
                    ?>
                </div> -->
                <div class="login_info">

                    <div>
                        <label>Email:</label>
                        <input type="text" name="email">
                    </div>

                    <div>
                        <label>Password:</label>
                        <input type="password" name="password">

                    </div>

                    <div>
                        <a href="index.php">
                            <input type="submit" value="Sign In">
                        </a>
                    </div>

            </form>
            <a href="register.php">
                Don't have an account? Sign up here!
            </a>
        </div>

    </div>

</body>

</html>