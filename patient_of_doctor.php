<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include "$root/retirement-home/includes/nav.php";
    // always include session_start in pages that you want to reference session variables in.
    if ($_SESSION['role'] != 2) {
    header("Location: home.php");
    }

    if(!isset($_GET['id'])){
        header("Location: doctors_home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient of Doctor</title>
</head>
<body>
    <table>
        <tr>
            <th>Date</th>
            <th>Comment</th>
            <th>Morning Med</th>
            <th>Afternoon Med</th>
            <th>Night Med</th>
        </tr>
        <?php
            include_once "database/db.php";
            $sql = "SELECT * FROM `Appointments` WHERE patientid = {$_GET['id']} ORDER BY `date` DESC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<tr>';
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['comment']}</td>";
                    echo "<td>{$row['morning']}</td>";
                    echo "<td>{$row['afternoon']}</td>";
                    echo "<td>{$row['night']}</td>";
                    echo '</tr>';
                }
            }

        ?>
    </table>
</body>
</html>