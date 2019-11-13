<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include "$root/retirement-home/includes/nav.php";

  if(isset($_SESSION['role'])){
    $is_home = True;

    if($_SESSION['role'] == 1) {
      include_once "$root/retirement-home/registration_approval.php";
    } else if ($_SESSION['role'] == 2) {
      include_once "$root/retirement-home/doctors_home.php";
    } else if ($_SESSION['role'] == 3) {
      include_once "$root/retirement-home/roster.php";
    } else if ($_SESSION['role'] == 4) {
      include_once "$root/retirement-home/caregivers_home.php";
    } else if ($_SESSION['role'] == 5) {
      include_once "$root/retirement-home/family_home.php";
    } else if ($_SESSION['role'] == 6) {
      include_once "$root/retirement-home/patients_home.php";
    }
  }
?>
