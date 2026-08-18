<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uid = $_SESSION['UID'];
$message = "";
//must declare an empty before the condition otherwise it cannot be called out

if (isset($_POST['btn_no'])) {
    $selected_no = (int)$_POST['btn_no'];

    $click_query = "SELECT G3_click FROM game WHERE UID = '$uid'";
    $click_result = $conn->query($click_query);

    if ($click_result && $click_result->num_rows > 0) {
        $click_row = $click_result->fetch_assoc();

        // Assign the column value to your variable
        $curr_click = (int)$click_row['G3_click'];

        if ($curr_click >= 2) {
            $message = "Limit reached! You cannot submit more than 2 times.";
        } else {
            $sql = "UPDATE game SET G3 = '$selected_no', G3_click = $curr_click +1 WHERE UID = '$uid'";

            if ($conn->query($sql) === TRUE) {
                $message = "Updated! Play count: " . $curr_click + 1 . "/2";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week1- Game3</title>
</head>

<body>
    <a href="game.php">Back</a>
    <h1>Game 3</h1>
    <?php
    echo "<p style='color: red;'>$message</p>";
    ?>
    <form method="POST">
        <button type="submit" name="btn_no" value="0">0</button>
        <button type="submit" name="btn_no" value="1">1</button>
        <button type="submit" name="btn_no" value="2">2</button>
        <button type="submit" name="btn_no" value="3">3</button>
        <button type="submit" name="btn_no" value="4">4</button>
        <button type="submit" name="btn_no" value="5">5</button>
    </form>



</body>

</html>