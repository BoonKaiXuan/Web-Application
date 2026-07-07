<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cusID = $_GET['customerID'];

$sql = "SELECT * FROM customers WHERE customerID='$cusID'";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details - Alice's Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/common.css">
</head>

<style>
    th {
        text-align: left;
    }

    tr {
        height: 50px;
    }

    table input {
        width: 100%;
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
        <div class="sidebar_menu_active">
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
        <div class="sidebar_menu">
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </div>
        <div class="sidebar_menu">
            <i class="fa-solid fa-right-from-bracket"></i>
            Sign Out
        </div>
    </div>

    <div class="main">
        <h1>Customer Details</h1>
        <table width="100%">
            <tr>
                <th>Customer ID</th>
                <td><?php echo $customer['customerID']; ?></td>
            </tr>
            <tr>
                <th width="200">Username</th>
                <td><?php echo $customer['username']; ?></td>
            </tr>
            <tr>
                <th width="200">First Name</th>
                <td><?php echo $customer['firstName']; ?></td>
            </tr>
            <tr>
                <th width="200">Last Name</th>
                <td><?php echo $customer['lastName']; ?></td>
            </tr>
            <tr>
                <th width="200">Email</th>
                <td><?php echo $customer['customerEmail']; ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo $customer['password']; ?></td>
            </tr>
            <tr>
                <th>Phone No.</th>
                <td><?php echo $customer['customerPhoneNo']; ?></td>
            </tr>

        </table>
        <div class="row-flex">
            <a class="btn btn_blue" href="customer.php">
                Back to Customer Listing
            </a>
            <a class="btn" href="editCustomer.php?customerID=<?php echo $customer['customerID']; ?>">
                Edit
            </a>
        </div>
    </div>

</body>

</html>