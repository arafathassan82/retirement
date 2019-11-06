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

$query2 = "INSERT INTO `Users` (`roleid`, `fname`, `lname`, `email`, `phone`, `password`, `dateofbirth`, `familycode`, `emergencycontact`, `emergencyrelation`, `approved`, `group`)
VALUES (1, 'Spencer', 'Nauman', 'snauman817@gmail.com', '7177199508', 'fakepass', '2000-08-17', NULL, '7176262384', 'Mother', TRUE, 0),
(2, 'Drake', 'Clapping', 'drake@gmail.com', '123456789', 'pass', '1993-03-03', NULL, '987654321', 'Mother', FALSE, 0),
(3, 'Lou', 'Albano', 'lou@gmail.com', '874502983745', 'pass2', '1935-09-20', NULL, '837458927345', 'Father', FALSE, 0),
(4, 'Jamesandthe', 'Giantpeach', 'james@gmail.com', '5555555555', 'pass3', '1985-01-01', NULL, '6666666666', 'Brother', FALSE, 1),
(4, 'Luigi', 'Mario', 'luigi@gmail.com', '1313131313', 'luigi', '1993-09-25', NULL, '7177177171', 'Brother', FALSE, 2),
(4, 'Fort', 'Nite', 'fortnite@gmail.com', '4242424242', 'fortnite', '2018-08-08', NULL, '888888888888', 'Mother', FALSE, 3),
(4, 'Oko', 'Elk', 'oko@gmail.com', '3333333333', 'oko', '2019-09-27', NULL, '3003030303', 'Father', FALSE, 4),
(5, 'Kingjames', 'Holybible', 'king@gmail.com', '1239876543', 'pass4', '1800-03-03', NULL, '1091091099', 'Son', FALSE, 0),
(6, 'Minecraft', 'Steve', 'steve@gmail.com', '8888888888', 'pass5', '2001-01-01', 'abc', '1239876543', 'Son', FALSE, 1),
(6, 'John', 'Wick', 'john@gmail.com', '999999999', 'johnwick', '1985-02-15', 'def', '1239876543', 'Father', FALSE, 2),
(6, 'Johnathan', 'Whitman', 'darth@gmail.com', '1212121212', 'darthmaul', '2003-05-05', 'ghi', '1239876543', 'Father', FALSE, 3),
(6, 'Building', 'Bruenor', 'bruenor@gmail.com', '1515141210', 'bruenor', '2000-01-01', 'jkl', '1239876543', 'Father', FALSE, 4);";
mysqli_query($conn, $query2);

$query3 = "INSERT INTO `Roster` (date, doctorid, supervisorid, caregiver1id, caregiver2id, caregiver3id, caregiver4id)
VALUES ('2019-11-04', 2, 3, 4, 5, 6, 7);";
mysqli_query($conn, $query3);

$query4 = "INSERT INTO `Appointments` (patientid, date, morning, afternoon, night)
VALUES (9, '2019-11-04', 'Tylenol', 'Jack Daniels', 'Sleep');";
mysqli_query($conn, $query4);

$query5 = "INSERT INTO `Perscriptions` (name)
VALUES ('Tylenol'),
('Advil');";
mysqli_query($conn, $query5);

$query6 = "INSERT INTO `Reports` (patientid, morning, afternoon, night, breakfast, lunch, dinner, date, caregiverid)
VALUES (9, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, '2019-11-04', 4);";
mysqli_query($conn, $query6);

$query7 = "INSERT INTO `Payment` (patientid, due)
VALUES (9, 25.4000);";
mysqli_query($conn, $query7);
?>