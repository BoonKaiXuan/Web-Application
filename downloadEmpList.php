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

// Get filtered data
if ($department == "all") {
    $query = "SELECT * FROM employee";
} else {
    $departmentName = ucwords(str_replace('-', ' ', $department));

    $query = "SELECT * FROM employee WHERE Department = '$departmentName'";
}
$result = mysqli_query($conn, $query);



// Tell browser this is a CSV download
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=employees_" . $department . ".csv");

// Open output stream
$output = fopen("php://output", "w");

// CSV header row
fputcsv($output, ["Employee ID", "Employee Name", "Department"]);

// Data rows
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row["EmployeeID"],
        $row["EmployeeName"],
        $row["Department"]
    ]);
}

fclose($output);
$conn->close();
exit;
