<?php
require('connect.php');

// prepare the SQL query to insert data into the Members table
$stmt = $db->prepare("INSERT INTO Members (Nickname, Firstname, Lastname, Email, PhoneNumber, Address, CIN, Birth_Date, Occupation, Password, Creation_Date) VALUES (:nickname, :firstname, :lastname, :email, :phonenumber, :address, :cin, :birthdate, :type, :password, NOW())");

// bind the form data to the prepared statement
$stmt->bindParam(':nickname', $_POST['nickname']);
$stmt->bindParam(':firstname', $_POST['firstname']);
$stmt->bindParam(':lastname', $_POST['lastname']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':phonenumber', $_POST['phonenumber']);
$stmt->bindParam(':address', $_POST['address']);
$stmt->bindParam(':cin', $_POST['cin']);
$stmt->bindParam(':birthdate', $_POST['birthdate']);
$stmt->bindParam(':type', $_POST['type']);
$stmt->bindParam(':password', $_POST['password']);

// execute the prepared statement
$stmt->execute();

// close the database connection
$db = null;
?>
