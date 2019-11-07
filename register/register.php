<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <script type="text/javascript" src="register.js"></script>
  </head>
  <body>
    <form method="post" id="registerform">
      <select name="role" id="role" onchange="displayExtras();">
        <!-- php which generates options based on the roles in the database -->

        <?php
          include "../database/db.php";
          $roles = "SELECT * FROM `Roles`;";
          $result = mysqli_query($conn, $roles);
          $resultCheck = mysqli_num_rows($result);

          if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
              $roleid = $row['id'];
              $rolename = $row['name'];

              echo "<option value='$roleid'>$rolename</option>";
            }
          }
        ?>

      </select>
      First Name: <input type="text" name="fName">
      Last Name: <input type="text" name="lName">
      Email ID: <input type="text" name="email">
      Phone: <input type="text" name="phone">
      Password: <input type="password" name="password">
      Date of Birth: <input type="date" name="date">
      <!-- Only if you're a patient
      Emergency Contact: <input type="text" name="emergency">
      Relation to Emergency Contact: <input type="text" name="relation"> -->
      <!-- Family code, if the role is a family member -->

      <input type="submit" name="register">
    </form>
  </body>
</html>
