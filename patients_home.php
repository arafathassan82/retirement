<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include "$root/retirement-home/database/db.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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
        if ($_SESSION['role'] != 6) {
          header("Location: home.php");
        }
        include 'update_reports.php';
      }
    ?>
    <h1>Home</h1>
    <form method="post">
      <?php
        $sql = "SELECT id, fname, lname FROM Users WHERE id = {$_SESSION['user']};";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {
          while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
          }
        }
        echo "<p>Patient ID: $id</p>";
        echo "<p>Name: $fname $lname</p>";
      ?>
      <!-- should be filled in with today's date by default -->
      <input type="date" name="date" value="<?php echo date('Y-m-d');?>">
      <input type="submit" name="submit">
    </form>

    <?php
      if (isset($_POST['submit'])) {
        $date = $_POST['date'];
      } else {
        $date = date('Y-m-d');
      }

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

        $sql = "SELECT `group`, morning, afternoon, night, breakfast, lunch, dinner, caregiver1id, caregiver2id, caregiver3id, caregiver4id FROM `Patients`
        JOIN `Reports` ON `Reports`.patientid = `Patients`.userid
        JOIN `Roster` ON `Reports`.`date` = `Roster`.`date`
        WHERE `Patients`.userid = {$id}
        AND `Reports`.`date` = '$date';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        $sql2 = "SELECT isfinished, doctorid, `Users`.fname AS fname, `Users`.lname AS lname FROM `Appointments`
        JOIN `Users` ON `Appointments`.doctorid = `Users`.id
        WHERE patientid = {$id}
        AND `Appointments`.`date` = '$date';";
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
            
            $group = $row['group'];

            $caregiverquery = "";
            if($group == 1){
              $caregiverquery = "SELECT caregiver1id, fname, lname FROM `Roster`
              JOIN `Users` ON `Users`.id = `Roster`.caregiver1id;";
            } elseif($group == 2){
              $caregiverquery = "SELECT caregiver2id, fname, lname FROM `Roster`
              JOIN `Users` ON `Users`.id = `Roster`.caregiver2id;";
            } elseif($group == 3){
              $caregiverquery = "SELECT caregiver3id, fname, lname FROM `Roster`
              JOIN `Users` ON `Users`.id = `Roster`.caregiver3id;";
            } elseif($group == 4){
              $caregiverquery = "SELECT caregiver4id, fname, lname FROM `Roster`
              JOIN `Users` ON `Users`.id = `Roster`.caregiver4id;";
            }

            $caregiverresult = mysqli_query($conn, $caregiverquery);
            $caregiverResultCheck = mysqli_num_rows($caregiverresult);
            if($caregiverResultCheck > 0){
              $caregiverrow = mysqli_fetch_assoc($caregiverresult);
              echo "<td>{$caregiverrow['fname']} {$caregiverrow['lname']}</td>";
            } else {
              echo "<td>No caregiver assigned</td>";
            }

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
    ?>
    </table>

  </body>
</html>
