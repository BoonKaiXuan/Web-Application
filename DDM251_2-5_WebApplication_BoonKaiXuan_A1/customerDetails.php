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
    <title>Customer Details - Alice's Shop</title>
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
    <div class="sidebar">
        <div class="sidebar_header">
            Alice's Shop
        </div>
        <div class="sidebar_menu sidebar_menu_active vert-align">
            <span class="material-symbols-outlined">
                dashboard
            </span>Dashboard
        </div>
        <div class="sidebar_menu">
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

    <div>
        <table width="1400">
            <tr>
                <th>Customer ID</th>
                <th width="200">Username</th>
                <th width="200">First Name</th>
                <th width="200">Last Name</th>
                <th width="300">Email</th>
                <th width="150">Password</th>
                <th width="200">Phone No.</th>
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
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['customerPhoneNo']; ?></td>

                </tr>
            <?php
            }
            mysqli_close($conn);
            ?>

            <button>
                <a class="link" href="customer.php">Back to Customer Listing</a>
            </button>
            <input type='button' value='Edit'>

        </table>
    </div>

</body>

</html>