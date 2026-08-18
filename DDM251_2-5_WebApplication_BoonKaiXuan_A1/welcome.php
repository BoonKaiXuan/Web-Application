<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
</head>
<style>
    .sidebar>div span {
        color: #FFEF9F;
    }

    .btn {
        width: 100%;
    }

    .card {
        padding: 20px;
        background-color: #FFEF9F;
        border-radius: 8px;
        margin: 6px 10px;
    }
</style>

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
            <div class="sidebar_menu">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sign Out
            </div>
        </div>

        <div class="main">
            <h1> Welcome</h1>
            <div class="topbar row-flex">
                <div class="card">
                    <h4>Total Orders</h4>
                    <?php
                    echo $totalOrders;
                    ?>
                </div>
                <div class="card">
                    <h4>Unsold Products</h4>
                    <p><?= count($unsoldProd) ?></p>
                </div>
                <div class="card">
                    <h4>Inactive Customers</h4>
                    <p><?= count($inactiveCus) ?></p>
                </div>
            </div>
            <div class="card">
                <h3>Top 3 Products</h3>
                <br>
                <ol>
                    <?php if (!empty($top3Prod)): ?>
                        <?php foreach ($top3Prod as $product): ?>
                            <li>
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
</body>

</html>