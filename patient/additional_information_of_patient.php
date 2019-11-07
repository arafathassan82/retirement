<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Additional Information of Patient</title>
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
    <form method="post">
      Patient ID: <input type="number" name="patient_id">
      Group: <input type="text" name="group">
      Admission Date: <input type="date" name="admission_date">
      Date: <input type="date" name="date">
      Doctor:
      <select name="doctors">
        <!-- options representing all doctors -->
      </select>

      <input type="submit" name="info_of_patient"
    </form>
  </body>
</html>
