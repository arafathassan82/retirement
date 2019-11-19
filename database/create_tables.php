<?php
include 'db.php';

mysqli_query($conn, "DROP TABLE IF EXISTS `Roles`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Users`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Employees`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Patients`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Roster`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Appointments`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Reports`");
mysqli_query($conn, "DROP TABLE IF EXISTS `PaymentUpdate`");

$query = "CREATE TABLE `Roles` (id bigint PRIMARY KEY AUTO_INCREMENT, name varchar(20), accesslevel integer);";
$result = mysqli_query($conn, $query);

$query2 = "CREATE TABLE `Users` (id bigint PRIMARY KEY AUTO_INCREMENT, roleid bigint REFERENCES Roles(id), fname varchar(30), lname varchar(30), email varchar(50), phone varchar(15), `password` text, dateofbirth date, approved boolean);";
$result2 = mysqli_query($conn, $query2);

$queryemployees = "CREATE TABLE `Employees` (id bigint PRIMARY KEY AUTO_INCREMENT, userid bigint REFERENCES Users (id), salary bigint DEFAULT NULL);";
$employeesresult = mysqli_query($conn, $queryemployees);

$querypatients = "CREATE TABLE `Patients` (id bigint PRIMARY KEY AUTO_INCREMENT, userid bigint REFERENCES Users (id), familycode varchar(30), emergencycontact varchar(30), emergencyrelation varchar(20), `group` smallint, admissiondate date DEFAULT NULL, due decimal(19, 4));";
$patientsresult = mysqli_query($conn, $querypatients);

$query3 = "CREATE TABLE `Roster` (id bigint PRIMARY KEY AUTO_INCREMENT, date date, doctorid bigint REFERENCES Users (id), supervisorid bigint REFERENCES Users (id), caregiver1id bigint REFERENCES Users (id), caregiver2id bigint REFERENCES Users (id), caregiver3id bigint REFERENCES Users (id), caregiver4id bigint REFERENCES Users (id));";
$result3 = mysqli_query($conn, $query3);

$query4 = "CREATE TABLE `Appointments` (id bigint PRIMARY KEY AUTO_INCREMENT, patientid bigint REFERENCES Users (id), doctorid bigint REFERENCES Users (id), date date, morning varchar(30), afternoon varchar(30), night varchar(30), comment text, isfinished boolean DEFAULT FALSE);";
$result4 = mysqli_query($conn, $query4);

$query6 = "CREATE TABLE `Reports` (id bigint PRIMARY KEY AUTO_INCREMENT, patientid bigint REFERENCES Users (id), morning boolean DEFAULT FALSE, afternoon boolean DEFAULT FALSE, night boolean DEFAULT FALSE, breakfast boolean DEFAULT FALSE, lunch boolean DEFAULT FALSE, dinner boolean DEFAULT FALSE, date date);";
$result6 = mysqli_query($conn, $query6);

$query7 = "CREATE TABLE `PaymentUpdate` (date date);";
$result7 = mysqli_query($conn, $query7);
?>
