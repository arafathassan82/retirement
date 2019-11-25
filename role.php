<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include "$root/retirement-home/database/db.php";


  if (isset($_POST['role'])) {
    $new_role = $_POST['new_role'];
    $access_level = $_POST['access_level'];
    $query = "INSERT INTO `Roles` (`name`, `accesslevel`) VALUES ('$new_role', $access_level);";
    mysqli_query($conn, $query);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
    <title>Role</title>
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
    <main>
      <h1>Role</h1>
      <!-- table displaying all roles and their access levels -->
      <table id="role-table">
        <tr>
          <th>Role</th>
          <th>Access Level</th>
        </tr>
      <?php
        $sql = "SELECT name, accesslevel FROM roles;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {
          while($row = mysqli_fetch_assoc($result)) {
            $role = $row['name'];
            $access = $row['accesslevel'];
            echo "<tr>";
            echo "<td>$role</td>";
            echo "<td>$access</td>";
            echo "</tr>";
          }
        }
      ?>
      </table>

      <form method="post" class="new-role">
        New Role: <input type="text" name="new_role">
        Access Level: <input type="text" name="access_level">

        <input type="submit" value="Ok" name="role">
      </form>
    </main>
  </body>
</html>
