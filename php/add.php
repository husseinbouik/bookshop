<?php
class Collection {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addCollection($title, $authorname, $type, $pages_or_duration, $editiondate, $buydate, $state, $image) {
        // Insert type into Types table
        $stmt = $this->db->prepare('INSERT INTO types (Type_Name, pages_or_duration) VALUES (?, ?)');
        $stmt->execute([$type,$pages_or_duration]);

        // Retrieve Type_Code from Types table
        $type_code = $this->db->lastInsertId();

        // Insert collection into Collection table
        $stmt = $this->db->prepare('INSERT INTO collection (Title, Author_Name, Cover_Image, State, Type_Code, Edition_Date, Buy_Date) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$title, $authorname, $image, $state, $type_code, $editiondate, $buydate]);
    }
    public function deleteCollection($id) {
        // Delete collection from Collection table
        $stmt = $this->db->prepare('DELETE FROM collection WHERE id = ?');
        $stmt->execute([$id]);
    }
}
// Create a PDO connection
require('connect.php');

// Instantiate the Collection class
$collection = new Collection($db);

// Add the collection
print_r($_POST) ;
    $title = $_POST['title'];
    $authorname = $_POST['authorname'];
    $type = $_POST['type'];
    $pages_or_duration = isset($_POST['pages']) ? $_POST['pages'] : (isset($_POST['duration']) ? $_POST['duration'] : null);
    $editiondate = $_POST['editiondate'];
    $buydate = $_POST['buydate'];
    $state = $_POST['state'];

    // Handle file upload
    $image = null;
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES['images']['name'][0]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'][0], $target_file)) {
                $image = $target_file;
            }
        }
    

    $collection->addCollection($title, $authorname, $type,$pages_or_duration , $editiondate, $buydate, $state, $image);

