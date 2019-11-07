<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 4) {
        header("Location: login/login.php");
      }
    ?>
    <h1>Home</h1>

    <!-- table displaying all patients of the caregiver currently accessing this page -->
    <!-- morning/afternoon/night and breakfast/lunch/dinner all have checkmarks, and there's a submit button to send in new data once filled out -->
  </body>
</html>
