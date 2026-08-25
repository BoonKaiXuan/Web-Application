<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$error_message = "";
$keep_username = "";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($_POST['username'])) {
        $keep_username = htmlspecialchars($_POST['username']);
    }

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error_message = "*Please enter your Username and Password.";
    } else {
        $user_name = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM customers WHERE username='$user_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
                $_SESSION["customerID"] = $user["customerID"];
                header("Location:welcome.php");
            } else {
                $error_message = "*Invalid password. Please try again.";
            }
        } else {
            $error_message = "*Invalid username. Please try again.";
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
    <title>Welcome to Alice's Shop - Sign In</title>
    <link rel="stylesheet" href="css/common.css">
</head>
<style>
    body {
        margin: 60px;
    }

    #login {
        background-color: #FFEF9F;
        max-width: 500px;
        margin: auto;
        padding: 40px;
        border-radius: 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 50px;
    }

    .login_info {
        margin-bottom: 40px;
    }

    .login_info>div {
        display: flex;
        gap: 20px;
        padding: 10px 0;
        align-items: center;
    }

    .login_info>div label {
        width: 30%;
        font-size: 18px;
        font-weight: 600;
    }

    .login_info>div input {
        width: 65%;
        height: 40px;
        background-color: #ffffffc7;
        border-radius: 8px;
        border: none;
        padding: 0px 10px;
    }

    .login_info>div input:focus {
        outline: none;
    }
</style>

<body>
    <div class="header">
        <h1>Welcome to Alice's Shop</h1>
        <p>
            Please sign in to continue shopping with us!
        </p>
    </div>

    <div id="login">
        <form taget="_self" method="POST">
            <div class="error-msg">
                <?php
                echo $error_message;
                ?>
            </div>
            <div class="login_info">
                <div>
                    <label>Username:</label>
                    <input type="text" name="username" value="<?php echo $keep_username; ?>">
                </div>

                <div>
                    <label>Password:</label>
                    <input type="password" name="password">
                </div>
            </div>

            <div>
                <input class="btn fullwidth" type="submit" value="Sign In">
            </div>

        </form>
    </div>
</body>

</html>