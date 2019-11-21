<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <?php
      if (!isset($is_home)) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/includes/nav.php";
        // always include session_start in pages that you want to reference session variables in.
        if ($_SESSION['role'] != 5) {
          header("Location: home.php");
        }

        include 'database/db.php';
        $dailyreportscheck = "SELECT `date` FROM `Reports` ORDER BY `date` ASC;";
        $result = mysqli_query($conn, $dailyreportscheck);
        $resultCheck = mysqli_num_rows($result);

        $currentdate = date('Y-m-d');
        $row = mysqli_fetch_assoc($result);
        if($row['date'] != $currentdate){
          $patients = "SELECT userid FROM `Patients`;";
          $patientsresult = mysqli_query($conn, $patients);
          $resultCheckPatients = mysqli_num_rows($patientsresult);

          if($resultCheckPatients > 0){
            while($patientsRow = mysqli_fetch_assoc($patientsresult)){
              $id = $patientsRow['userid'];

              $reportsadd = "INSERT INTO `Reports` (`patientid`, `morning`, `afternoon`, `night`, `breakfast`, `lunch`, `dinner`, `date`)
              VALUES ($id, 0, 0, 0, 0, 0, 0, '$currentdate');";
              mysqli_query($conn, $reportsadd);
            }
          }
        }
      }
    ?>
    <h1>Home</h1>
    <form method="post">
      Date: <input type="date" name="date" value="<?php $date = date("Y-m-d"); echo $date ?>">
      Family Code: <input type="text" name="family_code">
      Patient ID: <input type="number" name="patient_id">
      <input type="submit" value="Status" name="submit">
    </form>

    <!-- pull up a table representing the current status of a resident's medicine and meals
         based on the patient id, date and family code sent through in form -->
    <?php
      if(isset($_POST['family_code'])){
        echo "<table>
          <tr>
            <th>Doctor's Name</th>
            <th>Doctor's Appointment</th>
            <th>Caregiver's Name</th>
            <th>Morning Medicine</th>
            <th>Afternoon Medicine</th>
            <th>Night Medicine</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
          </tr>";

        include "database/db.php";
        $today = date('Y-m-d');

        $sql = "SELECT morning, afternoon, night, breakfast, lunch, dinner FROM `Patients`
        JOIN `Reports` ON `Reports`.patientid = `Patients`.userid
        JOIN `Roster` ON `Reports`.`date` = `Roster`.`date`
        WHERE `Patients`.familycode = '{$_POST['family_code']}' OR `Patients`.userid = {$_POST['patient_id']}
        AND `Reports`.`date` = '$today';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        $sql2 = "SELECT isfinished, doctorid, `Users`.fname AS fname, `Users`.lname AS lname FROM `Appointments`
        JOIN `Users` ON `Appointments`.doctorid = `Users`.id
        WHERE patientid = {$_POST['patient_id']}
        AND `Appointments`.`date` = '$today';";
        $result2 = mysqli_query($conn, $sql2);
        $resultCheck2 = mysqli_num_rows($result2);

        
        echo "<tr>";

        if($resultCheck > 0){
          while($row = mysqli_fetch_assoc($result)){
            if($resultCheck2 > 0){
              $row2 = mysqli_fetch_assoc($result2);
              echo "<td>{$row2['fname']} {$row2['lname']}</td>";
              
              if($row2['isfinished'] == 1){
                echo "<td>✔️</td>";
              } else {
                echo "<td>❌</td>";
              }
            } else {
              echo "<td>No appointment</td>";
              echo "<td>No appointment</td>";
            }
            
            echo "<td>Caregiver Name not yet implemented</td>";

            if($row['morning'] == 1){
              echo "<td>✔️</td>";
            } else {
              echo "<td>❌</td>";
            }

            if($row['afternoon'] == 1){
              echo "<td>✔️</td>";
            } else {
              echo "<td>❌</td>";
            }

            if($row['night'] == 1){
              echo "<td>✔️</td>";
            } else {
              echo "<td>❌</td>";
            }

            if($row['breakfast'] == 1){
              echo "<td>✔️</td>";
            } else {
              echo "<td>❌</td>";
            }

            if($row['lunch'] == 1){
              echo "<td>✔️</td>";
            } else {
              echo "<td>❌</td>";
            }

            if($row['dinner'] == 1){
              echo "<td>✔️</td>";
            } else {
              echo "<td>❌</td>";
            }

            echo "</tr>";
          }
        }

        echo "</table>";
      }
    ?>

  </body>
</html>
