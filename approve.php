<?php
include "database/db.php";
$userid = $_GET['id'];

$sql = "UPDATE `Users` SET approved = 1 WHERE id = $userid";
mysqli_query($conn, $sql);

header("Location: registration_approval.php")
?>