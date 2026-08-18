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

    $click_query = "SELECT G1_click FROM game WHERE UID = '$uid'";
    $click_result = $conn->query($click_query);

    if ($click_result && $click_result->num_rows > 0) {
        $click_row = $click_result->fetch_assoc();

        // Assign the column value to your variable
        $curr_click = (int)$click_row['G1_click'];

        if ($curr_click >= 2) {
            $message = "Limit reached! You cannot submit more than 2 times.";
        } else {
            $sql = "UPDATE game SET G1 = '$selected_no', G1_click = $curr_click +1 WHERE UID = '$uid'";

            if ($conn->query($sql) === TRUE) {
                $message = "Updated! Play count: " . $curr_click + 1 . "/2";
            }
        }
    }
}

/* Create an array to store Game 1 counts for different emails */
/* if (!isset($_SESSION['game1_play_count'])) {
    $_SESSION['game1_play_count'] = [];
} */

/* First time this email plays Game 1 */
/* if (!isset($_SESSION['game1_play_count'][$email])) {
    $_SESSION['game1_play_count'][$email] = 0;
} */


/* if (isset($_POST['btn_no'])) {
    $selected_no = (int)$_POST['btn_no'];

    if ($_SESSION['game1_play_count'][$email] >= 2) {
        $_SESSION['message'] = "Limit reached! You cannot submit more than 2 times.";
        header("Location:game1.php");
        exit();
    } else {
        $sql = "UPDATE game SET G1 = '$selected_no' WHERE email = '$email'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['game1_play_count'][$email]++;
            $_SESSION['message'] = "Updated! Play count: " . $_SESSION['game1_play_count'][$email] . "/2";
            header("Location:game1.php");
            exit();
        }
    }
} */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week1- Game1</title>
</head>

<body>
    <a href="game.php">Back</a>
    <h1>Game 1</h1>
    <?php
    echo "<p style='color: red;'>$message</p>";
    /*     if (isset($_SESSION['message'])) {
        echo "<p style='color: red;'>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    } */
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