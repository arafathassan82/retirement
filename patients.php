<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patients</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1) {
        header("Location: login.php");
      }
    ?>
    <h1>Patients</h1>
    <!-- table which displays all patients, and a search option for each column -->
  </body>
</html>
