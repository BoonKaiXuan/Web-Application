<?php
$servername = "localhost";
$username = "aliceshop";
$password = "E1yYuo(k47nHG(T9";
$dbname = "aliceshop";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prodID = $_POST["prodID"];
    $prodName = $_POST["prodName"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    if ($prodID == "" || $prodName == "" || $price == "") {
        $error_msg = "*Please fill in ProductID, Product Name and Price.";
        header("Location:addProduct.php?error_msg=" . $error_msg);
        exit();
    }

    $sql = "INSERT INTO products (prodID, prodName, description, price)
VALUES ('$prodID', '$prodName', '$description', '$price')";

    if (mysqli_query($conn, $sql)) {
        header("Location:products.php");
        exit();
    } else {
        echo mysqli_error($conn);
    }
}
mysqli_close($conn);
