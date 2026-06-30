<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$isbn = $_GET['isbn'];

$sql = "SELECT * FROM booklist WHERE ISBN='$isbn'";
$result = mysqli_query($conn, $sql);
$book = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <button>
        <a class="link" href="booklist.php">Back</a>
    </button>

    <table width="600">
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Price(RM)</th>
        </tr>

        <form action="runEditBook.php" method="POST">
            <tr>
                <td>
                    <?php echo $book['ISBN']; ?>
                    <input type="hidden" name="isbn" value="<?php echo $book['ISBN']; ?>">
                </td>
                <td><input type="text" name="title" value="<?php echo $book['title']; ?>"></td>
                <td><input type="text" name="author" value="<?php echo $book['author']; ?>"></td>
                <td><textarea name="description"><?php echo $book['description']; ?></textarea></td>
                <td><input type="text" name="price" value="<?php echo $book['price']; ?>"></td>
                <td><input type="submit" value="Update"></td>
            </tr>
        </form>
    </table>

</body>

</html>