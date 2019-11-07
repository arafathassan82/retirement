<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin's Report</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1) {
        header("Location: login/login.php");
      }
    ?>
    <h1>Admin's Report</h1>
    <form method="post">
      Date: <input type="date" name="date">
      <input type="submit" name="submit" value="submit">
    </form>

    <!-- table displaying relevant data only for aa certain date (submitted by input above) for anything that has a false in it -->
  </body>
</html>
