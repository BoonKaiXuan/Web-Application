<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List - Alice's Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/common.css">
</head>

<style>
    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    .sidebar_menu_active>a i {
        color: #FFEF9F;
    }
</style>

<body>
    <div class="container">
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
            <table width="1200">
                <tr>
                    <th width="100">Customer ID</th>
                    <th width="150">Username</th>
                    <th width="200">First Name</th>
                    <th width="200">Last Name</th>
                    <th width="300">Email</th>
                </tr>

                <?php
                $query = "SELECT * FROM customers";

                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tr>
                        <td><?php echo $row['customerID']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['firstName']; ?></td>
                        <td><?php echo $row['lastName']; ?></td>
                        <td><?php echo $row['customerEmail']; ?></td>
                        <td class="row-flex">
                            <a class="btn btn_sub btn_green" href="customerDetails.php?customerID=<?php echo $row['customerID']; ?>">
                                Details
                            </a>
                            <a class="btn btn_sub btn_blue" href="editCustomer.php?customerID=<?php echo $row['customerID']; ?>">
                                Edit
                            </a>
                            <button class="btn btn_sub btn_red">Delete</button>
                        </td>

                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>

                <a href="addCustomer.php"><input class="btn" h type="submit" value="Create New Customer"></a>

            </table>
        </div>
    </div>

</body>

</html>