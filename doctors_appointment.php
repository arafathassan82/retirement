<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctor's Appointment</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1) {
        header("Location: login.php");
      }
    ?>
    <form method="post">
      <!-- Patient Name displays when a patient is selected -->
      <?php
      if(isset($_POST['patient_id'])){
        include_once "database/db.php";

        $sql = "SELECT id, fname, lname FROM `Users` WHERE id = {$_POST['patient_id']} AND approved = 1 AND roleid = 6";
        $results = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($results);

        if($resultCheck > 0){
          while($row = mysqli_fetch_assoc($results)){
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            
            echo "Patient ID: <input type=\"text\" name=\"patient_id\" value=\"$id\" readonly>";
            echo "Patient Name: <input type=\"text\" name=\"name\" value=\"$fname $lname\" readonly>";
            echo "Doctor: <input type=\"text\" name=\"doctor\" value=\"{$_POST['doctor']}\" readonly>";
            echo "Date: <input type=\"text\" name=\"date\" value=\"{$_POST['date']}\" readonly>";
          }
          echo "<input type=\"submit\" name=\"submit_changes\" value=\"Confirm\">";
        } else {
          header("Location: doctors_appointment.php");
        }
      } else {
        echo "Patient ID: <input type=\"number\" name=\"patient_id\">
        Doctor: <select name=\"doctor\">";

        // loop through doctors
        include_once "database/db.php";
        $doctorsquery = "SELECT id, fname, lname FROM `Users` WHERE roleid = 2 AND approved = 1";
        $result = mysqli_query($conn, $doctorsquery);
        $resultCheckDoctors = mysqli_num_rows($result);
        if($resultCheckDoctors > 0){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];

                echo "<option value=\"$id\">$fname $lname</option>";
            }
        }
        
        $today = date("Y-m-d");
        echo "</select>
        Date: <input type=\"date\" name=\"date\" value=\"$today\">";
        echo "<input type=\"submit\" name=\"info_of_appointment\">";
      }

      if(isset($_POST['submit_changes'])){
        include_once "database/db.php";
        // add more columns to user in order to change
        $sql = "INSERT INTO `Appointments` (patientid, doctorid, `date`, morning, afternoon, night, `comment`)
        VALUES ({$_POST['patient_id']}, {$_POST['doctor']}, '{$_POST['date']}', NULL, NULL, NULL, NULL);";
        mysqli_query($conn, $sql);
        header("Location: doctors_appointment.php");
      }
      ?>
    </form>
  </body>
</html>
