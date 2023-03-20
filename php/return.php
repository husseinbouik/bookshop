<?php
session_start();
require 'connect.php';
// Include the Collection class
require_once 'Collection.php';
// Instantiate the Collection class
$collection = new Collection($db);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $collection_code = $_POST['collection_code'];
    $Reservation_Code = $_POST['Reservation_Code'];
    $Borrowing_Code = $_POST['Borrowing_Code'];
    $status = 'Available';
    // $nickname = $_SESSION["nickname"];

    // Update the collection state and add a new reservation record in the database
    $collection->updateCollectionState2($collection_code, $status,$Borrowing_Code,$Reservation_Code);

    // Redirect to the collection home page
    // header("Location: demands.php");
    exit;
}

?>