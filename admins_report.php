<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin's Report</title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1) {
        header("Location: home.php");
      }
    ?>
    <h1>Admin's Report</h1>
    <form method="post">
      Date: <input type="date" name="date">
      <input type="submit" name="submit" value="submit">
    </form>

    <?php
      $date = date('Y-m-d');
      if (isset($_POST['submit'])) {
        echo "<h2>Missed Patient Activity for {$_POST['date']}:</h2>";
      } else {
        echo "<h2>Missed Patient Activity for $date:</h2>";
      }
    ?>

    <!-- table displaying relevant data only for aa certain date (submitted by input above) for anything that has a false in it -->
    <table>
      <tr>
        <th>Patient's Name</th>
        <th>Morning Medicine</th>
        <th>Afternoon Medicine</th>
        <th>Night Medicine</th>
        <th>Breakfast</th>
        <th>Lunch</th>
        <th>Dinner</th>
      </tr>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/database/db.php";

      if (isset($_POST['submit'])) {
        $sql = "SELECT * FROM Reports r JOIN Users u ON u.id = r.patientid WHERE date = '{$_POST['date']}' AND (morning != 1 OR afternoon != 1 OR night != 1 OR breakfast != 1 OR lunch != 1 OR dinner != 1);";

        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['fname']} {$row['lname']}</td>";
            echo "<td>{$row['morning']}</td>";
            echo "<td>{$row['afternoon']}</td>";
            echo "<td>{$row['night']}</td>";
            echo "<td>{$row['breakfast']}</td>";
            echo "<td>{$row['lunch']}</td>";
            echo "<td>{$row['dinner']}</td>";
            echo "</tr>";
          }
        }
      } else {
        $date = date('Y-m-d');
        $sql = "SELECT * FROM Reports r JOIN Users u ON u.id = r.patientid WHERE date = '$date' AND (morning != 1 OR afternoon != 1 OR night != 1 OR breakfast != 1 OR lunch != 1 OR dinner != 1);";

        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['fname']} {$row['lname']}</td>";
            echo "<td>{$row['morning']}</td>";
            echo "<td>{$row['afternoon']}</td>";
            echo "<td>{$row['night']}</td>";
            echo "<td>{$row['breakfast']}</td>";
            echo "<td>{$row['lunch']}</td>";
            echo "<td>{$row['dinner']}</td>";
            echo "</tr>";
          }
        }
      }
      echo "</table>";
    ?>
    </table>
  </body>
</html>
