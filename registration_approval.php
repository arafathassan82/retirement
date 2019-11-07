<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration Approval</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
    ?>
    <h1>Registration Approval</h1>
    <!-- a table with the name and role of all unapproved registrations, and an option yes/no whether to approve either of them -->
  </body>
</html>
