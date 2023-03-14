<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
    <link href="../css/style_profile.css" alt="stylesheet"/>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-transparent fixed-top">
        <div class="d-flex">
            <div>
        <img src="../imgs/Wix-Logo-Maker-removebg-preview (2) 2.svg" alt="Bootstrap" width="100" height="100">
        </div>
        <div class="mt-5">
        <span class="brown">OasisBooks</span>
        </div></div>
    <div class="">
    </div>
</nav>
  <!-- Display user's information using HTML code -->
  <div class="profilinfo d-flex gap-5 " style="height: 320px; padding: 0%; margin-top:89px;">
    <div class="rounded-circle  d-flex justify-content-center align-items-center" style="width: 150px; height: 150px;margin-top:89px;margin-left:89px;background-color: #ff8049;">
      <span class="text-white display-1 font-weight-bold"><?php echo $initials; ?></span>
    </div>
    <div class="userinfo  p-4 rounded w-50 " style=" background-color: #FAFAEE;">
      <p class="card-text">First name: <span class="fw-bold"><?php echo  $row["first_name"]; ?></span></p>
      <p class="card-text">Last name: <span class="fw-bold"><?php echo $row["last_name"]; ?></span></p>
      <p class="card-text">Phone number: <span class="fw-bold"><?php echo $row["phone_number"];; ?></span></p>
      <p class="card-text">Email: <span class="fw-bold"><?php echo $row["email"]; ?></span></p>
      <p class="card-text">Password: <span class="fw-bold"><?php echo $row["password"]; ?></span></p>
      <div class="editprofil"><button  type="button" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#editModal" >Edit <iconify-icon icon="material-symbols:edit"></iconify-icon></button></div>
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
        <form method="POST" action="editprofilinfo.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo$row["first_name"]; ?>">
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row["last_name"]; ?>">
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $row["phone_number"]; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>">
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
<div class="d-flex gap-3">
  <div class="wow" style="position: relative;margin:10px ;">
    <img class="cardimg" src="../imgs/Group 48.png" alt="Background Image" width="250" height="350" style="border-radius: 20px;">
    <img src="../imgs/opacitywaves.png" alt="Overlay Image" width="250" height="350" style="position: absolute; top: 0%; left: 0%; transform: translate(0%, 4%); z-index: 0;">
    <div class="cardcontent " style="position: absolute; top: 62%; left: 0%;z-index: 1;padding: 10%;">
        <h5 class="card-title">Call me by your name</h5>
        <p class="card-text">Lucas ourlando</p>
        <button class="btn btn-warning">RESERVE</button>
      </div>
  </div>
</div>
</body>
</body>
</html>