<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['department'])) {
    $department = $_GET['department'];
} else {
    $department = "all";
}

if ($department == "all") {
    $query = "SELECT * FROM employee";
    $result = mysqli_query($conn, $query);
} else {
    $departmentName = ucwords(str_replace('-', ' ', $department));

    $stmt = $conn->prepare("SELECT * FROM employee WHERE Department = ?");
    $stmt->bind_param("s", $departmentName);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

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
    <div id="myBtnContainer">

        <a href="?department=all">Show all</a>
        <a href="?department=finance">Finance</a>
        <a href="?department=human-resources">Human Resources</a>
        <a href="?department=marketing">Marketing</a>

        <a href="downloadEmpList.php?department=<?php echo $department; ?>">
            Download CSV
        </a>
    </div>

    <table width="600">
        <tr>
            <th width="100">S/No.</th>
            <th>Employee Name</th>
            <th width="200">Department</th>
        </tr>

        <?php
        $rowNumber = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr class="filterDiv <?php echo strtolower(str_replace(' ', '-', $row['Department'])); ?>">
                <td><?php echo $rowNumber; ?></td>
                <td><?php echo $row['EmployeeName']; ?></td>
                <td><?php echo $row['Department']; ?></td>
            </tr>
        <?php
            $rowNumber++;
        }
        mysqli_close($conn);
        ?>

</body>

</html>