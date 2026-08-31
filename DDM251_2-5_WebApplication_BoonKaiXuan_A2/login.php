<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cusEmail = $_POST["email"];
    $cusPassword = $_POST["password"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (empty($cusEmail) || empty($cusPassword)) {
        $error_message = "*Please enter your Email and Password.";
    } else {

        //Execute sql query
        $sql = "SELECT * FROM customers WHERE email = '$cusEmail' AND password = '$cusPassword'";

        $result = $conn->query($sql);
        $customer = $result->fetch_assoc();

        if ($result->num_rows > 0) {

            $_SESSION['customerID'] = $customer['customerID'];

            if (empty($customer["drinkRecommend"])) {
                header("Location: survey.php");
            } else {
                header("Location: profile.php");
            }
        } else {
            $error_message = "*User not found. Please sign up.";
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
    <title>Login - Tealive New Product Launch</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body class="bg-dark-purple bg-cup">
    <div class="max-width">
        <header class="txt-center">
            <h1 class="color-yellow">Welcome Back!</h1>
            <p>Seek, Sip & Win Big! Sign in to explore our new product and claim your rewards!</p>
        </header>

        <div>
            <form taget="_self" method="POST">

                <div class="login_info">

                    <?php if (!empty($error_message)) { ?>
                        <div class="error-msg">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php } ?>

                    <div class="row-flex direct-col">
                        <label name="email">Email:</label>
                        <input class="form" type="text" name="email">
                    </div>

                    <div class="row-flex direct-col margin-btm">
                        <label name="password">Password:</label>
                        <input class="form" type="password" name="password">
                    </div>

                    <div>
                        <button class="btn btn-yellow full-width" type="submit">Go!</button>
                    </div>
                    <a class="txt-center" href="register.php">
                        Don't Have An Account? Sign Up Here!
                    </a>
                </div>
            </form>

        </div>
    </div>
    <img class="footer-img" src="img/Tealive_logo.svg" alt="Tealive Logo" width="100%">
</body>

</html>