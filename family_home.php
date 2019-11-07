<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 5) {
        header("Location: login/login.php");
      }
    ?>
    <h1>Home</h1>
    <form method="post">
      Date: <input type="date" name="date">
      Family Code: <input type="number" name="family_code">
      Patient ID: <input type="number" name="patient_id">
      <input type="submit" value="Status" name="submit">
    </form>

    <!-- pull up a table representing the current status of a resident's medicine and meals
         based on the patient id, date and family code sent through in form -->

  </body>
</html>
