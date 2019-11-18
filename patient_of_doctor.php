<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include "$root/retirement-home/includes/nav.php";
    // always include session_start in pages that you want to reference session variables in.
    if ($_SESSION['role'] != 2) {
    header("Location: home.php");
    }

    if(!isset($_GET['id'])){
        header("Location: select_patient.php");
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
    <?php
        echo "<a href=\"select_patient.php\">Back</a>";
        include_once "database/db.php";
        $sql = "SELECT id, fname, lname FROM `Users` WHERE id = {$_GET['id']}";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            $row = mysqli_fetch_assoc($result);
            echo "<h1>{$row['fname']} {$row['lname']}</h1>";
        }
    ?>
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
            $sql = "SELECT * FROM `Appointments` WHERE patientid = {$_GET['id']} ORDER BY `date` ASC;";
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
    <?php
        echo "<h1>New Prescription</h1>";
        echo "<table>
        <tr>
            <th>Date</th>
            <th>Comment</th>
            <th>Morning Med</th>
            <th>Afternoon Med</th>
            <th>Night Med</th>
        </tr>";

        include_once "database/db.php";
        $sql = "SELECT * FROM `Appointments` WHERE patientid = {$_GET['id']} ORDER BY `date` DESC;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo "<form method=\"POST\" action=\"update_prescription.php\">";
        if($resultCheck > 0){
            $row = mysqli_fetch_assoc($result);
            echo '<tr>';
            echo "<td><input type=\"date\" name=\"date\" value=\"{$row['date']}\"></td>";
            echo "<td><input type=\"text\" name=\"comment\" value=\"{$row['comment']}\"></td>";
            echo "<td><input type=\"text\" name=\"morning\" value=\"{$row['morning']}\"></td>";
            echo "<td><input type=\"text\" name=\"afternoon\" value=\"{$row['afternoon']}\"></td>";
            echo "<td><input type=\"text\" name=\"night\" value=\"{$row['night']}\"></td>";
            echo '</tr>';
        }

        echo "</table>";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\">";
        echo "<input type=\"submit\" name=\"submit\"></form>";
    ?>

</body>
</html>