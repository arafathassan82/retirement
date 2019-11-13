<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Roster</title>
  </head>
  <body>
    <?php
      if (!isset($is_home)) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/includes/nav.php";
        // always include session_start in pages that you want to reference session variables in.
        if (!isset($_SESSION['role'])) {
          header("Location: login.php");
        }
      }
    ?>
    <h1>Roster</h1>
    <form method="post">
      Date: <input name="date" type="date">
      <input type="submit" value="check date" name="submit">

      <!-- when the form is submitted, show the people who are working on that date, like a schedule -->
    </form>

  </body>
</html>
