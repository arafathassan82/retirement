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
      $user_id = "";
      $role = "";
      while($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['id'];
        $role = $row['roleid'];
      }
      session_start();
      $_SESSION['role'] = $role;
      $_SESSION['user'] = $user_id;

      header("Location: ../doctors_home.php", false);
    } else {
      echo "<span class='fail'>Incorrect Username or Password</span>";
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
