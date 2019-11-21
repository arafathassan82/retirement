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
        if ($_SESSION['role'] != 4) {
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

    <!-- table displaying all patients of the caregiver currently accessing this page, for today -->
    <!-- morning/afternoon/night and breakfast/lunch/dinner all have checkmarks, and there's a submit button to send in new data once filled out -->
    <table>
      <tr>
        <th>Name</th>
        <th>Morning Medicine</th>
        <th>Afternoon Medicine</th>
        <th>Night Medicine</th>
        <th>Breakfast</th>
        <th>Lunch</th>
        <th>Dinner</th>
      </tr>
      <form method="post">
        <?php
          $root = $_SERVER['DOCUMENT_ROOT'];
          include "$root/retirement-home/database/db.php";

          function set_string(&$triggers, $columnName, $set) {
            if ($triggers > 0) {
              $triggers += 1;
              if ($set == True) {
                return ", $columnName = 1";
              } else {
                return ", $columnName = 0";
              }
            } else {
              $triggers += 1;
              if ($set == True) {
                return "SET $columnName = 1";
              } else {
                return "SET $columnName = 0";
              }
            }
          }

          $date = date('Y-m-d');
          $sql = "SELECT morning, afternoon, night, breakfast, lunch, dinner, fname, lname, caregiver1id, caregiver2id, caregiver3id, caregiver4id, u.id AS uid FROM Reports r JOIN Users u ON u.id = r.patientid JOIN Roster ros ON ros.date = r.date WHERE r.date = '$date' AND (caregiver1id = {$_SESSION['user']} OR caregiver2id = {$_SESSION['user']} OR caregiver3id = {$_SESSION['user']} OR caregiver4id = {$_SESSION['user']});";

          if(isset($_POST['submit'])) {

            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck>0) {
              while($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['uid'];

                $set_values = "UPDATE Reports ";
                $count = 0;

                if(isset($_POST["{$user_id}_morning"])) {
                  $set_values .= set_string($count, "morning", True);
                } else {
                  $set_values .= set_string($count, "morning", False);
                }
                if(isset($_POST["{$user_id}_afternoon"])) {
                  $set_values .= set_string($count, "afternoon", True);
                } else {
                  $set_values .= set_string($count, "afternoon", False);
                }
                if(isset($_POST["{$user_id}_night"])) {
                  $set_values .= set_string($count, "night", True);
                } else {
                  $set_values .= set_string($count, "night", False);
                }
                if(isset($_POST["{$user_id}_breakfast"])) {
                  $set_values .= set_string($count, "breakfast", True);
                } else {
                  $set_values .= set_string($count, "breakfast", False);
                }
                if(isset($_POST["{$user_id}_lunch"])) {
                  $set_values .= set_string($count, "lunch", True);
                } else {
                  $set_values .= set_string($count, "lunch", False);
                }
                if(isset($_POST["{$user_id}_dinner"])) {
                  $set_values .= set_string($count, "dinner", True);
                } else {
                  $set_values .= set_string($count, "dinner", False);
                }

                if($count > 0) {
                  $set_values .= " WHERE patientid = $user_id AND date = '$date';";
                  mysqli_query($conn, $set_values);
                }

              }
            }
          }

          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck>0) {
            while($row = mysqli_fetch_assoc($result)) {
              $user_id = $row['uid'];

              echo "<tr>";
              echo "<td>{$row['fname']} {$row['lname']}</td>";
              if ($row['morning'] == 1) {
                echo "<td><input type='checkbox' name='{$user_id}_morning' value=1 checked></td>";
              } else {
                echo "<td><input type='checkbox' name='{$user_id}_morning' value=1 ></td>";
              }
              if ($row['afternoon'] == 1) {
                echo "<td><input type='checkbox' name='{$user_id}_afternoon' checked></td>";
              } else {
                echo "<td><input type='checkbox' name='{$user_id}_afternoon'></td>";
              }
              if ($row['night'] == 1) {
                echo "<td><input type='checkbox' name='{$user_id}_night' checked></td>";
              } else {
                echo "<td><input type='checkbox' name='{$user_id}_night'></td>";
              }
              if ($row['breakfast'] == 1) {
                echo "<td><input type='checkbox' name='{$user_id}_breakfast' checked></td>";
              } else {
                echo "<td><input type='checkbox' name='{$user_id}_breakfast'></td>";
              }
              if ($row['lunch'] == 1) {
                echo "<td><input type='checkbox' name='{$user_id}_lunch' checked></td>";
              } else {
                echo "<td><input type='checkbox' name='{$user_id}_lunch'></td>";
              }
              if ($row['dinner'] == 1) {
                echo "<td><input type='checkbox' name='{$user_id}_dinner' checked></td>";
              } else {
                echo "<td><input type='checkbox' name='{$user_id}_dinner'></td>";
              }
              echo "</tr>";
            }
          }
        ?>
        <input type="submit" name="submit">
      </form>
    </table>
  </body>
</html>
