<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Role</title>
  </head>
  <body>
    <h1>Role</h1>
    <!-- table displaying all roles and their access levels -->

    <form method="post">
      New Role: <input type="text" name="new_role">
      Access Level: <input type="text" name="access_level">

      <input type="submit" value="Ok" name="role">
    </form>
  </body>
</html>
