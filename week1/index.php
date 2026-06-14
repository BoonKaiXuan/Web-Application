<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get user input from the form
  $userEmail = $_POST['email'];
  $userPassword = $_POST['password'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //Execute sql query
  $sql = "SELECT email, password FROM student WHERE email = '$userEmail' AND password = '$userPassword'";

  $result = $conn->query($sql);

  //Process the result set
  if ($result->num_rows > 0) {
    echo "User Found";
    
  } else {
    echo "User Not Found";
  }

  $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <style>
    *{
      font-size: 20px;
    }

    body{
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
  </style>

</head>

<body>

  <div id="email">
    <form taget="_self" method="POST">
      <h2>Enter your Email:</h2>
      <input type="text" name="email">
      <br>
      <h2>Password</h2>
      <input type="password" name="password">
      <input type="submit">
    </form>
  </div>

</body>
</html>