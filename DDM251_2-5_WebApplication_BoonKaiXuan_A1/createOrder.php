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
    <title>Create Order - Alice's Shop</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>

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

    .product-row td {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .product-row input {
        width: 50px;
    }
</style>

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
            <div class="sidebar_menu">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sign Out
            </div>
        </div>

        <div class="main">
            <h1>Create New Order</h1>
            <?php
            if (isset($_GET['error_message'])) {
                $error_message = $_GET['error_message'];
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <form action="insertOrder.php" method="POST">
                <table width="100%" id="productTable">
                    <tr>
                        <th>Username:</th>
                        <td>
                            <select name="username">
                                <option value="" selected disabled>&lt;-- Select Username --&gt;</option>
                                <?php
                                $sql = "SELECT username FROM customers";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['username'] . "'>";
                                    echo $row['username'];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!-- Product 1 -->
                    <tr class="product-row">
                        <th width="150">Product</th>
                        <td>
                            <select name="prodID[]">
                                <option value="" selected disabled>&lt;-- Select Product --&gt;</option>
                                <?php
                                $sql = "SELECT prodID, prodName FROM products";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['prodID'] . "'>";
                                    echo $row['prodID'] . " - " . $row['prodName'];
                                    echo "</option>";
                                }
                                ?>
                            </select>

                            <label>Quantity:</label>
                            <input type="number" name="qty[]" min="1">

                            <button type="button" onclick="deleteProduct(this)" class="btn btn_red btn_sub">Delete Product</button>
                        </td>
                    </tr>

                </table>
                <div>
                    <button type="button" onclick="addProduct()" class="btn btn_green">Add Product</button>

                </div>
                <div class="row-flex gap-20">
                    <a class="btn btn_blue" href="order.php">
                        Back to Order Listing
                    </a>
                    <input class="btn" type="submit" value="Create Order">
                </div>
            </form>

        </div>
    </div>

    <script>
        function addProduct() {

            let row = document.querySelector(".product-row").cloneNode(true);

            // Reset product dropdown
            row.querySelector("select").selectedIndex = 0;

            // Reset quantity
            row.querySelector("input").value = "";

            document.getElementById("productTable").appendChild(row);
        }


        function deleteProduct(button) {

            let rows = document.querySelectorAll(".product-row");

            // Need at least one product
            if (rows.length > 1) {
                button.closest(".product-row").remove();
            } else {
                alert("You need at least one product.");
            }
        }
    </script>
</body>

</html>