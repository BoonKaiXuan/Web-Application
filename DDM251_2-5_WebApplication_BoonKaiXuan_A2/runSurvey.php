<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$result = "";
$recommendation = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Get individual score for each question
    $q1_score = $_POST['q1_score'];
    $q2_score = $_POST['q2_score'];
    $q3_score = $_POST['q3_score'];

    //Calculate total score
    $total_score = $q1_score + $q2_score + $q3_score;
    if ($total_score <= 3) {
        $result = "Classic Comfort";
        $recommendation = "Recommendation: Signature Milk Tea/ Brown Sugar Pearl Milk Tea";
    } else if ($total_score <= 6) {
        $result = "Sweet Explorer";
        $recommendation = "Recommendation:  Strawberry Pudding Smoothie, Mango Passion Fruit Tea, Peach Oolong Tea";
    } else {
        $result = "Refreshing Adventurer";
        $recommendation = "Recommendation: Peach Oolong Tea, Grape Tea, Lemon Green Tea";
    }

    //Update the survey result in the database
    $cusEmail = $_SESSION['email'];
    $updateSQL = "UPDATE customers SET totalScore = '$total_score', drinkResult = '$result', drinkRecommend = '$recommendation' WHERE email = '$cusEmail'";

    if ($conn->query($updateSQL) === TRUE) {
        // Successfully updated the survey result
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    header("Location: survey.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tealive Match!</title>
</head>

<body>
    <div class="result_card">
        <div class="survey_result">
            <h2>Your Tealive Match is In!</h2>
            <h1><?php echo $result; ?></h1>
            <p><?php echo $recommendation; ?></p>
        </div>

        <!-- Play game -->
        <div>
            <h3>Next Challenge: Find the Hidden New Product!</h3>
            <p>Can you spot our secret new product hidden in the shop?</p>
            <a href="game.php">
                Begin the Hunt!
            </a>
        </div>
    </div>
</body>

</html>