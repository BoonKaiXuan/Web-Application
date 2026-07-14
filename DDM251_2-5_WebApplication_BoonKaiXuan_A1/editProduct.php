<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prodID = $_GET['prodID'];

$sql = "SELECT * FROM products WHERE prodID='$prodID'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer - Alices Shop</title>
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

    .error {
        color: red;
        font-weight: 600;
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
            <h1>Edit Product</h1>

            <?php
            if (isset($_GET['empty'])) {
                echo '<p class="error">' . $empty = $_GET['empty'] . "</p>";
            }

            if (isset($_GET['priceDigit'])) {
                echo '<p class="error">' . $priceDigit = $_GET['priceDigit'] . "</p>";
            }

            ?>

            <form action="runEditProduct.php" method="POST">
                <table width="100%">
                    <tr>
                        <th>Product ID:</th>
                        <td><input name="prodID" value="<?php echo $product['prodID']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Product Name:</th>
                        <td><input type="text" name="prodName"></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><textarea rows="3" cols="50" name="description"></textarea>
                    </tr>
                    <tr>
                        <th width="200">Price (RM):</th>
                        <td><input name="price"></td>
                    </tr>

                </table>

                <div class="row-flex gap-20">
                    <a class="btn btn_blue" href="products.php">
                        Back to Product Listing
                    </a>
                    <input class="btn" type="submit" value="Update Product">
                </div>
            </form>

        </div>
    </div>

</body>

</html>