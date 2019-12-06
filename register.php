<?php
  if(isset($_POST['register'])){
    include "database/db.php";
    if(isset($_POST['familycode'])){
      $sql = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `approved`)
      VALUES ('{$_POST['role']}', '{$_POST['fName']}', '{$_POST['lName']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}', '{$_POST['date']}', FALSE);";
      mysqli_query($conn, $sql);

      $get = "SELECT id FROM `Users` WHERE `roleid` = {$_POST['role']} AND `fname` = '{$_POST['fName']}' AND `lname` = '{$_POST['lName']}' AND `email` = '{$_POST['email']}' AND `phone` = '{$_POST['phone']}';";
      $result = mysqli_query($conn, $get);
      $row = mysqli_fetch_assoc($result);

      $sql2 = "INSERT INTO `Patients` (`userid`, `familycode`, `emergencycontact`, `emergencyrelation`, `group`, `due`, `admissiondate`)
      VALUES ({$row['id']}, '{$_POST['familycode']}', '{$_POST['emergency']}', '{$_POST['relation']}', 0, 0.0000, NULL);";
      mysqli_query($conn, $sql2);
    } elseif($_POST['role'] != 5){
      $sql = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `approved`)
      VALUES ('{$_POST['role']}', '{$_POST['fName']}', '{$_POST['lName']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}', '{$_POST['date']}', FALSE);";
      mysqli_query($conn, $sql);

      $get = "SELECT id FROM `Users` WHERE `roleid` = {$_POST['role']} AND `fname` = '{$_POST['fName']}' AND `lname` = '{$_POST['lName']}' AND `email` = '{$_POST['email']}' AND `phone` = '{$_POST['phone']}';";
      $result = mysqli_query($conn, $get);
      $row = mysqli_fetch_assoc($result);

      $sql2 = "INSERT INTO `Employees` (`userid`, `salary`)
      VALUES ({$row['id']}, 0);";
      mysqli_query($conn, $sql2);
    } else {
      $sql = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `approved`)
      VALUES ('{$_POST['role']}', '{$_POST['fName']}', '{$_POST['lName']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}', '{$_POST['date']}', FALSE);";
      mysqli_query($conn, $sql);
    }
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <script type="text/javascript" src="register.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
  </head>
  <body class="userform" id="register">
    <main>
      <form method="post" id="registerform" action="register.php">
        <h1>Register</h1>
        <select name="role" id="role" onchange="displayExtras();">
          <!-- php which generates options based on the roles in the database -->

          <?php
            include_once "database/db.php";
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
        <a href="login.php" id="tologin">Already Registered? Login</a>
        <section id="bgimg"><img src="includes/retirementhome.jpg" alt="retirement home"></section>
      </form>

    </main>
  </body>
</html>
