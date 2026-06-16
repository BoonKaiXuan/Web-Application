<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$error_message = "";
$keep_username = "";

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
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM customers WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
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
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        box-sizing: border-box;
    }

    body {
        margin: 60px;
        font-family: "Poppins", sans-serif;
        font-size: 16px;
        font-weight: 300;
        background-color: #FCF5EE;
    }

    #login {
        background-color: #FFEF9F;
        max-width: 500px;
        margin: auto;
        padding: 40px;
        border-radius: 20px;
    }

    form {
        margin: auto;
    }

    h1 {
        color: #E13F7C;
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

    .btn {
        background-color: #E13F7C;
        border: none;
        padding: 15px 40px;
        font-size: 16px;
        font-weight: 600;
        color: #FFEF9F;
        border-radius: 10px;
        width: 100%;
        margin: 10px 0px;
        cursor: pointer;
    }

    .error-msg {
        padding-bottom: 30px;
        color: #ff285a;
        font-weight: 600;
    }

    .error-msg:blank {
        display: none;
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
                <input class="btn" type="submit" value="Sign In">
            </div>

        </form>
    </div>
</body>

</html>