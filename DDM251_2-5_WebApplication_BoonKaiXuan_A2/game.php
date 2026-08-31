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
    <link rel="stylesheet" href="css/game.css">
</head>

<body class="bg-dark-purple">
    <!-- Big Prize Panel -->
    <section class="prize-panel" id="big-prize-panel">
        <form action="savePrize.php" method="POST" class="txt-center">
            <img src="img/reward-big.png" alt="Big prize panel" width="100%">
            <div class="max-width">
                <button type="submit" name="prizeType" value="big" class="btn btn-yellow full-width">
                    Claim Reward
                </button>
            </div>
        </form>
    </section>

    <!-- Small Prize Panel -->
    <section class="prize-panel" id="small-prize-panel">
        <form action="savePrize.php" method="POST" class="txt-center">
            <img src="img/reward-small.png" alt="Small prize panel" width="100%">
            <div class="max-width">
                <button type="submit" name="prizeType" value="small" class="btn btn-yellow full-width">
                    Claim Reward
                </button>
            </div>

        </form>
    </section>

    <!-- Game -->
    <div class="game-area">
        <button class="btn-incorrect prize-choice" data-panel="small-prize-panel" type="button">
            <img src="img/game-incorrect.png" alt="A selection of drinks" width="100%">
        </button>
        <button class="btn-correct prize-choice" data-panel="big-prize-panel" type="button">
            <img src="img/game-correct.png" alt="Lychee drink" width="100%">
        </button>
    </div>

    <script>
        const prizeChoices = document.querySelectorAll(".prize-choice");
        const prizePanels = document.querySelectorAll(".prize-panel");
        const gameArea = document.querySelector(".game-area");

        prizeChoices.forEach(button => {
            button.addEventListener("click", function() {
                const panelId = this.dataset.panel;
                const selectedPanel = document.getElementById(panelId);

                prizePanels.forEach(panel => {
                    panel.classList.remove("active");
                });

                selectedPanel.classList.add("active");
                gameArea.classList.add("hidden");
            });
        });
    </script>
</body>

</html>