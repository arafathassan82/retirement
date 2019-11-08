<?php
  if(isset($_POST['register'])){
    include_once "../database/db.php";
    if(isset($_POST['familycode'])){
      $sql = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `familycode`, `emergencycontact`, `emergencyrelation`, `approved`, `group`)
      VALUES ('{$_POST['role']}', '{$_POST['fName']}', '{$_POST['lName']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}', '{$_POST['date']}', '{$_POST['familycode']}', '{$_POST['emergency']}', '{$_POST['relation']}', FALSE, 0);";
      mysqli_query($conn, $sql);
    } else {
      $sql = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `familycode`, `emergencycontact`, `emergencyrelation`, `approved`, `group`)
      VALUES ('{$_POST['role']}', '{$_POST['fName']}', '{$_POST['lName']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}', '{$_POST['date']}', NULL, NULL, NULL, FALSE, 0);";
      mysqli_query($conn, $sql);
    }
    header("Location: ../login/login.php");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <script type="text/javascript" src="register.js"></script>
  </head>
  <body>
    <form method="post" id="registerform" action="register.php">
      <select name="role" id="role" onchange="displayExtras();">
        <!-- php which generates options based on the roles in the database -->

        <?php
          include_once "../database/db.php";
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
      <!-- Family code, if the role is a family member -->

      <input type="submit" name="register" id="submit">
    </form>
  </body>
</html>
