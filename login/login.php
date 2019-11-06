<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include "$root/retirement-home/database/db.php";

  if(isset($_POST['email']) and isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);

    if($resultCheck>0) {

      while($row = mysqli_fetch_assoc($result)) {
        echo $row['fname'];

      }

    }
  }



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h1>Login</h1>
    <form method="post">
      Email: <input type="text" name="email">
      Password: <input type="password" name="password">

      <input type="submit" name="login">
    </form>
  </body>
</html>
