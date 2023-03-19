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
  public function updateCollectionState1($collection_code, $status, $nickname,$Reservation_Code) {
    // Prepare the SQL statements
    $collectionSql = "UPDATE collection SET Status = :status WHERE collection_code = :collection_code";
    $reservationSql = "INSERT INTO Borrowings (Borrowing_Date, Borrowing_Return_Date, Collection_Code, Nickname,Reservation_Code) 
                       VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 15 DAY), :collection_code, :nickname,:Reservation_Code)";

    // Bind the parameters for the collection SQL statement
    $collectionStmt = $this->db->prepare($collectionSql);
    $collectionStmt->bindParam(':status', $status, PDO::PARAM_STR);
    $collectionStmt->bindParam(':collection_code', $collection_code, PDO::PARAM_INT);

    // Bind the parameters for the reservation SQL statement
    $reservationStmt = $this->db->prepare($reservationSql);
    $reservationStmt->bindParam(':collection_code', $collection_code, PDO::PARAM_INT);
    $reservationStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
    $reservationStmt->bindParam(':Reservation_Code', $Reservation_Code, PDO::PARAM_INT);

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
public function updateCollectionState2($collection_code, $status) {
    // Prepare the SQL statements
    $collectionSql = "UPDATE collection SET Status = :status WHERE collection_code = :collection_code";
    // $reservationSql = "INSERT INTO Borrowings (Borrowing_Date, Borrowing_Return_Date, Collection_Code, Nickname,Reservation_Code) 
    //                    VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 15 DAY), :collection_code, :nickname,:Reservation_Code)";

    // Bind the parameters for the collection SQL statement
    $collectionStmt = $this->db->prepare($collectionSql);
    $collectionStmt->bindParam(':status', $status, PDO::PARAM_STR);
    $collectionStmt->bindParam(':collection_code', $collection_code, PDO::PARAM_INT);

    // Bind the parameters for the reservation SQL statement
    // $reservationStmt = $this->db->prepare($reservationSql);
    // $reservationStmt->bindParam(':collection_code', $collection_code, PDO::PARAM_INT);
    // $reservationStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
    // $reservationStmt->bindParam(':Reservation_Code', $Reservation_Code, PDO::PARAM_INT);

    // Execute the statements within a transaction
    $this->db->beginTransaction();
    try {
        $collectionStmt->execute();
        // $reservationStmt->execute();
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
class Book {
  private $collectionCode;
  private $nickname;
  private $title;
  private $authorName;
  private $coverImage;
  private $status;
  private $reservationDate;
  private $reservationExpirationDate;
  private $borrowingDate;
  private $borrowingReturnDate;

  public function __construct($collectionCode,$nickname, $title, $authorName, $coverImage, $status, $reservationDate, $reservationExpirationDate, $borrowingDate, $borrowingReturnDate) {
      $this->collectionCode = $collectionCode;
      $this->nickname = $nickname;
      $this->title = $title;
      $this->authorName = $authorName;
      $this->coverImage = $coverImage;
      $this->status = $status;
      $this->reservationDate = $reservationDate;
      $this->reservationExpirationDate = $reservationExpirationDate;
      $this->borrowingDate = $borrowingDate;
      $this->borrowingReturnDate = $borrowingReturnDate;
  }

  public function getCollectionCode() {
      return $this->collectionCode;
  }
  public function getNickname() {
    return $this->nickname;
}

  public function getTitle() {
      return $this->title;
  }

  public function getAuthorName() {
      return $this->authorName;
  }

  public function getCoverImage() {
      return $this->coverImage;
  }

  public function getStatus() {
      return $this->status;
  }

  public function getReservationDate() {
      return $this->reservationDate;
  }

  public function getReservationExpirationDate() {
      return $this->reservationExpirationDate;
  }

  public function getBorrowingDate() {
      return $this->borrowingDate;
  }

  public function getBorrowingReturnDate() {
      return $this->borrowingReturnDate;
  }
  public static function getProfilcards()
  {
      require('connect.php');
      $cards = array();
  
      $stmt = $db->prepare("SELECT 
      Collection.Collection_Code,
      Collection.Title, Collection.Author_Name, 
      Collection.Cover_Image, 
       Collection.Status, 
       Reservation.Reservation_Date,
       Reservation.Reservation_Expiration_Date,
      Borrowings.Borrowing_Date, 
      Borrowings.Borrowing_Return_Date
      FROM Collection
      INNER JOIN Reservation ON Collection.Collection_Code = Reservation.Collection_Code
      LEFT JOIN Borrowings ON Reservation.Reservation_Code = Borrowings.Reservation_Code
      INNER JOIN Members ON Members.Nickname = Reservation.Nickname
      WHERE Members.Nickname = :nickname");
      $stmt->bindParam(':nickname', $_SESSION['nickname']);
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $card = new Book($row['Collection_Code'], $row['Title'], $row['Author_Name'], $row['Cover_Image'], $row['Status'],$row['Reservation_Date'], $row['Reservation_Expiration_Date'], $row['Borrowing_Date'], $row['Borrowing_Return_Date'],$row['Nickname']);
          $cards[] = $card;
      }
  
      return $cards;
  }
}


class Reservations {
  private $collectionCode;
  private $nickname;
  private $title;
  private $authorName;
  private $coverImage;
  private $status;
  private $reservationDate;
  private $reservationExpirationDate;
  private $firstname;
  private $lastname;
  private $email;
  private $reservationcode;

  public function __construct($collectionCode, $nickname, $title, $authorName, $coverImage, $status, $reservationDate, $reservationExpirationDate, $firstname, $lastname, $email,$reservationcode) {
      $this->collectionCode = $collectionCode;
      $this->nickname = $nickname;
      $this->title = $title;
      $this->authorName = $authorName;
      $this->coverImage = $coverImage;
      $this->status = $status;
      $this->reservationDate = $reservationDate;
      $this->reservationExpirationDate = $reservationExpirationDate;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->email = $email;
      $this->reservationcode = $reservationcode;
  }

  public function getCollectionCode() {
      return $this->collectionCode;
  }

  public function getNickname() {
      return $this->nickname;
  }

  public function getTitle() {
      return $this->title;
  }

  public function getAuthorName() {
      return $this->authorName;
  }

  public function getCoverImage() {
      return $this->coverImage;
  }

  public function getStatus() {
      return $this->status;
  }

  public function getReservationDate() {
      return $this->reservationDate;
  }

  public function getReservationExpirationDate() {
      return $this->reservationExpirationDate;
  }

  public function getFirstname() {
      return $this->firstname;
  }

  public function getLastname() {
      return $this->lastname;
  }

  public function getEmail() {
      return $this->email;
  }
  public function getReservationCode() {
    return $this->reservationcode;
}

  public static function getReservation() {
      require('connect.php');
      $cards = array();
      $stmt = $db->prepare("SELECT 
          Collection.*, 
          Reservation.*,
          Members.*
          FROM Collection
          INNER JOIN Reservation ON Collection.Collection_Code = Reservation.Collection_Code
          INNER JOIN Members ON Reservation.Nickname = Members.Nickname;
      ");

      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $card = new Reservations(
              $row['Collection_Code'], 
              $row['Nickname'], 
              $row['Title'],
              $row['Author_Name'],  
              $row['Cover_Image'], 
              $row['Status'],
              $row['Reservation_Date'], 
              $row['Reservation_Expiration_Date'],
              $row['Firstname'],
              $row['Lastname'],
              $row['Email'],
              $row['Reservation_Code']

          );
          $cards[] = $card;
      }

      return $cards;
  }
}
class Borrowings {
    private $collectionCode;
    private $nickname;
    private $title;
    private $firstname;
    private $lastname;
    private $email;

    private $authorName;
    private $coverImage;
    private $status;
    private $borrowingDate;
    private $borrowingReturnDate;
    private $reservationCode;
  
    public function __construct($collectionCode, $nickname, $title, $authorName, $coverImage, $status, $firstname, $lastname, $email, $reservationcode, $borrowingDate, $borrowingReturnDate, $reservationCode) {
        $this->collectionCode = $collectionCode;
        $this->nickname = $nickname;
        $this->title = $title;
        $this->authorName = $authorName;
        $this->coverImage = $coverImage;
        $this->status = $status;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->reservationCode = $reservationCode;
        $this->borrowingDate = $borrowingDate;
        $this->borrowingReturnDate = $borrowingReturnDate;
        $this->reservationCode = $reservationCode;
    }
  
    public function getCollectionCode() {
        return $this->collectionCode;
    }
  
    public function getNickname() {
        return $this->nickname;
    }
  
    public function getTitle() {
        return $this->title;
    }
  
    public function getAuthorName() {
        return $this->authorName;
    }
  
    public function getCoverImage() {
        return $this->coverImage;
    }
  
    public function getStatus() {
        return $this->status;
    }
  
    public function getFirstname() {
        return $this->firstname;
    }
  
    public function getLastname() {
        return $this->lastname;
    }
  
    public function getEmail() {
        return $this->email;
    }
  
    public function getReservationCode() {
        return $this->reservationCode;
    }
  
    public function getBorrowingDate() {
        return $this->borrowingDate;
    }
  
    public function getBorrowingReturnDate() {
        return $this->borrowingReturnDate;
    }
  
    public static function getBorrowings() {
        require('connect.php');
        $cards = array();
        $stmt = $db->prepare("SELECT 
            Collection.*, 
            Reservation.*,
            Members.*,
            Borrowings.*
            FROM Collection
            INNER JOIN Reservation ON Collection.Collection_Code = Reservation.Collection_Code
            INNER JOIN Members ON Reservation.Nickname = Members.Nickname
            INNER JOIN Borrowings ON Borrowings.Reservation_Code = Reservation.Reservation_Code;
        ");
  
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $card = new Borrowings(
                $row['Collection_Code'], 
                $row['Nickname'], 
                $row['Title'],
                $row['Author_Name'],  
                $row['Cover_Image'], 
                $row['Status'],
                $row['Firstname'],
                $row['Lastname'],
                $row['Email'],
                $row['Reservation_Code'],
                $row['Borrowing_Date'],
                $row['Borrowing_Return_Date'],
                $row['Reservation_Code']
            );
            $cards[] = $card;
        }
  
        return $cards;
    }
}

