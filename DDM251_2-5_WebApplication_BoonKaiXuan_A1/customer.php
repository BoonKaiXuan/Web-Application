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
</style>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar_header">
                Alice's Shop
            </div>
            <div class="sidebar_menu vert-align">
                <span class="material-symbols-outlined">
                    dashboard
                </span>Dashboard
            </div>
            <div class="sidebar_menu sidebar_menu_active">
                <i class="fa-solid fa-user"></i>
                Customers
            </div>
            <div class="sidebar_menu">
                <i class="fa-solid fa-box-open"></i>
                Products
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
            <table width="1100">
                <tr>
                    <th>Customer ID</th>
                    <th width="200">Username</th>
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
                        <td>
                            <a href="customerDetails.php">
                                <input type='button' value='Details'>
                            </a>
                        </td>
                        <td><input type='button' value='Edit'></td>
                        <td><button>Delete</button></td>
                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>

                <a href="addCustomer.php"><input class="btn" h type="submit" value="AddCustomer"></a>

            </table>
        </div>
    </div>

</body>

</html>