<?php 
require('connect.php');
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
  
    public function updateCollection($collection_code, $title, $authorname, $type, $pages_or_duration, $editiondate, $buydate, $state, $image) {
        // Retrieve Type_Code from Types table
        $stmt = $this->db->prepare('SELECT Type_Code FROM collection WHERE Collection_Code = ?');
        $stmt->execute([$collection_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $type_code = $row['Type_Code'];

        // Update type in Types table if necessary
        $stmt = $this->db->prepare('SELECT pages_or_duration FROM types WHERE Type_Code = ?');
        $stmt->execute([$type_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['pages_or_duration'] != $pages_or_duration) {
            $stmt = $this->db->prepare('UPDATE types SET pages_or_duration = ? WHERE Type_Code = ?');
            $stmt->execute([$pages_or_duration, $type_code]);
        }

        // Update collection in Collection table
        $stmt = $this->db->prepare('UPDATE collection SET Title = ?, Author_Name = ?, Cover_Image = ?, State = ?, Type_Code = ?, Edition_Date = ?, Buy_Date = ? WHERE Collection_Code = ?');
        $stmt->execute([$title, $authorname, $image, $state, $type_code, $editiondate, $buydate, $collection_code]);
    }
    

    public function deleteCollection($collection_code) {
        // Retrieve Type_Code and Cover_Image from Collection table
        $stmt = $this->db->prepare('SELECT Type_Code, Cover_Image FROM collection WHERE Collection_Code = ?');
        $stmt->execute([$collection_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $type_code = $row['Type_Code'];
        $image = $row['Cover_Image'];
    
        // Delete collection from Collection table
        $stmt = $this->db->prepare('DELETE FROM collection WHERE Collection_Code = ?');
        $stmt->execute([$collection_code]);
    
        // Check if the deleted collection was the last one using the type_code
        $stmt = $this->db->prepare('SELECT COUNT(*) AS count FROM collection WHERE Type_Code = ?');
        $stmt->execute([$type_code]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
        // Delete type from Types table if it's no longer used
        if ($count == 0) {
            $stmt = $this->db->prepare('DELETE FROM types WHERE Type_Code = ?');
            $stmt->execute([$type_code]);
        }
    
        // Delete the image file from the "images" folder
        if (file_exists($image)) {
            if (unlink($image)) {
                echo "File deleted successfully.";
            } else {
                echo "Error deleting file.";
            }
        } else {
            echo "File does not exist.";
        }
    }
    
}
?>