<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin's Report</title>
  </head>
  <body>
    <h1>Admin's Report</h1>
    <form method="post">
      Date: <input type="date" name="date">
      <input type="submit" name="submit" value="submit">
    </form>

    <!-- table displaying relevant data only for aa certain date (submitted by input above) for anything that has a false in it -->
  </body>
</html>
