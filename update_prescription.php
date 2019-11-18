<?php
    if(isset($_POST['date'])){
        if($_POST['date'] == date("Y-m-d")){
            include 'database/db.php';
            $sql = "SELECT * FROM `Appointments` WHERE `date` = '{$_POST['date']}' AND `patientid` = {$_POST['id']};";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $apptid = $row['id'];
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck > 0){
                $nextsql = "UPDATE `Appointments` SET `morning` = '{$_POST['morning']}', `afternoon` = '{$_POST['afternoon']}', `night` = '{$_POST['night']}', `comment` = '{$_POST['comment']}' WHERE id = $apptid;";
                mysqli_query($conn, $nextsql);
            }
            header("Location: patient_of_doctor.php?id={$_POST['id']}");
        }
    }
?>