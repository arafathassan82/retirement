<?php
include 'db.php';

$query = "INSERT INTO `Roles` (`name`, `accesslevel`)
VALUES ('Admin', 1),
('Doctor', 2),
('Supervisor', 3),
('Caregiver', 4),
('Family Member', 5),
('Patient', 6);";
mysqli_query($conn, $query);

$query2 = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `approved`)
VALUES (1, 'Spencer', 'Nauman', 'snauman817@gmail.com', '7177199508', 'fakepass', '2000-08-17', TRUE),
(2, 'Drake', 'Clapping', 'drake@gmail.com', '123456789', 'pass', '1993-03-03', FALSE),
(3, 'Lou', 'Albano', 'lou@gmail.com', '874502983745', 'pass2', '1935-09-20', FALSE),
(4, 'Jamesandthe', 'Giantpeach', 'james@gmail.com', '5555555555', 'pass3', '1985-01-01', FALSE),
(4, 'Luigi', 'Mario', 'luigi@gmail.com', '1313131313', 'luigi', '1993-09-25', FALSE),
(4, 'Fort', 'Nite', 'fortnite@gmail.com', '4242424242', 'fortnite', '2018-08-08', FALSE),
(4, 'Oko', 'Elk', 'oko@gmail.com', '3333333333', 'oko', '2019-09-27', FALSE),
(5, 'Kingjames', 'Holybible', 'king@gmail.com', '1239876543', 'pass4', '1800-03-03', FALSE),
(6, 'Minecraft', 'Steve', 'steve@gmail.com', '8888888888', 'pass5', '2001-01-01', FALSE),
(6, 'John', 'Wick', 'john@gmail.com', '999999999', 'johnwick', '1985-02-15', FALSE),
(6, 'Johnathan', 'Whitman', 'darth@gmail.com', '1212121212', 'darthmaul', '2003-05-05', FALSE),
(6, 'Building', 'Bruenor', 'bruenor@gmail.com', '1515141210', 'bruenor', '2000-01-01', FALSE),
(1, 'admin', 'admin', 'admin', '00000', 'admin', '2000-01-01', TRUE),
(2, 'doctor', 'doctor', 'doctor', '00000', 'doctor', '2000-01-01', TRUE),
(3, 'supervisor', 'supervisor', 'supervisor', '00000', 'supervisor', '2000-01-01', TRUE),
(4, 'caregiver', 'caregiver', 'caregiver', '00000', 'caregiver', '2000-01-01', TRUE),
(5, 'family', 'family', 'family', '00000', 'family', '2000-01-01', TRUE),
(6, 'patient', 'patient', 'patient', '00000', 'patient', '2000-01-01', TRUE);";
mysqli_query($conn, $query2);

$employeequery = "INSERT INTO `Employees` (`userid`, `salary`)
VALUES (1, 60000),
(2, 90000),
(3, 50000),
(4, 30000),
(5, 30000),
(6, 32000),
(7, 25000),
(13, 90000),
(14, 50000),
(15, 30000),
(16, 30000);";
mysqli_query($conn, $employeequery);

$patientsquery = "INSERT INTO `Patients` (`userid`, `familycode`, `emergencycontact`, `emergencyrelation`, `group`, `admissiondate`, `due`)
VALUES (9, 'a', '71777777777', 'Mother', 1, '2019-11-04', 0.0000),
(10, 'b', '7178888888', 'Father', 2, '2019-11-16', 0.0000),
(11, 'c', '7179999999', 'Mother', 3, '2019-11-13', 0.0000),
(12, 'd', '7171010101', 'Father', 4, '2019-11-18', 0.0000),
(18, 'c', '7179999999', 'Mother', 3, '2019-11-13', 0.0000);";
mysqli_query($conn, $patientsquery);

$query3 = "INSERT INTO `Roster` (date, doctorid, supervisorid, caregiver1id, caregiver2id, caregiver3id, caregiver4id)
VALUES ('2019-11-04', 2, 3, 4, 5, 6, 7);";
mysqli_query($conn, $query3);

$query4 = "INSERT INTO `Appointments` (patientid, doctorid, date, morning, afternoon, night, comment, isfinished)
VALUES (9, 2, '2019-11-04', 'Tylenol', 'Jack Daniels', 'Sleep', NULL, 1);";
mysqli_query($conn, $query4);

$query6 = "INSERT INTO `Reports` (patientid, morning, afternoon, night, breakfast, lunch, dinner, date)
VALUES (9, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, '2019-11-04');";
mysqli_query($conn, $query6);

$query7 = "INSERT INTO `PaymentUpdate` (`date`)
VALUES ('2019-11-04');";
mysqli_query($conn, $query7);
?>
