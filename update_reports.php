<?php
include 'database/db.php';
$dailyreportscheck = "SELECT `date` FROM `Reports` ORDER BY `date` DESC;";
$result = mysqli_query($conn, $dailyreportscheck);
$resultCheck = mysqli_num_rows($result);

$currentdate = date('Y-m-d');
$row = mysqli_fetch_assoc($result);
if($row['date'] != $currentdate){
    $patients = "SELECT userid FROM `Patients`;";
    $patientsresult = mysqli_query($conn, $patients);
    $resultCheckPatients = mysqli_num_rows($patientsresult);

    if($resultCheckPatients > 0){
        while($patientsRow = mysqli_fetch_assoc($patientsresult)){
            $id = $patientsRow['userid'];

            $reportsadd = "INSERT INTO `Reports` (`patientid`, `morning`, `afternoon`, `night`, `breakfast`, `lunch`, `dinner`, `date`)
            VALUES ($id, 0, 0, 0, 0, 0, 0, '$currentdate');";
            mysqli_query($conn, $reportsadd);
        }
    }
}
?>