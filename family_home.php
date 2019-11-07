<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
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
