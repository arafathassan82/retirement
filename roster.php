<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Roster</title>
  </head>
  <body>
    <?php
      if (!isset($is_home)) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/includes/nav.php";
        // always include session_start in pages that you want to reference session variables in.
        if (!isset($_SESSION['role'])) {
          header("Location: home.php");
        }
      }
    ?>
    <h1>Roster</h1>
    <form method="post">
      Date: <input name="date" type="date">
      <input type="submit" value="check date" name="submit">

      <!-- when the form is submitted, show the people who are working on that date, like a schedule -->
    </form>
    <table>
      <tr>
        <th>Supervisor</th>
        <th>Doctor</th>
        <th>Group 1 Caregiver</th>
        <th>Group 2 Caregiver</th>
        <th>Group 3 Caregiver</th>
        <th>Group 4 Caregiver</th>
      </tr>
      <tr>
      <?php
        if(isset($_POST['date'])){
          include 'database/db.php';
          $sql = "SELECT * FROM `Roster` WHERE `date` = '{$_POST['date']}';";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if($resultCheck > 0){
            $row = mysqli_fetch_assoc($result);
            $supervisorid = $row['supervisorid'];
            $doctorid = $row['doctorid'];
            $caregiver1id = $row['caregiver1id'];
            $caregiver2id = $row['caregiver2id'];
            $caregiver3id = $row['caregiver3id'];
            $caregiver4id = $row['caregiver4id'];

            $supervisorresult = mysqli_query($conn, "SELECT fname, lname FROM `Users` WHERE id = $supervisorid;");
            $supervisorrow = mysqli_fetch_assoc($supervisorresult);
            echo "<th>{$supervisorrow['fname']} {$supervisorrow['lname']}</th>";

            $doctorresult = mysqli_query($conn, "SELECT fname, lname FROM `Users` WHERE id = $doctorid;");
            $doctorrow = mysqli_fetch_assoc($doctorresult);
            echo "<th>{$doctorrow['fname']} {$doctorrow['lname']}</th>";

            $caregiver1result = mysqli_query($conn, "SELECT fname, lname FROM `Users` WHERE id = $caregiver1id;");
            $caregiver1row = mysqli_fetch_assoc($caregiver1result);
            echo "<th>{$caregiver1row['fname']} {$caregiver1row['lname']}</th>";

            $caregiver2result = mysqli_query($conn, "SELECT fname, lname FROM `Users` WHERE id = $caregiver2id;");
            $caregiver2row = mysqli_fetch_assoc($caregiver2result);
            echo "<th>{$caregiver2row['fname']} {$caregiver2row['lname']}</th>";

            $caregiver3result = mysqli_query($conn, "SELECT fname, lname FROM `Users` WHERE id = $caregiver3id;");
            $caregiver3row = mysqli_fetch_assoc($caregiver3result);
            echo "<th>{$caregiver3row['fname']} {$caregiver3row['lname']}</th>";

            $caregiver4result = mysqli_query($conn, "SELECT fname, lname FROM `Users` WHERE id = $caregiver4id;");
            $caregiver4row = mysqli_fetch_assoc($caregiver4result);
            echo "<th>{$caregiver4row['fname']} {$caregiver4row['lname']}</th>";
          }
        }
      ?>
      </tr>
    </table>

  </body>
</html>
