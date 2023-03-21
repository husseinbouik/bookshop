<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
  <script src="https://kit.fontawesome.com/0e22389e8c.js" crossorigin="anonymous"></script>

  <link href="../css/style_profile.css" alt="stylesheet" />
  <title>Document</title>
</head>

<body>
  <?php
  session_start();
  require 'functions.php';

  require 'connect.php';

  require 'navbar.php';
  $nickname = $_SESSION["nickname"];
  $sql = "SELECT * FROM Members WHERE nickname = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$nickname]);


  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nickname = $row["Nickname"];
    $first_name = $row["Firstname"];
    $last_name = $row["Lastname"];
    $phone_number = $row["PhoneNumber"];
    $email = $row["Email"];
    $password = $row["Password"];

    // Replace HB with the user's initials
    $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
  } else {
    echo "User not found.";
  }

  ?>
  <!-- Display user's information using HTML code -->
  <div class="profilinfo d-flex gap-5 " style="height: 320px; padding: 0%; margin-top:89px;">
    <div class="rounded-circle  d-flex justify-content-center align-items-center" style="width: 150px; height: 150px;margin-top:89px;margin-left:89px;background-color: #ff8049;">
      <span class="text-white display-1 font-weight-bold"><?php echo $initials; ?></span>
    </div>
    <div class="userinfo  p-4 rounded w-50 " style=" background-color: #FAFAEE;">
      <p class="card-text">First name: <span class="fw-bold"><?php echo  $row["Firstname"]; ?></span></p>
      <p class="card-text">Last name: <span class="fw-bold"><?php echo $row["Lastname"]; ?></span></p>
      <p class="card-text">Phone number: <span class="fw-bold"><?php echo $row["PhoneNumber"];; ?></span></p>
      <p class="card-text">Email: <span class="fw-bold"><?php echo $row["Email"]; ?></span></p>
      <p class="card-text">Password: <span class="fw-bold"><?php echo $row["Password"]; ?></span></p>
      <div class="editprofil"><button type="button" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#editModal">Edit <iconify-icon icon="material-symbols:edit"></iconify-icon></button></div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="editprofil.php" enctype="multipart/form-data">
          <input type="hidden" name="Nickname" value="<?php echo  $row["Nickname"];  ?>" id="nickname">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row["Firstname"]; ?>">
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row["Lastname"]; ?>">
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $row["PhoneNumber"]; ?>">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["Email"]; ?>">
            </div>
            <div class="mb-3">
              <label for="currentPassword" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="currentPassword" name="currentPassword">
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
            <input type="hidden" name="userId" value="<?php echo $user_id; ?>">
            <button type="submit" class="btn btn-primary" name="editUser">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-wrap gap-3">
    <?php

    include 'Collection.php';
    $cards = Book::getProfilcards();
    foreach ($cards as $card) {

    ?>

      <div class="wow" style="position: relative;margin:10px ;">
        <img class="cardimg" src="<?php echo $card->getCoverImage(); ?>" alt="Background Image" width="250" height="350" style="border-radius: 20px;">
        <img src="../imgs/opacitywaves.png" alt="Overlay Image" width="250" height="350" style="position: absolute; top: 0%; left: 0%; transform: translate(0%, 4%); z-index: 0;">
        <div class="cardcontent " style="position: absolute; top: 62%; left: 0%;z-index: 1;padding: 7%;">
          <h5 class="card-title"><?php echo $card->getTitle(); ?></h5>
          <p class="card-text"><?php echo $card->getAuthorName(); ?></p>
          <?php
          if (!empty($card->getStatus())) {
            if ($card->getStatus() == 'Reserved') {
              $expiration_date = new DateTime($card->getReservationExpirationDate());
              $now = new DateTime();
              $expiration_countdown = $now->diff($expiration_date)->format('%a : %h : %i');
          ?>
              <button class="btn btn-secondary">Reserved</button>
              <span class="red" style="color: red;">
                <i class="fa-sharp fa-solid fa-clock"></i> <?php print($expiration_countdown); ?>
              </span>
            <?php
            } else {
              $now = new DateTime();
              $return_date  = new DateTime($card->getBorrowingReturnDate());
              $return_countdown = $now->diff($return_date)->format('%a : %h : %i');
            ?>
              <button class="btn btn-warning"><?php echo $card->getStatus(); ?></button>
              <span class="red" style="color: red;">
                <i class="fa-solid fa-calendar"></i> <?php 
                print($return_countdown); ?>
              </span>
          <?php
            }
          }
          ?>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</body>
</body>

</html>