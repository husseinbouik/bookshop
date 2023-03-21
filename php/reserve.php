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
    $status = 'Reserved';
    $nickname = $_SESSION["nickname"];

    $penalty_count_sql = "SELECT Penalty_Count FROM Members WHERE Nickname = :nickname";
    $penalty_count_stmt = $db->prepare($penalty_count_sql);
    $penalty_count_stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
    $penalty_count_stmt->execute();
    $penalty_count = $penalty_count_stmt->fetchColumn();
    if ($penalty_count >= 3) {
        // Member has reached the maximum penalty count, show an error message
        $error_message = 'You cannot make a reservation because you have reached the maximum penalty count';
        $_SESSION['error_message'] = $error_message;
        header("Location: homepage.php");
    } else {
    // Update the collection state and add a new reservation record in the database
    $collection->updateCollectionState($collection_code, $status, $nickname);

    // Redirect to the collection home page
    header("Location: homepage.php");
    exit;
}
}

?>
