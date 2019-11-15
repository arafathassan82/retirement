<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Employee</title>
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
    <h1>Employee</h1>
    <!-- table with search options in each column, displayinng employees and their info -->
    <form method="post">
      Employee ID: <input type="number" name="employee_id">
      New Salary: <input type="number" name="salary">

      <input value="Ok" type="submit" name="new_salary">
    </form>

    <table>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Salary</th>
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
            <input type="text" name="role_query">
          </td>
          <td>
            <input type="number" name="salary_query">
          </td>
          <td>
            <input type="submit" value="submit">
          </td>
        </form>
      </tr>
      <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/database/db.php";

        $sql_query = "SELECT u.id, roleid, fname, lname, salary, name FROM Users u JOIN Roles r ON u.roleid = r.id WHERE ";
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
        if(isset($_POST['role_query']) and $_POST['role_query'] != "") {
          $sql_arr["name"] = $_POST['role_query'];
        }
        if(isset($_POST['salary_query']) and $_POST['salary_query'] != "") {
          $sql_arr["salary"] = $_POST['salary_query'];
        }

        $count = 0;
        foreach ($sql_arr as $key => $val) {
          if ($count >= 1) {
            if ($key == 'id' or $key == 'salary'){
              $sql_query .= "AND u.$key = $val ";
            } else {
              $sql_query .= "AND $key = '$val' ";
            }
          } else {
            if ($key == 'id' or $key == 'salary'){
              $sql_query .= "u.$key = $val ";
            } else {
              $sql_query .= "$key = '$val' ";
            }
          }
          $count += 1;
        }
        if($count > 0) {
          $sql_query .= "AND roleid NOT IN (6, 5);";
        } else {
          $sql_query .= "roleid NOT IN (6, 5);";
        }

        $result = mysqli_query($conn, $sql_query);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['fname']}</td>";
            echo "<td>{$row['lname']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['salary']}</td>";
            echo "</tr>";
          }
        }
      ?>
    </table>
  </body>
</html>
