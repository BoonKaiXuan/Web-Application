<?php
$servername = "localhost";
$username = "tealive";
$password = "5spY@)Hmeg]XrKeS";
$dbname = "tealive";

session_start();
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['customerID'])) {
    header("Location: index.php");
}

$voucherImg = "";
$cusID = $_SESSION['customerID'];
$sql = "SELECT * FROM customers WHERE customerID = '$cusID'";
$result = $conn->query($sql);
$customer = $result->fetch_assoc();

if (empty($customer["drinkRecommend"])) {
    header("Location: survey.php");
} else if (empty($customer["prizeType"])) {
    header("Location: game.php");
} else {

    $resultImages = [
        "Classic Comfort" => "img/result-classic.png",
        "Sweet Explorer" => "img/result-sweet.png",
        "Refreshing Adventurer" => "img/result-refreshing.png"
    ];

    $drinkResult = $customer["drinkResult"];
    $resultImg = $resultImages[$drinkResult];

    if ($customer['prizeType'] == "big") {
        $voucherImg = "img/voucher-big.png";
    } else {
        $voucherImg = "img/voucher-small.png";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Tealive New Product Launch 2026</title>
    <link rel="stylesheet" href="css/common.css">

    <style>
        .profile {
            padding: 15px 25px;
        }

        h2 {
            color: var(--color-golden-yellow);
        }
    </style>
</head>

<body class="bg-dark-purple">

    <section class="profile txt-center">
        <div>
            <img src="img/profile-img.png" alt="profile image" width="120px">
        </div>
        <div>
            <h1>Hello,
                <?php echo $customer['lastName']; ?>
            </h1>
            <p><?php echo $customer['email']; ?></p>
        </div>
    </section>

    <div class="max-width">
        <section class="card">
            <h2>Your Reward</h2>
            <p>Status:
                <span> <?php echo $customer['prizeStatus']; ?></span>
            </p>
            <p>Awarded:
                <?php echo $customer['awardedDate']; ?>
            </p>
            <img
                src="<?php echo $voucherImg; ?>"
                alt="<?php echo $customer['prizeType']; ?> prize voucher"
                class="voucher-img" width="100%">
        </section>

        <section class="card">
            <h2>Your Drink Personality</h2>
            <img
                src="<?php echo $resultImg; ?>"
                alt="<?php echo $drinkResult; ?>"
                class="result-img">

            <p>
                <br><?php echo $customer['drinkRecommend']; ?>
            </p>
        </section>

        <button class="btn btn-yellow full-width" type="submit" onclick="confirmLogout()">
            Sign Out
        </button>

    </div>

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to sign out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>

</html>