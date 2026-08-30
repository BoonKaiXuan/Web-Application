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
    <title>Welcome - Tealive New Product Launch</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body class="bg-dark-purple">
    <div class="max-width">
        <header>
            <h1>
                Seek, Sip & Win Big!
            </h1>
            <h3>
                Welcome to Tealive New Product Launch.
            </h3>
            <p>
                Discover your perfect Tealive drink, hunt for our hidden new product, and stand a chance to win exciting rewards!
            </p>
        </header>

        <!-- CTA buttons -->
        <div>
            <a class="btn btn-yellow" href="register.php">
                Join The Hunt & Play Now
            </a>
            <a href="login.php">
                Already Have An Account? Sign In Here
            </a>
        </div>

        <!-- Joining Steps -->
        <section>
            <h3>
                How It Works:
            </h3>
            <h5>Step 1: Take the Survey</h5>
            <p>
                Answer a few quick questions about your taste and preferences.
            </p>
            <h5>Step 2: Get Your Drink Recommendation</h5>
            <p>
                We'll recommend the Tealive drink that matches your personality and cravings.
            </p>
            <h5>Step 3: Play the Hidden Object Game</h5>
            <p>
                Find the hidden new Tealive product within the game.
            </p>
            <h5>Step 4: Win Exciting Rewards</h5>
            <p>
                Find the hidden product for a chance to win exclusive prizes!
            </p>
        </section>

        <section>
            <h3>
                Why Join?
            </h3>
            <ul>
                <li>Personalized drink recommendation</li>
                <li>Fun hidden object challenge</li>
                <li>Chance to win exciting prizes</li>
                <li>Takes only a few minutes</li>
            </ul>
        </section>
    </div>
</body>

</html>