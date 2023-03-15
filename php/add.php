<?php
// Include the Collection class
include 'Collection.php';
// Instantiate the Collection class
$collection = new Collection($db);


// Add the collection
print_r($_POST) ;
    $title = $_POST['title'];
    $authorname = $_POST['authorname'];
    $type = $_POST['type'];if (isset($_POST['pages']) && is_numeric($_POST['pages'])) {
        $pages_or_duration = $_POST['pages'];
    } elseif (isset($_POST['duration']) && is_numeric($_POST['duration'])) {
        $pages_or_duration = $_POST['duration'];
    } else {
        $pages_or_duration = null;
    }
     $editiondate = $_POST['editiondate'];
    $buydate = $_POST['buydate'];
    $state = $_POST['state'];
    // Handle file upload
    $image = null;
    $target_dir = "../images/";
    $imageFileType = strtolower(pathinfo($_FILES['images']['name'][0], PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $target_file = $target_dir . uniqid() . '.' . $imageFileType;
    
    if (in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES['images']['tmp_name'][0], $target_file)) {
            $image = $target_file;
        }
    }
    $collection->addCollection($title, $authorname, $type,$pages_or_duration , $editiondate, $buydate, $state, $image);
// Redirect to the collection home page
header("Location:admin.php");
?>
