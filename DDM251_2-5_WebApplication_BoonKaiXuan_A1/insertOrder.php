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
    $username = $_POST["username"];
    $prodID = $_POST["prodID"];
    $qty = $_POST["qty"];
    $orderDate = date("Y-m-d");

    // Create order
    $sql = "INSERT INTO orders 
            (username, orderDate)
            VALUES 
            ('$username', '$orderDate')";

    if (empty($username) || empty($prodID)) {
        $error_message = 'Please fill in all the fields.';
        header("Location:createOrder.php?error_message=" . $error_message);
    } else {
        // Check every product and quantity
        for ($i = 0; $i < count($prodID); $i++) {

            if (empty($prodID[$i]) || empty($qty[$i])) {
                $error_message = 'Please fill in all the fields.';
                header("Location:createOrder.php?error_message=" . $error_message);
                exit();
            }
        }

        // Check duplicate products
        if (count($prodID) != count(array_unique($prodID))) {
            $error_message = 'Please select a different product.';
            header("Location:createOrder.php?error_message=" . $error_message);
            exit();
        }

        if (mysqli_query($conn, $sql)) {

            // Get newly created orderID
            $orderID = mysqli_insert_id($conn);

            // Create order details
            for ($i = 0; $i < count($prodID); $i++) {

                $product = $prodID[$i];
                $quantity = $qty[$i];

                // Get product price
                $sql = "SELECT price 
                        FROM products 
                        WHERE prodID = '$product'";

                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $productPrice = $row['price'];

                // Calculate total price for this product
                $totalPrice = $productPrice * $quantity;

                // Add to order total
                $totalAmount = $totalAmount + $totalPrice;

                // Insert order detail

                $sql = "INSERT INTO orderDetails
                        (orderID, prodID, qty, prodPrice, totalAmount)
                        VALUES
                        ('$orderID', '$product', '$quantity', '$productPrice', '$totalPrice')";

                mysqli_query($conn, $sql);
            }
            // Update total amount in orders
            $sql = "UPDATE orders
                    SET totalAmount = '$totalAmount'
                    WHERE orderID = '$orderID'";

            mysqli_query($conn, $sql);

            header("Location:order.php");
            exit();
        } else {
            echo mysqli_error($conn);
        }
    }
}



mysqli_close($conn);
