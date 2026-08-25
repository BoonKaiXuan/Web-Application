<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//if not log in yet
if (!isset($_SESSION["customerID"])) {
    header("Location:index.php");
}

$orderID = $_GET['orderID'];

$sql = "SELECT od.*, p.prodName 
        FROM orderdetails AS od
        INNER JOIN products AS p
        ON od.prodID = p.prodID
        WHERE od.orderID='$orderID'";
$result = mysqli_query($conn, $sql);
//for total order amount
$sqlTotal = "SELECT totalAmount 
             FROM orders 
             WHERE orderID='$orderID'";

$resultTotal = mysqli_query($conn, $sqlTotal);
$order = mysqli_fetch_assoc($resultTotal);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Alice's Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/common.css">
</head>

<style>
    th {
        text-align: center;
    }

    tr {
        height: 50px;
    }

    .sidebar_menu_active>a i {
        color: #FFEF9F;
    }
</style>

<body>
    <div class="sidebar">
        <div class="sidebar_header">
            Alice's Shop
        </div>
        <div>
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
        <div class="sidebar_menu_active">
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
        <h1>Order Details</h1>
        <table width="100%" class="margin-tnb-20">
            <tr>
                <th width="150">Order Details ID</th>
                <th width="150">Order ID</th>
                <th width="150">Product ID</th>
                <th width="250">Product Name</th>
                <th>QTY</th>
                <th>Unit Price (RM)</th>
                <th>Total Amount (RM)</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['orderDetailsID']; ?></td>
                    <td><?php echo $row['orderID']; ?></td>
                    <td><?php echo $row['prodID']; ?></td>
                    <td><?php echo $row['prodName']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo number_format($row['prodPrice'], 2); ?></td>
                    <td><?php echo number_format($row['totalAmount'], 2); ?></td>
                </tr>
            <?php } ?>

        </table>

        <div class="margin-tnb-20">
            <strong>
                Total Order Amount: RM <?php echo number_format($order['totalAmount'], 2); ?>
            </strong>
        </div>
        <br>
        <div class="row-flex">
            <a class="btn btn_blue" href="order.php">
                Back to Order Listing
            </a>
            <a class="btn" href="editOrder.php?orderID=<?php echo $orderID; ?>">
                Edit
            </a>
        </div>
    </div>

    <script src="js/logout.js"></script>
</body>

</html>