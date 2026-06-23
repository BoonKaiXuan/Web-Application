<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer - Alice's Shop</title>
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

    <table width="1400">
        <tr>
            <th>Customer ID</th>
            <th width="200">Username</th>
            <th width="200">First Name</th>
            <th width="200">Last Name</th>
            <th width="300">Email</th>
            <th width="200">Password</th>
            <th width="120">Phone No.</th>
        </tr>

        <tr>
            <form action="insertCustomer.php" method="POST">
                <td><input type="text" name="customerID"></td>
                <td><input type="text" name="username"></td>
                <td><input type="text" name="firstName"></td>
                <td><input type="text" name="lastName"></td>
                <td><input type="text" name="customerEmail"></td>
                <td><input type="text" name="password"></td>
                <td><input type="text" name="customerPhoneNo"></td>
                <td><input type="submit" value="add"></td>
            </form>
        </tr>
    </table>
</body>

</html>