<?php
  //make sure this page is only accessible by admins
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Additional Information of Patient</title>
  </head>
  <body>
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
