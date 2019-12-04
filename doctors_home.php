<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
    <title>Home</title>
  </head>
  <body>
    <?php
      if (!isset($is_home)) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/includes/nav.php";
        // always include session_start in pages that you want to reference session variables in.
        if ($_SESSION['role'] != 2) {
          header("Location: home.php");
        }
      }
    ?>
    <main>
      <h1>Home</h1>
      <!-- table displaying older appointments of patients -->
      <h2>Previous Appointments</h2>
      <table>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Date</th>
          <th>Comment</th>
          <th>Morning Med</th>
          <th>Afternoon Med</th>
          <th>Night Med</th>
        </tr>
        <tr>
          <form method = "post">
            <td>
              <input type="text" name="fname_query" value="<?php if(isset($_POST['fname_query'])) echo $_POST['fname_query']; ?>">
            </td>
            <td>
              <input type="text" name="lname_query" value="<?php if(isset($_POST['lname_query'])) echo $_POST['lname_query']; ?>">
            </td>
            <td>
              <input type="date" name="date_query" value="<?php if(isset($_POST['date_query'])) echo $_POST['date_query']; ?>">
            </td>
            <td>
              <input type="text" name="comment_query" value="<?php if(isset($_POST['comment_query'])) echo $_POST['comment_query']; ?>">
            </td>
            <td>
              <input type="text" name="morning_query" value="<?php if(isset($_POST['morning_query'])) echo $_POST['morning_query']; ?>">
            </td>
            <td>
              <input type="text" name="afternoon_query" value="<?php if(isset($_POST['afternoon_query'])) echo $_POST['afternoon_query']; ?>">
            </td>
            <td>
              <input type="text" name="night_query" value="<?php if(isset($_POST['night_query'])) echo $_POST['night_query']; ?>">
            </td>
            <td class="form-row-submit">
              <input type="submit" value="submit">
            </td>
          </form>
        </tr>
        <?php
          $root = $_SERVER['DOCUMENT_ROOT'];
          include "$root/retirement-home/database/db.php";
          $date = date('Y-m-d');

          $sql_query = "SELECT * FROM Appointments a JOIN Users u ON u.id = a.patientid WHERE doctorid = {$_SESSION['user']} AND date <= '$date' AND isfinished = 1 ";
          $sql_arr = array();
          if(isset($_POST['fname_query']) and $_POST['fname_query'] != "") {
            $sql_arr["fname"] = $_POST['fname_query'];
          }
          if(isset($_POST['lname_query']) and $_POST['lname_query'] != "") {
            $sql_arr["lname"] = $_POST['lname_query'];
          }
          if(isset($_POST['date_query']) and $_POST['date_query'] != "") {
            $sql_arr["date"] = $_POST['date_query'];
          }
          if(isset($_POST['comment_query']) and $_POST['comment_query'] != "") {
            $sql_arr["comment"] = $_POST['comment_query'];
          }
          if(isset($_POST['morning_query']) and $_POST['morning_query'] != "") {
            $sql_arr["morning"] = $_POST['morning_query'];
          }
          if(isset($_POST['afternoon_query']) and $_POST['afternoon_query'] != "") {
            $sql_arr["afternoon"] = $_POST['afternoon_query'];
          }
          if(isset($_POST['night_query']) and $_POST['night_query'] != "") {
            $sql_arr["night"] = $_POST['night_query'];
          }

          foreach ($sql_arr as $key => $val) {
            $sql_query .= "AND $key = '$val' ";
          }
          $sql_query .= "AND roleid = 6;";

          $result = mysqli_query($conn, $sql_query);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck>0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td><a href=\"patient_of_doctor.php?id={$row['id']}\">{$row['fname']}</a></td>";
              echo "<td><a href=\"patient_of_doctor.php?id={$row['id']}\">{$row['lname']}</a></td>";
              echo "<td>{$row['date']}</td>";
              echo "<td>{$row['comment']}</td>";
              echo "<td>{$row['morning']}</td>";
              echo "<td>{$row['afternoon']}</td>";
              echo "<td>{$row['night']}</td>";
              echo "</tr>";
            }
          }
        ?>
      </table>

      <h2>Upcoming Appointments</h2>

      <form method="post">
        Date: <input type="date" name="date" value="<?php echo date('Y-m-d') ?>">
        <input type="submit" name="upcoming_appointments" value="upcoming appointments">
      </form>
      <table>
        <tr>
          <th>Name</th>
          <th>Date</th>
        </tr>
        <?php
          if (isset($_POST['date']) and $_POST['date'] != "") {
            $post_date = $_POST['date'];
          } else {
            $post_date = date('Y-m-d');
          }
          $date = date('Y-m-d');
          $sql = "SELECT u.id, fname, lname, a.date FROM Appointments a JOIN Users u ON a.patientid = u.id WHERE a.date <= '$post_date' AND a.date >= '$date' AND a.doctorid = {$_SESSION['user']} AND isfinished = 0;";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck>0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td><a href=\"patient_of_doctor.php?id={$row['id']}\">{$row['fname']} {$row['lname']}</a></td>";
              echo "<td>{$row['date']}</td>";
              echo "</tr>";
            }
          }
        ?>
      </table>
    </main>
  </body>
</html>
