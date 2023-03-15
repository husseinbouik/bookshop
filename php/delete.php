<?php
// Include the Collection class
include 'Collection.php';

// Create a new instance of the Collection class with your database connection
$collection = new Collection($db);

// Check if the form has been submitted and the 'delete' button was clicked
if (isset($_POST['delete'])) {
  // Get the value of the hidden input field containing the ID of the collection to delete
  $collectionCode = $_POST['btndelete'];

  // Call the deleteCollection method with the collectionCode
  $collection->deleteCollection($collectionCode);

  // Redirect back to the page displaying the collections
//   header("Location: admin.php");
  exit;
}
?>
