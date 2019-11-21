<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  include "$root/retirement-home/database/db.php";

  $daily_payment_check = "SELECT * FROM PaymentUpdate;";
  $result = mysqli_query($conn, $daily_payment_check);
  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    $row = mysqli_fetch_assoc($result);
    $date = date('Y-m-d');
    if ($row['date'] != $date) {
      // update everybody's due, and update the current date in PaymentUpdate
      $update_daily_payments = "UPDATE Patients, PaymentUpdate, Users SET due = (due + (10 * (CAST(DATEDIFF('$date', date) AS INTEGER)))), date = '$date' WHERE admissiondate <= date AND approved = 1;";
      mysqli_query($conn, $update_daily_payments);
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      include "$root/retirement-home/includes/nav.php";
      // always include session_start in pages that you want to reference session variables in.
      if ($_SESSION['role'] != 1) {
        header("Location: home.php");
      }
    ?>

    <form method="post">
      Patient ID: <input type="number" name="patientid" value="<?php echo $_POST['patientid']; ?>">
      <input type="submit" value="patient" name="submit">
    </form>

    <!-- display total due for patient sent in from above input -->
    <?php
      if (isset($_POST['patientid'])) {
        $sql = "SELECT due FROM Patients WHERE userid = {$_POST['patientid']};";

        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
          while($row = mysqli_fetch_assoc($result)){
            echo "Payment Due: {$row['due']}";
          }
          echo "<form method='post'>";
          echo "<input type='number' name='patient' value='{$_POST['patientid']}' hidden>";
          echo "New Payment: <input type='number' name='new_payment'>";
          echo "<input type='submit' name='submit_payment'>";
          echo "</form>";
        }
      }
    ?>

    <!-- another form to put in a new payment for said patient, only is generated when patient ID has been sent in -->

    <?php
      if (isset($_POST['new_payment'])) {
        $sql = "UPDATE Patients SET due = (due - {$_POST['new_payment']}) WHERE userid = {$_POST['patient']};";
        mysqli_query($conn, $sql);
      }
    ?>

    <!-- make sure total due goes up every day (not a thing that is done on HTML) -->
  </body>
</html>
