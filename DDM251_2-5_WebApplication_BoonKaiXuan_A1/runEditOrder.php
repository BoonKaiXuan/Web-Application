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
$orderID = $_GET['orderID'];
$prodIDs = $_POST["prodID"];
$qtys = $_POST["qty"];

// Delete existing details
mysqli_query($conn, "DELETE FROM orderdetails WHERE orderID = $orderID");

$orderTotal = 0;
//$index= curr prod pos in the $prodIDs
foreach ($prodIDs as $index => $prodID) {
    $prodID = $prodIDs[$index];
    $qty = (int) $qtys[$index];

    // get product price
    $result = mysqli_query(
        $conn,
        "SELECT price
         FROM products
         WHERE prodID = '$prodID'"
    );

    $product = mysqli_fetch_assoc($result);

    $prodPrice = $product['price'];
    // total for this product
    $totalAmount = $prodPrice * $qty;
    $orderTotal += $totalAmount;

    // insert updated order detail
    $sql = "INSERT INTO orderdetails
            (orderID, prodID, qty, prodPrice, totalAmount)
            VALUES
            ('$orderID', '$prodID', '$qty',
             '$prodPrice', '$totalAmount')";

    mysqli_query($conn, $sql);
}

// Update overall order total
mysqli_query(
    $conn,
    "UPDATE orders
     SET totalAmount = '$orderTotal'
     WHERE orderID = '$orderID'"
);

header("Location:orderDetails.php?orderID=$orderID");
