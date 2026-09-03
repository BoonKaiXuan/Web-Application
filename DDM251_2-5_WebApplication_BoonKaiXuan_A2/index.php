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
    <title>Welcome - Tealive New Product Launch 2026</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body class="bg-dark-purple">
    <div class="max-width">
        <header class="card txt-center">
            <img src="img/index_logo.png" alt="Event Logo" width="100%">
            <h3>
                Welcome to<br> Tealive New Product Launch 2026.
            </h3>
            <p>
                Discover your perfect Tealive drink, Hunt for hidden new product, and Win exciting rewards!
            </p>
        </header>
        <img src="img/index-prod.png" alt="Lychee Drink" width="100%">

        <!-- CTA buttons -->
        <div>
            <a class="btn btn-yellow" href="register.php">
                Join The Hunt & Play Now
            </a>
            <a class="txt-center" href="login.php">
                Already Have An Account? Sign In Here
            </a>

        </div>

        <!-- Joining Steps -->
        <section class="card">
            <h3 class="color-yellow">
                How It Works:
            </h3>
            <br>
            <h4>Step 1: Take the Survey 📝</h4>
            <p>
                Answer a few quick questions about your taste and preferences.
            </p>
            <br>
            <h4>Step 2: Find Your Tealive Match 🥤</h4>
            <p>
                We'll recommend the Tealive drink that matches your personality and cravings.
            </p>
            <br>
            <h4>Step 3: Play the Hidden Object Game 🔍</h4>
            <p>
                Find the hidden new Tealive product within the game.
            </p>
            <br>
            <h4>Step 4: Win Exciting Rewards 🎁</h4>
            <p>
                Find the hidden product for a chance to win exclusive prizes!
            </p>
        </section>

    </div>
</body>

</html>