<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
    <title>New Roster</title>
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
  </head>
  <body id="new_roster">
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1 and $_SESSION['role'] != 3) {
        header("Location: home.php");
      }

      if(isset($_POST['supervisor'])){
        include_once 'database/db.php';
        mysqli_query($conn, "INSERT INTO `Roster` (`date`, doctorid, supervisorid, caregiver1id, caregiver2id, caregiver3id, caregiver4id)
        VALUES ('{$_POST['date']}', {$_POST['doctor']}, {$_POST['supervisor']}, {$_POST['caregiver1']}, {$_POST['caregiver2']}, {$_POST['caregiver3']}, {$_POST['caregiver4']});");
        header("Location: new_roster.php");
      }
    ?>
    <main>
      <form method="post">
        <section id="date">
          Date: <input type="date" name="date" value="<?php $today = date("Y-m-d"); echo $today; ?>">
        </section>
        <section id="supervisordoctor">
          Supervisor:
          <select name="supervisor">
            <!-- options based on supervisors in DB -->
            <?php
              include_once 'database/db.php';
              $result = mysqli_query($conn, "SELECT id, fname, lname FROM `Users` WHERE roleid = 3 AND approved = 1;");
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value=\"{$row['id']}\">{$row['fname']} {$row['lname']}</option>";
                }
              }
            ?>
          </select>
          Doctor:
          <select name="doctor">
            <!-- options based on doctors in DB -->
            <?php
              include_once 'database/db.php';
              $result = mysqli_query($conn, "SELECT id, fname, lname FROM `Users` WHERE roleid = 2 AND approved = 1;");
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value=\"{$row['id']}\">{$row['fname']} {$row['lname']}</option>";
                }
              }
            ?>
          </select>
        </section>
        <section id="caregivers">
          Caregiver 1:
          <select name="caregiver1">
            <!-- options based on caregivers in DB -->
            <?php
              include_once 'database/db.php';
              $result = mysqli_query($conn, "SELECT id, fname, lname FROM `Users` WHERE roleid = 4 AND approved = 1;");
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value=\"{$row['id']}\">{$row['fname']} {$row['lname']}</option>";
                }
              }
            ?>
          </select>

          Caregiver 2:
          <select name="caregiver2">
            <!-- options based on caregivers in DB -->
            <?php
              include_once 'database/db.php';
              $result = mysqli_query($conn, "SELECT id, fname, lname FROM `Users` WHERE roleid = 4 AND approved = 1;");
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value=\"{$row['id']}\">{$row['fname']} {$row['lname']}</option>";
                }
              }
            ?>
          </select>

          Caregiver 3:
          <select name="caregiver3">
            <!-- options based on caregivers in DB -->
            <?php
              include_once 'database/db.php';
              $result = mysqli_query($conn, "SELECT id, fname, lname FROM `Users` WHERE roleid = 4 AND approved = 1;");
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value=\"{$row['id']}\">{$row['fname']} {$row['lname']}</option>";
                }
              }
            ?>
          </select>

          Caregiver 4:
          <select name="caregiver4">
            <!-- options based on caregivers in DB -->
            <?php
              include_once 'database/db.php';
              $result = mysqli_query($conn, "SELECT id, fname, lname FROM `Users` WHERE roleid = 4 AND approved = 1;");
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value=\"{$row['id']}\">{$row['fname']} {$row['lname']}</option>";
                }
              }
            ?>
          </select>
        </section>
        <input type="submit">
      </form>
    </main>
  </body>
</html>
