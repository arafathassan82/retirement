<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patients</title>
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
    <h1>Patients</h1>
    <!-- table which displays all patients, and a search option for each column -->
    <table>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Emergency Contact</th>
        <th>Emergency Contact Name</th>
        <th>Admission Date</th>
      </tr>
      <tr>
        <form method = "post">
          <td>
            <input type="number" name="id_query">
          </td>
          <td>
            <input type="text" name="fname_query">
          </td>
          <td>
            <input type="text" name="lname_query">
          </td>
          <td>
            <input type="number" name="age_query">
          </td>
          <td>
            <input type="text" name="emergency_contact_query">
          </td>
          <td>
            <input type="text" name="emergency_contact_name_query">
          </td>
          <td>
            <input type="text" name="admission_query">
          </td>
          <td>
            <input type="submit" value="submit">
          </td>
        </form>
      </tr>
      <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/database/db.php";
        $date = date('Y-m-d');

        $sql_query = "SELECT * FROM (SELECT CAST(DATEDIFF('$date', dateofbirth) / 365.25 AS INTEGER) AS age, u.id AS uid, roleid, fname, lname, dateofbirth, familycode, emergencycontact, emergencyrelation, admissiondate FROM Users u JOIN Patients p ON p.userid = u.id) AS InnerTable WHERE ";
        $sql_arr = array();
        if(isset($_POST['id_query']) and $_POST['id_query'] != "") {
          $sql_arr["id"] = $_POST['id_query'];
        }
        if(isset($_POST['fname_query']) and $_POST['fname_query'] != "") {
          $sql_arr["fname"] = $_POST['fname_query'];
        }
        if(isset($_POST['lname_query']) and $_POST['lname_query'] != "") {
          $sql_arr["lname"] = $_POST['lname_query'];
        }
        if(isset($_POST['age_query']) and $_POST['age_query'] != "") {
          $sql_arr["age"] = $_POST['age_query'];
        }
        if(isset($_POST['emergency_contact_query']) and $_POST['emergency_contact_query'] != "") {
          $sql_arr["emergencycontact"] = $_POST['emergency_contact_query'];
        }
        if(isset($_POST['emergency_contact_name_query']) and $_POST['emergency_contact_name_query'] != "") {
          $sql_arr["emergencyrelation"] = $_POST['emergency_contact_name_query'];
        }
        if(isset($_POST['admission_query']) and $_POST['admission_query'] != "") {
          $sql_arr["admissiondate"] = $_POST['admission_query'];
        }

        $count = 0;
        foreach ($sql_arr as $key => $val) {
          if ($count >= 1) {
            if ($key == 'id'){
              $sql_query .= "AND u$key = $val ";
            } else if ($key == 'age') {
              $sql_query .= "AND $key = $val ";
            } else {
              $sql_query .= "AND $key = '$val' ";
            }
          } else {
            if ($key == 'id'){
              $sql_query .= "u$key = $val ";
            } else if ($key == 'age') {
              $sql_query .= "$key = $val ";
            } else {
              $sql_query .= "$key = '$val' ";
            }
          }
          $count += 1;
        }
        if($count > 0) {
          $sql_query .= "AND roleid = 6;";
        } else {
          $sql_query .= "roleid = 6;";
        }

        $result = mysqli_query($conn, $sql_query);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['uid']}</td>";
            echo "<td>{$row['fname']}</td>";
            echo "<td>{$row['lname']}</td>";
            echo "<td>{$row['age']}</td>";
            echo "<td>{$row['emergencycontact']}</td>";
            echo "<td>{$row['emergencyrelation']}</td>";
            echo "<td>{$row['admissiondate']}</td>";
            echo "</tr>";
          }
        }
      ?>
    </table>
  </body>
</html>
