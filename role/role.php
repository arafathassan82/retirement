<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Role</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1) {
        header("Location: ../login/login.php");
      }
    ?>
    <h1>Role</h1>
    <!-- table displaying all roles and their access levels -->

    <form method="post">
      New Role: <input type="text" name="new_role">
      Access Level: <input type="text" name="access_level">

      <input type="submit" value="Ok" name="role">
    </form>
  </body>
</html>
