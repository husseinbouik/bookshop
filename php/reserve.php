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

     // Get the number of reservations and borrowings for the given nickname
     $reservations_sql = "SELECT COUNT(*) FROM Reservation WHERE Nickname = :nickname";
     $reservations_stmt = $db->prepare($reservations_sql);
     $reservations_stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
     $reservations_stmt->execute();
     $num_reservations = $reservations_stmt->fetchColumn();
 
     $borrowings_sql = "SELECT COUNT(*) FROM Borrowings WHERE Nickname = :nickname";
     $borrowings_stmt = $db->prepare($borrowings_sql);
     $borrowings_stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
     $borrowings_stmt->execute();
     $num_borrowings = $borrowings_stmt->fetchColumn();


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
    } elseif(($num_reservations + $num_borrowings) >= 3){
        // Member has reached the maximum reservation and borrowing limit, show an error message
        $error_message = 'You cannot make a reservation because you have reached the maximum reservation and borrowing limit';
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

