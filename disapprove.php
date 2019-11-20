<?php
session_start();
// always include session_start in pages that you want to reference session variables in.
if ($_SESSION['role'] != 1) {
  header("Location: login.php");
} else {

    if(isset($_GET['id'])){
        include "database/db.php";
        $userid = $_GET['id'];

        $sql = "DELETE FROM `Users` WHERE id = $userid AND approved = 0;";
        mysqli_query($conn, $sql);

        if($_GET['roleid'] < 5){
            $sql2 = "DELETE FROM `Employees` WHERE userid = $userid;";
            mysqli_query($conn, $sql2);
        } elseif ($_GET['roleid'] == 6){
            $sql2 = "DELETE FROM `Patients` WHERE userid = $userid;";
            mysqli_query($conn, $sql2);
        }
    }
    header("Location: registration_approval.php");
}
?>