<?php
// Include the Collection class
require_once 'Collection.php';

// Instantiate the Collection class
$collection = new Collection($db);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
    // Get form data
    $collection_code = $_POST['collection_code'];
    $title = $_POST['title'];
    $authorname = $_POST['authorname'];
    $type = $_POST['type'];
    $pages_or_duration = isset($_POST['pages']) && is_numeric($_POST['pages']) ? $_POST['pages'] : (isset($_POST['duration']) && is_numeric($_POST['duration']) ? $_POST['duration'] : null);
    $editiondate = $_POST['editiondate'];
    $buydate = $_POST['buydate'];
    $state = $_POST['state'];

    // Handle image upload
    $image = $_POST['old_image']; // pass the old image path as a hidden input in your form
    if (!empty($_FILES['image'])) {
        $target_dir = "../images/";
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $target_file = $target_dir . uniqid() . '.' . $imageFileType;
        
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $target_file;
                // Delete the old image file
                if (!empty($_POST['old_image']) && file_exists($_POST['old_image'])) {
                    unlink($_POST['old_image']);
                }
            }
        }
    }

    // Update the collection in the database
    $collection->updateCollection($collection_code, $title, $authorname, $type, $pages_or_duration, $editiondate, $buydate, $state, $image);

    // Redirect to the collection home page
    // header("Location: admin.php");
    exit;
}

?>
