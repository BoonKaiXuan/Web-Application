<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer - Alice's Shop</title>
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
            <h1>Create New Customer</h1>

            <form action="insertCustomer.php" method="POST">
                <table width="100%">
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
                        <td><input type="text" name="password"></td>
                    </tr>
                    <tr>
                        <th>Phone No.:</th>
                        <td><input type="text" name="customerPhoneNo"></td>
                    </tr>

                </table>
                <div class="row-flex gap-20">
                    <a href="customer.php">
                        <button class="btn btn_blue">Back to Customer Listing</button>
                    </a>
                    <input class="btn" type="submit" value="Create">
                </div>
            </form>

        </div>
    </div>
</body>

</html>