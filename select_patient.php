<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include "$root/retirement-home/includes/nav.php";
    // always include session_start in pages that you want to reference session variables in.
    if ($_SESSION['role'] != 2) {
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
    <title>Select Patient</title>
</head>
<body>
  <main class="grayblock">
    <span class="heading">Select a patient to view their appointments</span>
    <ul>
        <?php
            include_once "database/db.php";
            $sql = "SELECT DISTINCT patientid AS id, fname, lname FROM `Appointments` JOIN `Users` ON patientid WHERE `Users`.id = `Appointments`.patientid AND `Appointments`.doctorid = {$_SESSION['user']};";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<li class=\"patient-li\"><a href=\"patient_of_doctor.php?id={$row['id']}\" class=\"patient-list\">{$row['fname']} {$row['lname']}</a></li>";
                }
            }
        ?>
    </ul>
  </main>
</body>
</html>
