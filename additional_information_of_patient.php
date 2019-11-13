<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Additional Information of Patient</title>
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

        if($results){
          while($row = mysqli_fetch_assoc($results)){
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            
            echo "Patient ID: <input type=\"text\" name=\"patient_id\" value=\"$id\" readonly>";
            echo "Patient Name: <input type=\"text\" name=\"name\" value=\"$fname $lname\" readonly>";
            echo "Group: <input type=\"number\" name=\"group\" value=\"{$_POST['group']}\" readonly>";
            echo "Admission Date: <input type=\"text\" name=\"admission_date\" value=\"{$_POST['admission_date']}\" readonly>";
          }
          echo "<input type=\"submit\" name=\"submit_changes\" value=\"Confirm\">";
        }
      } else {
        echo "Patient ID: <input type=\"number\" name=\"patient_id\">
        Group: <input type=\"number\" name=\"group\">
        Admission Date: <input type=\"date\" name=\"admission_date\">";
        echo "<input type=\"submit\" name=\"info_of_patient\">";
      }

      if(isset($_POST['submit_changes'])){
        include_once "database/db.php";
        // add more columns to user in order to change
        $sql = "UPDATE `Users` SET admissiondate = '{$_POST['admission_date']}', `group` = {$_POST['group']}
        WHERE id = {$_POST['patient_id']};";
        mysqli_query($conn, $sql);
        header("Location: additional_information_of_patient.php");
      }
      ?>
    </form>
  </body>
</html>
