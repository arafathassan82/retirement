<?php
include "database/db.php";
$userid = $_GET['id'];

$sql = "DELETE FROM `Users` WHERE id = $userid;";
mysqli_query($conn, $sql);

header("Location: registration_approval.php")
?>