<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 3 - Add Book</title>
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
    <?php
    if (isset($_GET['error_message'])) {
        $error_message = $_GET['error_message'];
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <table width="600">
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Price</th>
        </tr>

        <tr>
            <form action="insertBook.php" method="POST">
                <td><input type="text" name="ISBN"></td>
                <td><input type="text" name="title"></td>
                <td><input type="text" name="author"></td>
                <td><textarea cols="50" input type="text" name="description"></textarea></td>
                <td><input type="text" name="price"></td>
                <td><input type="submit" value="add"></td>
            </form>
        </tr>
    </table>
</body>

</html>