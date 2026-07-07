<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
// if users not log in yet they will be redirected to login page

if (!isset($_SESSION["email"])) { //not equal to null

    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week2 - Booklist</title>
</head>

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

<body>
    <table width="1100">
        <tr>
            <th>ISBN</th>
            <th width="300">Title</th>
            <th width="200">Author</th>
            <th>Description</th>
            <th>Price(RM)</th>
        </tr>

        <?php
        $query = "SELECT * FROM booklist";

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?php echo $row['ISBN']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a href="editBook.php?isbn=<?php echo $row['ISBN']; ?>">
                        <input type='button' value='Edit'>
                    </a>
                </td>
                <td><button>Delete</button></td>
            </tr>
        <?php
        }
        mysqli_close($conn);
        ?>

        <a href="profile.php"><input type="submit" value="Profile"></a>
        <a href="addBook.php"><input type="submit" value="AddBook"></a>
        <a href=""><input type="submit" value="LogOut"></a>

    </table>
</body>

</html>