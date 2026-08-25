<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

session_start();
$uid = $_SESSION['customerID'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//if not log in yet
if (!isset($_SESSION["customerID"])) { //not equal to null
    header("Location:index.php");
}

//to fetch username
$userQuery = mysqli_query($conn, "SELECT username FROM customers WHERE customerID = '$uid'");
$user = mysqli_fetch_assoc($userQuery);

//Total Orders
$orderResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");

$orderRow = mysqli_fetch_assoc($orderResult);
$totalOrders = $orderRow['total'];

//Unsold Products
$prodResult = mysqli_query($conn, "SELECT p.prodID, p.prodName FROM products p
         LEFT JOIN orderdetails od ON p.prodID = od.prodID
         WHERE od.prodID IS NULL");
$unsoldProd = mysqli_fetch_all($prodResult, MYSQLI_ASSOC);

//Cus with no purchase
$cusResult = mysqli_query($conn, "SELECT c.username FROM customers c
         LEFT JOIN orders o ON c.username = o.username
         WHERE o.username IS NULL");
$inactiveCus = mysqli_fetch_all($cusResult, MYSQLI_ASSOC);

//Top 3 products
$top3Result = mysqli_query($conn, "SELECT p.prodID, p.prodName, SUM(od.qty) AS total_units_sold
         FROM products p
         JOIN orderdetails od ON p.prodID = od.prodID
         GROUP BY p.prodID, p.prodName
         ORDER BY total_units_sold DESC
         LIMIT 3");
$top3Prod = mysqli_fetch_all($top3Result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Alice's Shop</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>

    <style>
        .sidebar>div span {
            color: #FFEF9F;
        }

        .card {
            padding: 30px;
            background-color: #FFEF9F;
            border-radius: 16px;
            margin: 6px 10px;
        }

        .topbar {
            width: calc(33.33% - calc(2 * 20px /3));
            text-align: center;
        }

        .card_icon {
            border-radius: 8px;
            color: #E13F7C;
            font-size: 30px;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar_header">
                Alice's Shop
            </div>
            <div class="sidebar_menu_active">
                <a class="sidebar_menu vert-align" href="welcome.php">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>Dashboard
                </a>
            </div>
            <div>
                <a class="sidebar_menu" href="customer.php">
                    <i class="fa-solid fa-user"></i>
                    Customers
                </a>
            </div>
            <div>
                <a class="sidebar_menu" href="products.php">
                    <i class="fa-solid fa-box-open"></i>
                    Products
                </a>
            </div>
            <div>
                <a class="sidebar_menu" href="order.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Orders
                </a>
            </div>
            <div class="sidebar_menu" onclick="confirmLogout()">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sign Out
            </div>
        </div>

        <div class="main">
            <div>
                <h1> Welcome,</h1>
                <h1>
                    <?php
                    echo $user['username'];
                    ?>
                </h1>
            </div>

            <div class="row-flex margin-tnb-20">
                <div class="card topbar">
                    <div class="card_icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <h5>Total Orders</h5>
                        <h2>
                            <?php
                            echo $totalOrders;
                            ?>
                        </h2>
                    </div>

                </div>

                <div class="card topbar">
                    <div class="card_icon">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <div>
                        <h5>Unsold Products</h5>
                        <h2><?= count($unsoldProd) ?></h2>
                    </div>

                </div>

                <div class="card topbar">
                    <div class="card_icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <h5>Inactive Customers</h5>
                        <h2><?= count($inactiveCus) ?></h2>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="row-flex gap-20 margin-tnb-20">
                    <h2>Top 3 Products</h2>
                    <i class="fa-solid fa-ranking-star" style="color: #E13F7C; font-size:30px;"></i>
                </div>

                <ol>
                    <?php if (!empty($top3Prod)): ?>
                        <?php foreach ($top3Prod as $product): ?>
                            <li class="margin-tnb-20">
                                <strong><?= htmlspecialchars($product['prodID']) ?></strong>
                                - <?= htmlspecialchars($product['prodName']) ?>
                                (<?= $product['total_units_sold'] ?> sold)
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No sales recorded yet.</li>
                    <?php endif; ?>
                </ol>
            </div>
        </div>

    </div>

    <script src="js/logout.js"></script>
</body>

</html>