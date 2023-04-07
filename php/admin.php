<?php ?>
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
  <script src="../js/addedit.js" defer></script>
  <link href="../css/style-admin.css" rel="stylesheet">
  <title>Document</title>
</head>

<body>
<?php
session_name('admin');
session_start();
require 'functions.php';

require 'connect.php';

require 'navbar.php';

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
  <div class="addcard d-flex justify-content-center align-items-center"><button class="btn btn-warning mt-3 text-white" data-bs-target="#addModalL" data-bs-toggle="modal">add a new card <iconify-icon icon="material-symbols:add-circle" style="color: white;"></iconify-icon></button></div>
  <!-- Modal add -->
  <div class="modal fade" id="addModalL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content h-25">
        <div class="modal-body bgmodal">
          <form action="add.php" method="post" id="addform" class="addform" enctype="multipart/form-data">
            <h2>Ajouter l'anonce</h2>
            <div class=" form-controll secondary-image-wrapper file-input d-md-flex flex-column justify-content-center align-items-center mb-3 w-25 h-25 d-flex">
              <img id="addicon1" class="addicon1" src="../imgs/cloud-upload.svg" alt="Upload Icon" />
              <input type="file" name="images[]" class="addfileUpload addprimaryUpload" id="addfileUpload" />
              <img class="previewImage addpreviewImage1" id="addpreviewImage1" src="#" alt="Image Preview" />
              <i class="fas fa-check-circle"></i>
              <i class="fas fa-exclamation-circle"></i>
              <small>Error message</small>
            </div>
            <div class="d-flex flex-wrap gap-3">
              <div class="form-controll ">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control addtitle " id="addtitle">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>

              </div>
              <div class="form-controll">
                <label for="exampleFormControlInput1" class="form-label">Author Name</label>
                <input type="text" name="authorname" class="form-control addauthorname" id="addauthorname">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
              </div>
              <div class="form-controll">
                <label for="exampleFormControlInput1" class="form-label">Type</label>
                <select class="form-select addtype" name="type" id="addtype" onchange="showTypeField()">
                  <option selected disabled>Type</option>
                  <option value="Book">Book</option>
                  <option value="Novel">Novel</option>
                  <option value="DVD">DVD</option>
                  <option value="Research paper/thesis">Research paper/thesis</option>
                  <option value="Magazine">Magazine</option>
                </select>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
              </div>
              <div class="form-controll" id="addpagesField" style="display:none">
                <label for="pages">Nombre de pages:</label>
                <input type="number" class="addpages" id="addpages" name="pages"><br><br>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
              </div>

              <div class="form-controll" id="adddurationField" style="display:none">
                <label for="duration">Durée (en minutes):</label>
                <input type="number" class="addduration" id="addduration" name="duration"><br><br>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
              </div>
              <div class="form-controll">
                <label for="exampleFormControlInput1" class="form-label">Edition Date</label>
                <input type="date" name="editiondate" class="form-control addeditiondate" id="addeditiondate">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>

              </div>
              <div class="form-controll">
                <label for="exampleFormControlInput1" class="form-label">Buy Date</label>
                <input type="date" name="buydate" class="form-control addbuydate" id="addbuydate">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>

              </div>
              <div class="form-controll">
                <label for="exampleFormControlInput1" class="form-label">State</label>
                <select class="form-select addstate" name="state" id="addstate">
                  <option selected disabled>Choose</option>
                  <option value="New">New</option>
                  <option value="Good condition">Good condition</option>
                  <option value="Acceptable">Acceptable</option>
                  <option value="Quite worn">Quite worn</option>
                  <option value="Torn ">Torn </option>
                </select>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
              </div>
            </div>
            <div class="justify-content-center d-flex">
              <button name="addBtn" value="submit" type="submit" class="btn buttons" id="addBtn">Ajouter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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
      <div class="cardcontent " style="position: absolute; top: 62%; left: 0%;z-index: 1;padding: 7%;">
        <h5 class="card-title"><?php echo $card->getTitle(); ?></h5>
        <p class="card-text"><?php echo $card->getAuthorname(); ?></p>
        <div class="d-flex gap-2">
          <!-- <button class="btn btn-primary">RESERVE</button> -->
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="#" class="btn btn-outline-warning rounded-circle me-md-2" role="button" data-bs-toggle="modal" data-bs-target="#edit<?php echo $card->getId(); ?>"><i class="fa-solid fa-file-pen"></i></a>
            <a href="#" class="btn btn-outline-danger rounded-circle" data-bs-toggle='modal' data-bs-target="#deletee<?php echo $card->getId(); ?>" role="button" value=''><i class="fa-solid fa-trash"></i></a>
          </div>
        </div>
      </div>
      <!-- Modal delete -->
      <div class="modal" id="deletee<?php echo $card->getId(); ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body texte-white bgmodal">
              <h3>étes vous sure de vouloir supprimer</h3>
              <form method="post" action="delete.php">
                <input type="hidden" name="btndelete" value="<?php echo $card->getId(); ?>" id="delete_id">
                <button type="submit" name="delete">Supprimer</button>
                <button type="button" class="btn btn-secondary buttons" data-bs-dismiss="modal">Annuler</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal edit -->
      <div class="modal fade" id="edit<?php echo $card->getId(); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body bgmodal">
              <form action="update.php" method="POST" id="editform" class="editform" enctype="multipart/form-data">
                <h2>Ajouter l'anonce</h2>
                <div class=" form-controll secondary-image-wrapper file-input d-md-flex flex-column justify-content-center align-items-center mb-3 w-25 h-25 d-flex">
                  <img id="editicon1" src="../imgs/cloud-upload.svg" alt="Upload Icon" />
                  <input type="file"  name="image" class="editfileUpload"  value="<?php echo $card->getImage(); ?>"/>
                  <input type="hidden"  name="collection_code" value="<?php echo $card->getId(); ?>">
                  <input type="hidden" name="old_image" class="editfileUpload" value="<?php echo $card->getImage(); ?>">
                  <img class="previewImage editpreviewImage1" id="editpreviewImage1<?php echo $card->getId(); ?>" src="<?php echo $card->getImage(); ?>"  value="<?php echo $card->getImage(); ?>" alt="Image Preview" width="100" style="display: block;" />
                  <i class="fas fa-check-circle"></i>
                  <i class="fas fa-exclamation-circle"></i>
                  <small>Error message</small>
                </div>
                <div class="d-flex flex-wrap gap-3">
                  <div class="form-controll ">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control edittitle" id="edittitle<?php echo $card->getId(); ?>" value="<?php echo $card->getTitle(); ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                  </div>
                  <div class="form-controll">
                    <label for="exampleFormControlInput1" class="form-label">Author Name</label>
                    <input type="text" name="authorname" class="form-control editauthorname" id="editauthorname<?php echo $card->getId(); ?>" value="<?php echo $card->getAuthorname(); ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                  </div>
                  <div class="form-controll">
                    <label for="exampleFormControlInput1" class="form-label">Type</label>
                    <select class="form-select  edittype" name="type" id="edittype<?php echo $card->getId(); ?>">
                      <option selected disabled>Type</option>
                      <option value="Book" <?php if ($card->getType() == 'Book') {echo 'selected';} ?>>Book</option>
                      <option value="Novel" <?php if ($card->getType() == 'Novel') {echo 'selected';} ?>>Novel</option>
                      <option value="DVD" <?php if ($card->getType() == 'DVD') {echo 'selected';} ?>>DVD</option>
                      <option value="Research paper/thesis" <?php if ($card->getType() == 'Research paper/thesis') {echo 'selected';} ?>>Research paper/thesis</option>
                      <option value="Magazine" <?php if ($card->getType() == 'Magazine') {echo 'selected';} ?>>Magazine</option>
                    </select>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                  </div>
                  <div class="form-controll editpagesField" id="editpagesField<?php echo $card->getId(); ?>" style="display:none">
                    <label for="pages">Nombre de pages:</label>
                    <input type="number" class="editpages" id="editpages<?php echo $card->getId(); ?>" name="pages" value="<?php echo $card->getPagesOrDuration(); ?>"><br><br>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                  </div>

                  <div class="form-controll editdurationField" id="editdurationField<?php echo $card->getId(); ?>" style="display:none">
                    <label for="duration">Durée (en minutes):</label>
                    <input type="number" class="editduration" id="editduration<?php echo $card->getId(); ?>" name="duration" value="<?php echo $card->getPagesOrDuration(); ?>" ><br><br>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                  </div>
                  <div class="form-controll">
                    <label for="exampleFormControlInput1" class="form-label">Edition Date</label>
                    <input type="date" name="editiondate" class="form-control editeditiondate" id="editeditiondate" value="<?php echo $card->getEditionDate(); ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                  </div>
                  <div class="form-controll">
                    <label for="exampleFormControlInput1" class="form-label">Buy Date</label>
                    <input type="date" name="buydate" class="form-control editbuydate" id="editbuydate<?php echo $card->getId(); ?>" value="<?php echo $card->getBuyDate(); ?>">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>

                  </div>
                  <div class="form-controll">
                    <label for="exampleFormControlInput1" class="form-label">State</label>
                    <select class="form-select editstate" name="state" id="editstate<?php echo $card->getId(); ?>">
                      <option selected disabled>Choose</option>
                      <option value="New" <?php if ($card->getState() == 'New') {echo 'selected';} ?>>New</option>
                      <option value="Good condition" <?php if ($card->getState() == 'Good condition') {echo 'selected';} ?>>Good condition</option>
                      <option value="Acceptable" <?php if ($card->getState() == 'Acceptable') {echo 'selected';} ?>>Acceptable</option>
                      <option value="Quite worn" <?php if ($card->getState() == 'Quite worn') {echo 'selected';} ?>>Quite worn</option>
                      <option value="Torn" <?php if ($card->getState() == 'Torn') {echo 'selected';} ?>>Torn </option>
                    </select>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                  </div>
                </div>
                <div class="justify-content-center d-flex">
                  <button name="addBtn" value="submit" type="submit" class="btn buttons addBtn" id="editBtn<?php echo $card->getId(); ?>">update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
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
  <script src="../js/addedit.js"></script>
  <script>function showTypeField(){
  var addtype = document.getElementById("addtype").value;
  var addpagesField = document.getElementById("addpagesField");
  var adddurationField = document.getElementById("adddurationField");
  
  // hide all fields by default
  addpagesField.style.display = "none";
  adddurationField.style.display = "none";
  
  // show fields based on selected addtype
  if (addtype == "Book" || addtype == "Novel" || addtype == "Research paper/thesis" || addtype == "Magazine") {
    addpagesField.style.display = "block";
  } else if (addtype == "DVD" ) {
    adddurationField.style.display = "block";
  }
  }</script>

</body>

</html>