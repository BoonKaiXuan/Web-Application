<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Alice's Shop</title>
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
            <h1>Add New Product</h1>

            <form action="insertProduct.php" method="POST">
                <table width="100%">
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
</body>

</html>