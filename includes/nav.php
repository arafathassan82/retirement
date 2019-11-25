<?php
  session_start();
  $nav_arr = array();

  if (isset($_POST['logout'])) {
    unset($_SESSION["user"]);
    unset($_SESSION["role"]);
    header("Location: login.php");
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
      $nav_arr[] = 'patient_of_doctor';
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
      $nav_arr[] = 'doctors_appointment';
    } else {
      $nav_arr[] = 'login';
      $nav_arr[] = 'home';
    }
  }
?>

<nav>
  <?php
    echo '<ul class="nav-list">';
    foreach($nav_arr as $value) {
      echo '<li class="nav-li">';
      if ($value == 'login') {
        echo '<a href="login.php" class="nav-anchor">Login</a>';
      } else if ($value == 'home') {
        echo '<a href="home.php" class="nav-anchor">Home</a>';
      } else if ($value == 'doctors_home') {
        echo '<a href="doctors_home.php" class="nav-anchor">Home</a>';
      } else if ($value == 'patients_home') {
        echo '<a href="patients_home.php" class="nav-anchor">Home</a>';
      } else if ($value == 'family_home') {
        echo '<a href="family_home.php" class="nav-anchor">Home</a>';
      } else if ($value == 'caregiver_home') {
        echo '<a href="caregivers_home.php" class="nav-anchor">Home</a>';
      } else if ($value == 'roster') {
        echo '<a href="roster.php" class="nav-anchor">Roster</a>';
      } else if ($value == 'new_roster') {
        echo '<a href="new_roster.php" class="nav-anchor">New Roster</a>';
      } else if ($value == 'role') {
        echo '<a href="role.php" class="nav-anchor">Roles</a>';
      } else if ($value == 'employee') {
        echo '<a href="employee.php" class="nav-anchor">Employees</a>';
      } else if ($value == 'patients') {
        echo '<a href="patients.php" class="nav-anchor">Patients</a>';
      } else if ($value == 'registration_approval') {
        echo '<a href="registration_approval.php" class="nav-anchor">Approve Registration</a>';
      } else if ($value == 'additional_info_of_patient') {
        echo '<a href="additional_information_of_patient.php" class="nav-anchor">Additional Info</a>';
      } else if ($value == 'admins_report') {
        echo '<a href="admins_report.php" class="nav-anchor">Admin\'s Report</a>';
      } else if ($value == 'payments') {
        echo '<a href="payment.php" class="nav-anchor">Payments</a>';
      } else if ($value == 'doctors_appointment'){
        echo '<a href="doctors_appointment.php" class="nav-anchor">Doctor\'s Appointment</a>';
      } else if ($value == 'patient_of_doctor'){
        echo '<a href="patient_of_doctor.php" class="nav-anchor">Patient of Doctor</a>';
      }
      echo '</li>';
    }

    if(isset($_SESSION['role'])) {

      echo '<li class="nav-li">', "<form method='post'>";
        echo "<input type='submit' name='logout' value='Logout' class=\"logout\">";
      echo "</form>", "</li>";
    }
    echo '</ul>';
  ?>
</nav>
