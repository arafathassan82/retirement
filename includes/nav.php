<?php
  session_start();
  $nav_arr = array();

  if (isset($_POST['logout'])) {
    unset($_SESSION["user"]);
    unset($_SESSION["role"]);
    header("Refresh: 2; URL = login.php");
  }

  if(isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 6) {
      $nav_arr[] = 'home';
      $nav_arr[] = 'roster';
    } else if ($_SESSION['role'] == 5) {
      $nav_arr[] = 'home';
      $nav_arr[] = 'roster';
    } else if ($_SESSION['role'] == 4) {
      $nav_arr[] = 'home';
      $nav_arr[] = 'roster';
    } else if ($_SESSION['role'] == 3) {
      $nav_arr[] = 'home';
      $nav_arr[] = 'roster';
      $nav_arr[] = 'new_roster';
    } else if ($_SESSION['role'] == 2) {
      $nav_arr[] = 'home';
      $nav_arr[] = 'roster';
    } else if ($_SESSION['role'] == 1) {
      $nav_arr[] = 'home';
      $nav_arr[] = 'roster';
      $nav_arr[] = 'new_roster';
      $nav_arr[] = 'role';
      $nav_arr[] = 'employee';
      $nav_arr[] = 'patients';
      $nav_arr[] = 'registration_approval';
      $nav_arr[] = 'additional_info_of_patient';
      $nav_arr[] = 'admins_report';
      $nav_arr[] = 'payments';
    } else {
      $nav_arr[] = 'home';
      $nav_arr[] = 'login';
    }
  }
?>

<nav>
  <?php
    foreach($nav_arr as $value) {
      if ($value == 'login') {
        echo "<a href='login.php'>Login</a>";
      } else if ($value == 'home') {
        echo "<a href='home.php'>Home</a>";
      } else if ($value == 'doctors_home') {
        echo "<a href='doctors_home.php'>Home</a>";
      } else if ($value == 'patients_home') {
        echo "<a href='patients_home.php'>Home</a>";
      } else if ($value == 'family_home') {
        echo "<a href='family_home.php'>Home</a>";
      } else if ($value == 'caregiver_home') {
        echo "<a href='caregivers_home.php'>Home</a>";
      } else if ($value == 'roster') {
        echo "<a href='roster.php'>Roster</a>";
      } else if ($value == 'new_roster') {
        echo "<a href='new_roster.php'>New Roster</a>";
      } else if ($value == 'role') {
        echo "<a href='role.php'>Login</a>";
      } else if ($value == 'employee') {
        echo "<a href='employee.php'>Employees</a>";
      } else if ($value == 'patients') {
        echo "<a href='patients.php'>Patients</a>";
      } else if ($value == 'registration_approval') {
        echo "<a href='registration_approval.php'>Approve Registration</a>";
      } else if ($value == 'additional_info_of_patient') {
        echo "<a href='additional_information_of_patient.php'>Additional Info</a>";
      } else if ($value == 'admins_report') {
        echo "<a href='admins_report.php'>Admin's Report</a>";
      } else if ($value == 'payments') {
        echo "<a href='payment.php'>Payments</a>";
      }
    }

    if(isset($_SESSION['role'])) {
      echo "<form method='post'>";
        echo "<input type='submit' name='logout' value='logout'>";
      echo "</form>";
    } else {
      echo "<span>Logging Out...</span>";
    }
  ?>
</nav>
