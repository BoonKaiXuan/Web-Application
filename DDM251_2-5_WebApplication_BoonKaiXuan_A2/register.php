<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tealive New Product Launch</title>

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
        <h1>Seek, Sip & Win Big!</h1>
        <p>Register to find our hidden new drink to snag the BIG prize! Missed it? Don’t worry, you still walk away with a sweet treat.</p>

        <div>
            <form taget="_self" method="POST">

                <!--         <div class="error-msg">
                    <?php
                    echo $error_message;
                    ?>
                </div> -->
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
                    <input type="submit" value="Create an Account">
                </div>

            </form>
            <a href="login.php">
                Already a Tealive App user? Sign in here.
            </a>
        </div>

    </div>

</body>

</html>