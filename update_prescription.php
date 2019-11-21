<?php
    if(isset($_POST['date'])){
        if($_POST['date'] == date("Y-m-d")){
            include 'database/db.php';
            $sql = "SELECT * FROM `Appointments` WHERE `date` = '{$_POST['date']}' AND `patientid` = {$_POST['id']};";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $apptid = $row['id'];
            $finished_status = $row['isfinished'];
            $patient = $row['patientid'];
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                if ($isfinished == 0) {
                  $nextsql = "UPDATE `Appointments` `a`, `Patients` `p` SET `due` = (`due` + 50), `morning` = '{$_POST['morning']}', `afternoon` = '{$_POST['afternoon']}', `night` = '{$_POST['night']}', `comment` = '{$_POST['comment']}', `isfinished` = 1 WHERE a.id = $apptid AND p.userid = $patient;";
                } else {
                  $nextsql = "UPDATE `Appointments` `a` SET `morning` = '{$_POST['morning']}', `afternoon` = '{$_POST['afternoon']}', `night` = '{$_POST['night']}', `comment` = '{$_POST['comment']}', `isfinished` = 1 WHERE a.id = $apptid";
                }
                mysqli_query($conn, $nextsql);
            }
        }
    }
    header("Location: patient_of_doctor.php?id={$_POST['id']}");
?>
