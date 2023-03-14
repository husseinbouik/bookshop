<?php 
// Create a PDO connection
require('connect.php');

// Instantiate the Collection class
$collection = new Collection($db);

// Delete the collection with id = 1 (change the id as required)
$collection->deleteCollection(1);
require('admin.php');

?>