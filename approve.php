<?php
session_start();
// always include session_start in pages that you want to reference session variables in.
if ($_SESSION['role'] != 1) {
  header("Location: login.php");
} else{

    if(isset($_GET['id'])){
        include_once "database/db.php";
        $userid = $_GET['id'];

        $sql = "UPDATE `Users` SET approved = 1 WHERE id = $userid;";
        mysqli_query($conn, $sql);
    }
    header("Location: registration_approval.php");
}
?>