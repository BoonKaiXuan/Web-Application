<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tealive New Product Launch</title>
    <link rel="stylesheet" href="css/common.css">

</head>

<body class="bg-dark-purple">
    <div class="max-width">

        <header>
            <h1>Seek, Sip & Win Big!</h1>
            <p>Register to find our hidden new drink to snag the BIG prize! Missed it? Don’t worry, you still walk away with a sweet treat.</p>
        </header>
        <?php
        echo $error_message;
        ?>
        <div>
            <form action="runRegister.php" method="POST">
                <div>
                    <?php
                    if (isset($_GET['error_message'])) {
                        $error_message = $_GET['error_message'];
                        echo "<p style='color:red;'>$error_message</p>";
                    }
                    ?>
                </div>

                <div class="register_info">
                    <div>
                        <label>First Name:</label>
                        <input type="text" name="firstName">
                    </div>

                    <div>
                        <label>Last Name:</label>
                        <input type="text" name="lastName">
                    </div>

                    <div>
                        <label>Email:</label>
                        <input type="text" name="email">
                    </div>

                    <div>
                        <label>Contact No.:</label>
                        <input type="text" name="contactNo">
                    </div>

                    <div>
                        <label>Password:</label>
                        <input type="password" name="password">
                    </div>

                    <div>
                        <label>Confirm Password:</label>
                        <input type="password" name="confirmPassword">
                    </div>
                </div>

                <div>
                    <input class="btn btn-yellow" type="submit" value="Create an Account">
                </div>

            </form>
            <div>
                <a href="login.php">
                    Already Have An Account? Sign In Here.
                </a>
            </div>

        </div>
    </div>
</body>

</html>