<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = "";
$fName = "";
$lName = "";
$cusEmail = "";
$cusNo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $cusEmail = strtolower($_POST['email']);
    $cusNo = $_POST['contactNo'];
    $cusPassW = $_POST['password'];
    $confirmPassW = $_POST['confirmPassword'];

    //---All fields empty
    if (empty($fName) || empty($lName) || empty($cusEmail) || empty($cusNo) || empty($cusPassW)) {
        $error_message = 'Please fill in all the fields.';

        //---Email format
    } else if (!filter_var($cusEmail, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address (e.g. name@example.com).';

        //---Phone No format & length
    } else if (!is_numeric($cusNo) || strlen($cusNo) != 10) {
        $error_message = 'Please enter a valid contact number (10 digits).';

        //---Password length
    } else if (strlen($cusPassW) < 8) {
        $error_message = 'Password must be at least 8 characters long.';
        //---confirm Password
    } else if ($confirmPassW !== $cusPassW) {
        $error_message = 'Password does not match.';
    } else {

        //---check if email alr exists
        $checkEmailSQL = "SELECT email FROM customers WHERE email = '$cusEmail'";

        $result = $conn->query($checkEmailSQL);

        if ($result->num_rows > 0) {
            $error_message = 'This email has been registered. Please sign in instead.';
        } else {
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = '';

            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            $uid = date('YmdHis') . "_" . $code;

            //---register customers
            $insertSQL = "INSERT INTO customers (customerID, firstName, lastName, email, contactNo, password)
VALUES ('$uid', '$fName', '$lName', '$cusEmail', '$cusNo', '$cusPassW')";

            if ($conn->query($insertSQL) === TRUE) {
                $_SESSION['customerID'] = $uid;
                header("Location:survey.php");
            } else {
                $error_message = 'Registration failed. Please try again.';
                header("Location:register.php");
            }
        }
    }
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tealive New Product Launch 2026</title>
    <link rel="stylesheet" href="css/common.css">
    <style>
        .register-info {
            margin: 40px 0;
        }

        .footer-img {
            margin-top: 20px;
            position: fixed;
        }

        body {
            margin-top: 50px 0 0 0;
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
            <form action="register.php" method="POST">

                <?php if (!empty($error_message)) { ?>
                    <div class="error-msg">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php } ?>


                <div class="register-info">
                    <div class="row-flex direct-col">
                        <label for="firstName">*First Name:</label>
                        <input class="form" type="text" name="firstName" id="firstName" placeholder="Please enter your First Name" value="<?php echo htmlspecialchars($fName); ?>">
                    </div>

                    <div class="row-flex direct-col">
                        <label for="lastName">*Last Name:</label>
                        <input class="form" type="text" name="lastName" id="lastName" placeholder="Please enter your Last Name" value="<?php echo htmlspecialchars($lName); ?>">
                    </div>

                    <div class="row-flex direct-col">
                        <label for="email">*Email:</label>
                        <input class="form" type="text" name="email" id="email" placeholder="e.g. example@gmail.com" value="<?php echo htmlspecialchars($cusEmail); ?>">
                    </div>

                    <div class="row-flex direct-col">
                        <label for="contactNo">*Contact No.:</label>
                        <input class="form" type="text" name="contactNo" id="contactNo" placeholder="e.g. 0123456789" value="<?php echo htmlspecialchars($cusNo); ?>">
                    </div>

                    <div class="row-flex direct-col">
                        <label for="password">*Password:</label>
                        <input class="form" type="password" name="password" id="password" placeholder="Minimum 8 characters">
                    </div>

                    <div class="row-flex direct-col">
                        <label for="confirmPassword">*Confirm Password:</label>
                        <input class="form" type="password" name="confirmPassword" id="confirmPassword">
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
    <img class="footer-img" src="img/Tealive_logo.svg" alt="Tealive Logo" width="100%">
</body>

</html>