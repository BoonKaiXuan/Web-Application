<?php
$servername = "localhost";
$username = "event_booking";
$password = "ouB]8YU4L/yrWL@S";
$dbname = "event_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_GET['eventDate'])) {
    $selectedDate = $_GET['eventDate'];
} else {
    $selectedDate = "all";
}

if ($selectedDate == "all") {
    $query = "SELECT * FROM event_slots ORDER BY eventDate";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT eventName, capacity FROM event_slots WHERE eventDate=?";
    $result = mysqli_query($conn, $query);
}

/* Event Date */
$eventDateQuery = "SELECT DISTINCT eventDate FROM event_slots";
$eventDateResult = mysqli_query($conn, $eventDateQuery);

/* --Event List --- */
/*$eventListQuery = "SELECT eventName, capacity FROM event_slots WHERE eventDate='$selectedDate'";

$eventListResult = mysqli_query($conn, $eventListQuery);*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
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
    <h1>
        Booking Form
    </h1>

    <div id="myBtnContainer">
        <a href="?eventDate=all">Show all</a>

        <?php
        while ($eventDateCol = mysqli_fetch_assoc($eventDateResult)) {
        ?>
        <?php
            $date = $eventDateCol['eventDate'];
            echo "<a href='?eventDate=$date'>$date</a>";
        }
        ?>
    </div>

    <table width="1000">
        <tr>
            <th width='100'>Event Date</th>
            <th>Event Name</th>
            <th width='50'>Slots Available</th>
        </tr>

        <!-- Event List -->

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td>
                    <?php echo $row['eventDate']; ?>
                </td>
                <td>
                    <?php echo $row['eventName']; ?>
                </td>
                <td>
                    <?php echo $row['capacity']; ?>
                </td>
            </tr>
        <?php
        }
        ?>


    </table>


</body>

</html>