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
    <title>Create Customer - Alice's Shop</title>
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
            <div class="sidebar_menu_active" href="customer.php">
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
            <h1>Create New Customer</h1>
            <?php
            if (isset($_GET['error_msg'])) {
                echo '<p class="error-msg">' . $error_msg = $_GET['error_msg'] . "</p>";
            }
            ?>

            <form action="insertCustomer.php" method="POST">
                <table width="100%" class="margin-tnb-20">
                    <tr>
                        <th>Customer ID:</th>
                        <td><input type="text" name="customerID"></td>
                    </tr>
                    <tr>
                        <th width="150">Username:</th>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <th>First Name:</th>
                        <td><input type="text" name="firstName"></td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td><input type="text" name="lastName"></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><input type="text" name="customerEmail"></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <th>Phone No.:</th>
                        <td><input type="text" name="customerPhoneNo"></td>
                    </tr>

                </table>
                <div class="row-flex gap-20">
                    <a class="btn btn_blue" href="customer.php">
                        Back to Customer Listing
                    </a>
                    <input class="btn" type="submit" value="Create">
                </div>
            </form>

        </div>
    </div>

    <script src="js/logout.js"></script>
</body>

</html>