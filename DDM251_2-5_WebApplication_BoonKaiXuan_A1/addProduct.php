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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Alice's Shop</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>

    <style>
        table,
        th,
        td {
            border: none;
        }

        th {
            text-align: left;
        }

        tr {
            height: 50px;
        }

        .sidebar_menu_active>a i {
            color: #FFEF9F;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar_header">
                Alice's Shops
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
            <div class="sidebar_menu_active">
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
            <h1>Add New Product</h1>
            <?php
            if (isset($_GET['error_msg'])) {
                echo '<p class="error-msg">' . htmlspecialchars($_GET['error_msg']) . '</p>';
            }
            ?>

            <form action="insertProduct.php" method="POST">
                <table width="100%" class="margin-tnb-20">
                    <tr>
                        <th>Product ID:</th>
                        <td><input type="text" name="prodID"></td>
                    </tr>
                    <tr>
                        <th width="150">Product Name:</th>
                        <td><input type="text" name="prodName"></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>
                            <textarea name="description">
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Price(RM):</th>
                        <td><input type="text" name="price"></td>
                    </tr>

                </table>
                <div class="row-flex gap-20">
                    <a class="btn btn_blue" href="products.php">
                        Back to Product Listing
                    </a>
                    <input class="btn" type="submit" value="Create">
                </div>
            </form>

        </div>
    </div>

    <script src="js/logout.js"></script>
</body>

</html>