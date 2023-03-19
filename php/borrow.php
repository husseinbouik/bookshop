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
    $status = 'Checked out';
    $nickname = $_SESSION["nickname"];

    // Update the collection state and add a new reservation record in the database
    $collection->updateCollectionState1($collection_code, $status, $nickname,$Reservation_Code);

    // Redirect to the collection home page
    header("Location: demands.php");
    exit;
}

?>
