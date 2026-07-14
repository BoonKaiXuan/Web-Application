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
$prodID = $_POST['prodID'];
$prodName = $_POST["prodName"];
$description = $_POST["description"];
$price = $_POST["price"];

if (empty($prodName) || empty($description) || empty($price)) {
    $empty = '*Please fill in all the fields.';
    header("Location:editProduct.php?prodID=$prodID&empty=" . $empty);
} else if (!is_numeric($price)) {
    $priceDigit = '*Please enter price in digit form.';
    header("Location:editProduct.php?prodID=$prodID&priceDigit=" . $priceDigit);
} else {

    $sql = "UPDATE products SET prodName='$prodName', description='$description', price='$price' WHERE prodID='$prodID'";

    if (mysqli_query($conn, $sql)) {
        header("Location:products.php");
    }
}

mysqli_close($conn);
