<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Alice's Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0&icon_names=dashboard" />
    <script src="https://kit.fontawesome.com/1619a0e9db.js" crossorigin="anonymous"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        box-sizing: border-box;
    }

    body {
        margin: 20px 30px;
        font-family: "Poppins", sans-serif;
        font-size: 16px;
        font-weight: 300;
        background-color: #fffbfb;
    }

    h1 {
        color: #E13F7C;
        font-size: 48px;
        font-weight: 700;
    }

    .container {
        max-width: 1520px;
        margin: auto;
        display: flex;
        gap: 10px;
    }

    .main {
        padding: 30px;
    }

    .sidebar {
        min-width: 130px;
        height: 95vh;
        background-color: #FFEF9F;
        color: #E13F7C;
        font-weight: 600;
        padding: 20px 10px;
        border-radius: 10px;
    }

    .sidebar_header {
        text-align: center;
        padding: 20px 0px 50px 0px;
        font-size: 20px;
    }

    .sidebar>div i,
    .sidebar>div span {
        color: #E13F7C;
        font-size: 20px;
        margin-right: 10px;
    }

    .sidebar>div span {
        font-size: 24px;
    }

    .sidebar_menu {
        padding: 20px 28px;
        margin: 10px 0px;
    }

    .sidebar_menu:hover,
    .sidebar_menu_active {
        cursor: pointer;
        background-color: #E13F7C;
        border-radius: 5px;
    }

    .sidebar_menu:hover,
    .sidebar_menu:hover i,
    .sidebar_menu:hover span,
    .sidebar_menu_active,
    .sidebar>div span {
        color: #FFEF9F;
    }

    .vert-align {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<body>
    <div class="container">
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

        <div class="main">
            <h1> Welcome</h1>
        </div>

    </div>
</body>

</html>