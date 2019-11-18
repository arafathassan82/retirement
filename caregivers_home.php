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


          function set_string(&$triggers, $columnName) {
            if ($triggers > 0) {
              $triggers += 1;
              return ", $columnName = 1";
            } else {
              $triggers += 1;
              return "SET $columnName = 1";
            }
          }

          $date = date('Y-m-d');
          $sql = "SELECT morning, afternoon, night, breakfast, lunch, dinner, fname, lname, u.id AS uid FROM Reports r JOIN Users u ON u.id = r.patientid WHERE r.date = '$date' AND r.caregiverid = {$_SESSION['user']};";

          if(isset($_POST['submit'])) {

            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck>0) {
              while($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['uid'];

                // could maybe be faster if we kept track of the amount of if statements triggered (using a counter), and built an UPDATE statement to use at the end of the while loop
                $set_values = "UPDATE Reports ";
                $count = 0;

                if(isset($_POST["{$user_id}_morning"])) {
                  $set_values .= set_string($count, "morning");
                }
                if(isset($_POST["{$user_id}_afternoon"])) {
                  $set_values .= set_string($count, "afternoon");
                }
                if(isset($_POST["{$user_id}_night"])) {
                  $set_values .= set_string($count, "night");
                }
                if(isset($_POST["{$user_id}_breakfast"])) {
                  $set_values .= set_string($count, "breakfast");
                }
                if(isset($_POST["{$user_id}_lunch"])) {
                  $set_values .= set_string($count, "lunch");
                }
                if(isset($_POST["{$user_id}_dinner"])) {
                  $set_values .= set_string($count, "dinner");
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
