<?php 
require('connect.php');
class Collection {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function addCollection($title, $authorname, $type, $pages_or_duration, $editiondate, $buydate, $state, $image,$status) {
        // Insert type into Types table
        $stmt = $this->db->prepare('INSERT INTO types (Type_Name, pages_or_duration) VALUES (?, ?)');
        $stmt->execute([$type, $pages_or_duration]);
    
        // Retrieve Type_Code from Types table
        $type_code = $this->db->lastInsertId();
    
        // Insert collection into Collection table
        $stmt = $this->db->prepare('INSERT INTO collection (Title, Author_Name, Cover_Image, State, Type_Code, Edition_Date, Buy_Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$title, $authorname, $image, $state, $type_code, $editiondate, $buydate,$status]);
    }
    
  
    public function updateCollection($collection_code, $title, $authorname, $type, $pages_or_duration, $editiondate, $buydate, $state, $image) {
        // Retrieve Type_Code from Types table
        $stmt = $this->db->prepare('SELECT Type_Code FROM collection WHERE Collection_Code = ?');
        $stmt->execute([$collection_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $type_code = $row['Type_Code'];

        // Update type in Types table if necessary
        $stmt = $this->db->prepare('SELECT *  FROM types WHERE Type_Code = ?');
        $stmt->execute([$type_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['pages_or_duration'] != $pages_or_duration   ) {
            $stmt = $this->db->prepare('UPDATE types SET pages_or_duration = ?  WHERE Type_Code = ?');
            $stmt->execute([$pages_or_duration, $type_code]);
        }
        if ($row['Type_Name'] != $type) {
          $stmt = $this->db->prepare('UPDATE types SET Type_Name = ?  WHERE Type_Code = ?');
          $stmt->execute([$type,$type_code]);
        }
        // Update collection in Collection table
        $stmt = $this->db->prepare('UPDATE collection SET Title = ?, Author_Name = ?, Cover_Image = ?, State = ?, Type_Code = ?, Edition_Date = ?, Buy_Date = ? , Status = "Available" WHERE Collection_Code = ?');
        $stmt->execute([$title, $authorname, $image, $state, $type_code, $editiondate, $buydate, $collection_code]);
    }
    public function updateCollectionState($collection_code, $status, $nickname) {
      // Prepare the SQL statements
      $collectionSql = "UPDATE collection SET Status = :status WHERE collection_code = :collection_code";
      $reservationSql = "INSERT INTO Reservation (Reservation_Date, Reservation_Expiration_Date, Collection_Code, Nickname) 
                         VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), :collection_code, :nickname)";
  
      // Bind the parameters for the collection SQL statement
      $collectionStmt = $this->db->prepare($collectionSql);
      $collectionStmt->bindParam(':status', $status, PDO::PARAM_STR);
      $collectionStmt->bindParam(':collection_code', $collection_code, PDO::PARAM_INT);
  
      // Bind the parameters for the reservation SQL statement
      $reservationStmt = $this->db->prepare($reservationSql);
      $reservationStmt->bindParam(':collection_code', $collection_code, PDO::PARAM_INT);
      $reservationStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
  
      // Execute the statements within a transaction
      $this->db->beginTransaction();
      try {
          $collectionStmt->execute();
          $reservationStmt->execute();
          $this->db->commit();
      } catch (PDOException $e) {
          $this->db->rollback();
          throw $e;
      }
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
class Card
{
  private $Collection_Code;
  private $title;
  private $authorname;
  private $image;
  private $state;
  private $editionDate;
  private $buyDate;
  private $status;
  private $type;
  private $pagesOrDuration;

  public function __construct($Collection_Code, $title, $authorname, $image, $state, $editionDate, $buyDate, $status, $type, $pagesOrDuration)
  {
    $this->Collection_Code = $Collection_Code;
    $this->title = $title;
    $this->authorname = $authorname;
    $this->image = $image;
    $this->state = $state;
    $this->editionDate = $editionDate;
    $this->buyDate = $buyDate;
    $this->status = $status;
    $this->type = $type;
    $this->pagesOrDuration = $pagesOrDuration;
  }

  public function getId()
  {
    return $this->Collection_Code;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getAuthorname()
  {
    return $this->authorname;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function getState()
  {
    return $this->state;
  }

  public function getEditionDate()
  {
    return $this->editionDate;
  }

  public function getBuyDate()
  {
    return $this->buyDate;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getPagesOrDuration()
  {
    return $this->pagesOrDuration;
  }

  public static function getCards()
  {
    require('connect.php');
    $cards = array();

    $result = $db->query("SELECT Collection.*, Types.* FROM Collection INNER JOIN Types ON Collection.Type_Code = Types.Type_Code");

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $card = new Card($row['Collection_Code'], $row['Title'], $row['Author_Name'], $row['Cover_Image'], $row['State'], $row['Edition_Date'], $row['Buy_Date'], $row['Status'], $row['Type_Name'], $row['pages_or_duration']);
      $cards[] = $card;
    }
    

    return $cards;
  }
}
?>