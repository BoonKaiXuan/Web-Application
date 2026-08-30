<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();
$cusID = $_SESSION["customerID"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION["customerID"])) {
    header("Location: login.php");
}

$result = "";
$recommendation = "";
$result_img = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Get individual score for each question
    $q1_score = $_POST['q1_score'];
    $q2_score = $_POST['q2_score'];
    $q3_score = $_POST['q3_score'];

    //Calculate total score
    $total_score = $q1_score + $q2_score + $q3_score;
    if ($total_score <= 3) {
        $result = "Classic Comfort";
        $recommendation = "Recommendation: <br> Brown Sugar Pearl Milk Tea / Roasted Milk Tea with Grass Jelly";
        $result_img = "img/result-classic.png";
    } else if ($total_score <= 6) {
        $result = "Sweet Explorer";
        $recommendation = "Recommendation: <br>Strawberry Pudding Smoothie, Mango Pudding Smoothie, Snowy Da Hong Pao Caramel Smoothie";
        $result_img = "img/result-sweet.png";
    } else {
        $result = "Refreshing Adventurer";
        $recommendation = "Recommendation:<br> Watermelon Smoothie, Mulberry Burst Tea Konjac, Mango Ice Shaken Tea";
        $result_img = "img/result-refreshing.png";
    }

    //Update the survey result in the database
    $updateSQL = "UPDATE customers SET totalScore = '$total_score', drinkResult = '$result', drinkRecommend = '$recommendation' WHERE customerID = '$cusID'";


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
    <link rel="stylesheet" href="css/common.css">

    <style>
        .game {
            margin: 30px 0 10px 0;
        }

        .divider {
            width: 100%;
            margin: 25px 0;
            border: none;
            border-top: 2px dashed #ffffff;
        }
    </style>
</head>

<body class="bg-pale-purple">
    <div class="max-width">
        <h2>Your Tealive Match is In!</h2>
        <div class="survey_result">
            <img src="<?php echo ($result_img); ?>" alt="<?php echo ($result); ?>">
            <p><?php echo $recommendation; ?></p>
        </div>

        <hr class="divider">
        <!-- Play game -->
        <div class="game">
            <h3>Next Challenge:<br> Find the Hidden New Product!</h3>
            <p>Can you spot our secret new product?</p>
            <a class="btn btn-yellow full-width" href="game.php">
                Begin the Hunt!
            </a>
        </div>
    </div>
</body>

</html>