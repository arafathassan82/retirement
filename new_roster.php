<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New Roster</title>
  </head>
  <body>
    <form method="post">
      Date: <input type="date" name="date">
      Supervisor:
      <select name="supervisor">
        <!-- options based on supervisors in DB -->
      </select>
      Doctor:
      <select>
        <!-- options based on doctors in DB -->
      </select name="doctor">
      Caregiver 1:
      <select name="caregiver1">
        <!-- options based on caregivers in DB -->
      </select>

      Caregiver 2:
      <select name="caregiver2">
        <!-- options based on caregivers in DB -->
      </select>

      Caregiver 3:
      <select name="caregiver3">
        <!-- options based on caregivers in DB -->
      </select>

      Caregiver 4:
      <select name="caregiver4">
        <!-- options based on caregivers in DB -->
      </select>
    </form>
  </body>
</html>
