<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Employee</title>
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
    <h1>Employee</h1>
    <!-- table with search options in each column, displayinng employees and their info -->
    <form method="post">
      Employee ID: <input type="number" name="employee_id">
      New Salary: <input type="number" name="salary">

      <input value="Ok" type="submit" name="new_salary">
    </form>
  </body>
</html>
