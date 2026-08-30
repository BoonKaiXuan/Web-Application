<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tealive New Product Launch</title>
    <link rel="stylesheet" href="css/common.css">
    <style>
        .register-info {
            margin: 40px 0;
        }
    </style>
</head>

<body class="bg-dark-purple">
    <div class="max-width">

        <header>
            <h1 class="color-yellow">Seek, Sip & Win Big!</h1>
            <p>Register to find our hidden new drink to snag the BIG prize! Missed it? Don’t worry, you still walk away with a sweet treat.</p>
        </header>

        <div>
            <form action="runRegister.php" method="POST">

                <?php if (!empty($error_message)) { ?>
                    <div class="error-msg">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php } ?>


                <div class="register-info">
                    <div class="row-flex direct-col">
                        <label>*First Name:</label>
                        <input class="form" type="text" name="firstName">
                    </div>

                    <div class="row-flex direct-col">
                        <label>*Last Name:</label>
                        <input class="form" type="text" name="lastName">
                    </div>

                    <div class="row-flex direct-col">
                        <label>*Email:</label>
                        <input class="form" type="text" name="email">
                    </div>

                    <div class="row-flex direct-col">
                        <label>*Contact No.:</label>
                        <input class="form" type="text" name="contactNo">
                    </div>

                    <div class="row-flex direct-col">
                        <label>*Password:</label>
                        <input class="form" type="password" name="password">
                    </div>

                    <div class="row-flex direct-col">
                        <label>*Confirm Password:</label>
                        <input class="form" type="password" name="confirmPassword">
                    </div>
                </div>

                <div>
                    <button class="btn btn-yellow full-width" type="submit">Create an Account</button>
                </div>

            </form>
            <a class="txt-center" href="login.php">
                Already Have An Account? Sign In Here.
            </a>

        </div>
    </div>
</body>

</html>