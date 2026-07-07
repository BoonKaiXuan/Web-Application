<!--no need do php connection, cuz we're just getting the message glued to the url, no need to get data from the table-->

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
        <a class="link" href="profile.php">Back</a>
    </button>
    <button>
        <a class="link" href="">LogOut</a>
    </button>

    <table width="600">
        <tr>
            <th>Password</th>
            <th>Confirm Password</th>
            <th>Name</th>
            <th>Year Joined</th>
        </tr>

        <tr>

            <?php
            if (isset($_GET['error_message'])) {
                echo '<p style="color: red;">' . $_GET['error_message'] . '</p>';
            }
            ?>

            <form action="runEditProfile.php" method="POST">

                <td><input type="password" name="password" minlength="6"></td>
                <td><input type="password" name="confirmPassword" minlength="6"></td>
                <td><input type="text" name="name"></td>
                <td><input type="text" name="yearjoin" maxlength="4"></td>
                <td><input type="submit" value="Submit"></td>
            </form>

        </tr>
    </table>

</body>

</html>