<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto&family=Rozha+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0e22389e8c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
    <link href="../css/style-homepage.css"  rel="stylesheet" >
    <title>Document</title>
</head>
<body>
<?php
session_start();
require 'functions.php';

require 'connect.php';

require 'navbar.php';
 if (isset($_SESSION['error_message'])) {
  $error_message = $_SESSION['error_message'];
  unset($_SESSION['error_message']);
} 
?>
<div class="homeimg">
        <h1 class="brown">"Welcome to our online borrowing books website"</h1>
        <form action="" method="GET">
        <div class="searchinput ">
            <div class="search mx-auto">
                <i class="fa fa-search"></i>
                <input type="text" id="search search-input" name="q" class="form-control" placeholder="Find your next favourite book">
                <button type="submit" class="btn btn-secondary" >Search</button>
              </div>
        </div>
        </form>
            </div> 
            <?php if (isset($error_message)): ?>
    <div class="alert alert-danger mx-auto w-75 h-25 text-center"><?php echo $error_message; ?></div>
<?php endif; ?>
            <div class="d-flex flex-wrap gap-3">

                <?php 
include 'Collection.php';

// Determine the number of items to display per page
$itemsPerPage = 8;

// Get the search query from the URL parameter
$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

// Get the current page number from the URL parameter
$pageNumber = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Get the cards matching the search query
$cards = Card::searchCards($searchQuery);

// Determine the total number of cards
$totalCards = count($cards);

// Calculate the offset and limit for the SQL query
$offset = ($pageNumber - 1) * $itemsPerPage;
$limit = $itemsPerPage;

// Get only the cards for the current page
$currentCards = array_slice($cards, $offset, $limit);

// Display the cards for the current page
foreach ($currentCards as $card) {
            ?>

<div class="wow" style="position: relative;margin:10px ;">
      <img class="cardimg" src="<?php echo $card->getImage(); ?>" alt="Background Image" width="250" height="350" style="border-radius: 20px;">
      <img src="../imgs/opacitywaves.png" alt="Overlay Image" width="250" height="350" style="position: absolute; top: 0%; left: 0%; transform: translate(0%, 4%); z-index: 0;">
      <div class="cardcontent " style="position: absolute; top: 62%; left: 0%;z-index: 1;padding: 5%;">
        <h5 class="card-title"><?php echo $card->getTitle(); ?></h5>
        <p ><?php echo $card->getAuthorname(); ?></p>
        <?php if ($card->getStatus() ==='Available') {
            
    
        ?>
                        <button class="btn btn-primary" data-bs-toggle='modal' data-bs-backdrop="false" data-bs-target="#reseve<?php echo $card->getId(); ?>" role="button" value=''>Available</button>
                         <!-- Modal Reserve -->
      <div class="modal " id="reseve<?php echo $card->getId(); ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body texte-white bgmodal">
              <h3>Would you like to confirm your book reservation?</h3>
              <form  action="reserve.php" method="POST" id="reserveform" enctype="multipart/form-data">
                <input type="hidden" name="collection_code" value="<?php echo $card->getId(); ?>" id="reserve_id">
                <button type="submit" name="reseve">Confirm</button>
                <button type="button" class="btn btn-secondary buttons" data-bs-dismiss="modal">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
                        <?php      
        }elseif ($card->getStatus() ==='Reserved') {
?>
                        <button class="btn btn-secondary">Reserved</button>

    <?php      
        }else{
?>
                        <button class="btn btn-warning">Checked out</button>

<?php      
        }
?>
                      </div>
                  </div>
    <?php      
        }
        // Display the pagination links
$totalPages = ceil($totalCards / $itemsPerPage);
if ($totalPages > 1) {
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $pageNumber) {
            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '&q=' . $searchQuery . '">' . $i . '</a></li>';
        }
    }
    echo '</ul>';
}
?>
            </div>
</body>
</html>
