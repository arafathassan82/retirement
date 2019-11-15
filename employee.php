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
            <input type="number" name="role_query">
          </td>
          <td>
            <input type="text" name="salary_query">
          </td>
          <td>
            <input type="submit" value="submit">
          </td>
        </form>
      </tr>
      <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/database/db.php";

        
      ?>
    </table>
  </body>
</html>
