<?php
  session_start();
  session_destroy();
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
        $approved = $row['approved'];
      }
      if ($approved == 1) {
        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['user'] = $user_id;
        header("Location: home.php");
      } else {
        echo "<span class='fail'>User has not yet been approved</span>";
      }

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
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body id="login">
    <main>
      <form method="post">
        <h1>Login</h1>
        Email: <input type="text" name="email">
        Password: <input type="password" name="password">

        <input type="submit" name="login">

        Not a user? <a href="register.php">Register</a>
      </form>
    </main>
  </body>
</html>
