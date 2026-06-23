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
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week2 - Profile</title>
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
    <table>
        <tr>
            <th width="100">Name</th>
            <th width="250">Email</th>
            <th width="150">Year Joined</th>
        </tr>

        <?php
        $query = "SELECT * FROM student WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['yearjoin']; ?></td>
                <td width="100"><input type='button' value='Edit'></tds>
            </tr>
        <?php
        }
        mysqli_close($conn);
        ?>

        <a href="booklist.php"><button>Back</button></a>

    </table>
</body>

</html>