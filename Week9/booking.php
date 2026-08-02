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
    $query = "SELECT eventDate, slotID, eventName, capacity FROM event_slots WHERE eventDate=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();
}

/* Event Date */
$eventDateQuery = "SELECT DISTINCT eventDate FROM event_slots";
$eventDateResult = mysqli_query($conn, $eventDateQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Event Booking</title>
    <style>
        * {
            text-decoration: none;
        }

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
    <button><a href="profile.php">My Profile</a></button>
    <h1>
        Booking Form
    </h1>

    <div id="myBtnContainer">
        <button>
            <a href="?eventDate=all">Show all</a>
        </button>

        <?php
        while ($eventDateCol = mysqli_fetch_assoc($eventDateResult)) {

            $date = $eventDateCol['eventDate'];
            echo "<button><a href='?eventDate=$date'>$date</a></button>";
        }

        if (isset($_GET['error_message'])) {
            $error_message = $_GET['error_message'];
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>
    </div>
    <br>
    <table width="700">
        <tr>
            <th width='100'>Event Date</th>
            <th>Event ID</th>
            <th>Event Name</th>
            <th width='50'>Slots Available</th>
            <th width='50'></th>
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
                    <?php echo $row['slotID']; ?>
                </td>
                <td>
                    <?php echo $row['eventName']; ?>
                </td>
                <td>
                    <?php echo $row['capacity']; ?>/3
                </td>
                <td>
                    <button onclick="confirmBook('<?php echo $row['slotID']; ?>')">
                        Book
                    </button>

                </td>
            </tr>
        <?php
        }
        ?>


    </table>

    <script>
        function confirmBook(slotID) {
            let text = "Are you sure you want to book the event with ID:" + slotID + "?";

            if (confirm(text) == true) {

                window.location.href = "runBooking.php?slotID=" + slotID;
            }
        }
    </script>


</body>

</html>