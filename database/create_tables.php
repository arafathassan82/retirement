<?php
include 'db.php';

var_dump($conn);

// mysqli_query($conn, "DROP TABLE IF EXISTS `Roles`");
// mysqli_query($conn, "DROP TABLE IF EXISTS `Users`");
// mysqli_query($conn, "DROP TABLE IF EXISTS `Roster`");
// mysqli_query($conn, "DROP TABLE IF EXISTS `Appointments`");
// mysqli_query($conn, "DROP TABLE IF EXISTS `Perscriptions`");
// mysqli_query($conn, "DROP TABLE IF EXISTS `Reports`");
// mysqli_query($conn, "DROP TABLE IF EXISTS `Payment`");

// $query = "CREATE TABLE `Roles` (id bigserial PRIMARY KEY, name varchar(20), accesslevel integer);";
// $result = mysqli_query($conn, $query);

// $query2 = "CREATE TABLE `Users` (id bigserial PRIMARY KEY, roleid bigint FOREIGN KEY REFERENCES Roles (id), fname varchar(30), lname varchar(30), email varchar(50), phone varchar(15), password text, dateofbirth date, familycode varchar(30), emergencycontact varchar(30), emergencyrelation varchar(20), approved boolean, group smallint);";
// $result2 = mysqli_query($conn, $query2);

// $query3 = "CREATE TABLE `Roster` (id bigserial PRIMARY KEY, date date, doctorid FOREIGN KEY REFERENCES Roles (id));";
// $result3 = mysqli_query($conn, $query3);

// $query4 = "CREATE TABLE `Appointments` (id bigserial PRIMARY KEY, patientid bigint FOREIGN KEY REFERENCES Users (id), date date, morning varchar(30), afternoon varchar(30), night varchar(30));";
// $result4 = mysqli_query($conn, $query4);

// $query5 = "CREATE TABLE `Perscriptions` (id bigserial PRIMARY KEY, name varchar(50));";
// $result5 = mysqli_query($conn, $query5);

// $query6 = "CREATE TABLE `Reports` (id bigserial PRIMARY KEY, patientid bigint FOREIGN KEY REFERENCES Users (id), morning boolean DEFAULT FALSE, afternoon boolean DEFAULT FALSE, night boolean DEFAULT FALSE, breakfast boolean DEFAULT FALSE, lunch boolean DEFAULT FALSE, dinner boolean DEFAULT FALSE, date date, caregiverid FOREIGN KEY REFERENCES Users (id));";
// $result6 = mysqli_query($conn, $query6);

// $query7 = "CREATE TABLE `Payment` (id bigserial PRIMARY KEY, patientid bigint FOREIGN KEY REFERENCES Users (id), due decimal(19, 4));";
// $result7 = mysqli_query($conn, $query7);
?>