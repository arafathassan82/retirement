<?php
include 'db.php';

mysqli_query($conn, "DROP TABLE IF EXISTS `Roles`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Users`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Roster`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Appointments`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Perscriptions`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Reports`");
mysqli_query($conn, "DROP TABLE IF EXISTS `Payment`");

$query = "CREATE TABLE `Roles` (id bigint PRIMARY KEY AUTO_INCREMENT, name varchar(20), accesslevel integer);";
$result = mysqli_query($conn, $query);

$query2 = "CREATE TABLE `Users` (id bigint PRIMARY KEY AUTO_INCREMENT, roleid bigint REFERENCES Roles(id), fname varchar(30), lname varchar(30), email varchar(50), phone varchar(15), `password` text, dateofbirth date, familycode varchar(30), emergencycontact varchar(30), emergencyrelation varchar(20), approved boolean, `group` smallint, admissiondate date DEFAULT NULL);";
$result2 = mysqli_query($conn, $query2);

$query3 = "CREATE TABLE `Roster` (id bigint PRIMARY KEY AUTO_INCREMENT, date date, doctorid bigint REFERENCES Users (id), supervisorid bigint REFERENCES Users (id), caregiver1id bigint REFERENCES Users (id), caregiver2id bigint REFERENCES Users (id), caregiver3id bigint REFERENCES Users (id), caregiver4id bigint REFERENCES Users (id));";
$result3 = mysqli_query($conn, $query3);

$query4 = "CREATE TABLE `Appointments` (id bigint PRIMARY KEY AUTO_INCREMENT, patientid bigint REFERENCES Users (id), date date, morning varchar(30), afternoon varchar(30), night varchar(30));";
$result4 = mysqli_query($conn, $query4);

$query5 = "CREATE TABLE `Perscriptions` (id bigint PRIMARY KEY AUTO_INCREMENT, name varchar(50));";
$result5 = mysqli_query($conn, $query5);

$query6 = "CREATE TABLE `Reports` (id bigint PRIMARY KEY AUTO_INCREMENT, patientid bigint REFERENCES Users (id), morning boolean DEFAULT FALSE, afternoon boolean DEFAULT FALSE, night boolean DEFAULT FALSE, breakfast boolean DEFAULT FALSE, lunch boolean DEFAULT FALSE, dinner boolean DEFAULT FALSE, date date, caregiverid bigint REFERENCES Users (id));";
$result6 = mysqli_query($conn, $query6);

$query7 = "CREATE TABLE `Payment` (id bigint PRIMARY KEY AUTO_INCREMENT, patientid bigint REFERENCES Users (id), due decimal(19, 4));";
$result7 = mysqli_query($conn, $query7);
?>