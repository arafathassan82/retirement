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
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 6) {
        header("Location: login.php");
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

    <!-- This is where we put the table result from the post query (should also spin up using the current date if no post was sent) -->
    <table>
      <tr>
        <th>Morning</th>
        <th>Afternoon</th>
        <th>Night</th>
        <th>Breakfast</th>
        <th>Lunch</th>
        <th>Dinner</th>
      </tr>
    <?php
      if (isset($_POST['submit'])) {
        $date = $_POST['date'];
      } else {
        $date = date('Y-m-d');
      }

      $reports_query = "SELECT * FROM Reports r WHERE r.date = '$date' AND r.patientid = {$_SESSION['user']};";
      $result = mysqli_query($conn, $reports_query);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck>0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          if ($row['morning'] == 1) {
            echo "<td><input type='checkbox' checked onclick='return false;'></td>";
          } else {
            echo "<td><input type='checkbox' onclick='return false;'></td>";
          }
          if ($row['afternoon'] == 1) {
            echo "<td><input type='checkbox' checked onclick='return false;'></td>";
          } else {
            echo "<td><input type='checkbox' onclick='return false;'></td>";
          }
          if ($row['night'] == 1) {
            echo "<td><input type='checkbox' checked onclick='return false;'></td>";
          } else {
            echo "<td><input type='checkbox' onclick='return false;'></td>";
          }
          if ($row['breakfast'] == 1) {
            echo "<td><input type='checkbox' checked onclick='return false;'></td>";
          } else {
            echo "<td><input type='checkbox' onclick='return false;'></td>";
          }
          if ($row['lunch'] == 1) {
            echo "<td><input type='checkbox' checked onclick='return false;'></td>";
          } else {
            echo "<td><input type='checkbox' onclick='return false;'></td>";
          }
          if ($row['dinner'] == 1) {
            echo "<td><input type='checkbox' checked onclick='return false;'></td>";
          } else {
            echo "<td><input type='checkbox' onclick='return false;'></td>";
          }
          echo "</tr>";
        }
      }
    ?>
    </table>

  </body>
</html>
