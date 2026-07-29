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
    <title>Product List - Alice's Shop</title>
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

    .no-border {
        border: none;
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
                    <th width="100">Product ID</th>
                    <th width="200">Product Name</th>
                    <th width="600">Description</th>
                    <th width="100">Price (RM)</th>
                    <th colspan="3"></th>
                </tr>

                <?php
                $query = "SELECT * FROM products";

                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tr>
                        <td><?php echo $row['prodID']; ?></td>
                        <td><?php echo $row['prodName']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>
                            <div class="row-flex">
                                <a class="btn btn_sub btn_green" href="productDetails.php?prodID=<?php echo $row['prodID']; ?>">
                                    Details
                                </a>
                                <a class="btn btn_sub btn_blue" href="editProduct.php?prodID=<?php echo $row['prodID']; ?>">
                                    Edit
                                </a>
                                <button class="btn btn_sub btn_red" onclick="confirmDelete('<?php echo $row['prodID']; ?>')">Delete
                                </button>
                            </div>
                        </td>


                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>

                <a href="addProduct.php"><input class="btn" h type="submit" value="Add New Product"></a>

            </table>
        </div>
    </div>

    <script>
        function confirmDelete(prodID) {
            let text = "Are you sure you want to delete the product with product ID:" + prodID + "?";

            if (confirm(text) == true) {

                window.location.href = "deleteProd.php?prodID=" + prodID;
            }
        }
    </script>

</body>

</html>