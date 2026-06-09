<?php
$servername = "localhost";
$username = "aliceboon";
$password = "GFn/4dHUq(39b_d@";
$dbname = "aliceboon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $userPassword);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "User Found";
} else {
    echo "User Not Found";
}

$stmt->close();
$conn->close();
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