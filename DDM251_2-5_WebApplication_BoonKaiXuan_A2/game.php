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

if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
}
$cusID = $_SESSION["customerID"];

//only one chance
$sql = "SELECT drinkRecommend, prizeType FROM customers WHERE customerID = '$cusID'";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    session_destroy();
    header("Location: index.php");
}

$customer = $result->fetch_assoc();

//survey not done
if (empty($customer["drinkRecommend"])) {
    header("Location: survey.php");
}

if (!empty($customer["prizeType"])) {
    header("Location: profile.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product Hunt - Tealive New Product Launch 2026</title>
    <link rel="stylesheet" href="css/common.css">

    <style>
        body {
            margin: 0;
        }

        .game-area {
            position: relative;
        }

        .btn-incorrect,
        .btn-correct {
            background-color: transparent;
            border: none;
            margin: 0;
            padding: 0;
        }

        .btn-correct {
            position: absolute;
            left: 202px;
            top: 738px;
        }
    </style>
</head>

<body class="bg-dark-purple">

    <!-- Game -->
    <div class="game-area">
        <form action="savePrize.php" method="POST">
            <button class="btn-incorrect prize-choice" name="prizeType" value="small" data-panel="small-prize-panel" type="submit">
                <img src="img/game-incorrect.png" alt="A selection of drinks" width="100%">
            </button>
        </form>
        <form action="savePrize.php" method="POST">
            <button class="btn-correct prize-choice" name="prizeType" value="big" data-panel="big-prize-panel" type="submit">
                <img src="img/game-correct.png" alt="Lychee drink" width="100%">
            </button>
        </form>
    </div>

</body>

</html>