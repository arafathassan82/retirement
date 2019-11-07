<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post">
      Patient ID: <input type="number">
      <input type="submit" name="patient">
    </form>

    <!-- display total due for patient sent in from above input -->

    <!-- another form to put in a new payment for said patient, only is generated when patient ID has been sent in -->
    <!-- make sure total due goes up every day (not a thing that is done on HTML) -->
  </body>
</html>
