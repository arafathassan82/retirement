<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include "$root/retirement-home/database/db.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 6) {
        header("Location: login.php");
      }
    ?>
    <h1>Home</h1>
    <form method="post">
      <?php
        $sql = "SELECT id, fname, lname FROM Users;";
      ?>
      <p>Patient ID: </p>
      <!-- should be filled in with today's date by default -->
      <input type="date" name="date">
      <input type="submit" name="submit">
    </form>

  </body>
</html>
