<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();
$cusID = $_SESSION["customerID"];
$prizeType = $_GET['prizeType'];
$prizeImg = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
}

$sql = "SELECT * FROM customers WHERE customerID = '$cusID'";
$result = $conn->query($sql);
$customer = $result->fetch_assoc();

if (empty($customer["drinkRecommend"])) {
    header("Location: survey.php");
} else if (empty($customer["prizeType"])) {
    header("Location: game.php");
} else {

    if ($prizeType == "small") {
        $prizeImg = "img/reward-small.png";
    } else {
        $prizeImg = "img/reward-big.png";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Here's Your Prize! - Tealive New Product Launch 2026</title>
    <link rel="stylesheet" href="css/common.css">
    <style>
        body {
            margin: 0;
            max-width: 430px;
        }

        .prize-panel {
            animation: prize-pop 0.4s ease;
        }

        a {
            position: absolute;
            bottom: 10vh;
            left: 6vw;
            max-width: 380px;
        }

        @keyframes prize-pop {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.8);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>

<body class="bg-dark-purple">
    <section class="prize-panel">
        <img src="<?php echo $prizeImg; ?>" alt="Prize panel" width="100%">
        <div class="max-width">
            <a href="profile.php" class="btn btn-yellow full-width">
                Check Out Your Reward!
            </a>
        </div>
    </section>

</body>

</html>