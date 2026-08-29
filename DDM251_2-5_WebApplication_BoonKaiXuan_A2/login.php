<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();

if (isset($_POST["email"]) && ($_POST["password"])) {
    $cusEmail = $_POST["email"];
    $cusPassword = $_POST["password"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Execute sql query
    $sql = "SELECT * FROM customers WHERE email = '$cusEmail' AND password = '$cusPassword'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $_SESSION['email'] = $_POST['email'];
        header("Location:survey.php");
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
    <title>Login - Tealive New Product Launch</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body class="bg-dark-purple">
    <div class="max-width">
        <header>
            <h1>Welcome Back!</h1>
            <p>Seek, Sip & Win Big! Sign in to explore our new product and claim your rewards!</p>
        </header>

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
                        <input class="btn btn-yellow" type="submit" value="Sign In">
                    </div>

            </form>
            <a href="register.php">
                Don't Have An Account? Sign Up Here!
            </a>
        </div>
    </div>
</body>

</html>