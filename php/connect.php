<?php
// Database configuration
$host = "localhost";
$dbname = "borrowing_books";
$username = "root";
$password = "";
try {
  // Creating a new PDO instance
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  
  // Setting PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo "Connected successfully!";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
