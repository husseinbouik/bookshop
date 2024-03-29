<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto&family=Rozha+One&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/0e22389e8c.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/script.js" defer></script>
  <link href="../css/style-sign.css" rel="stylesheet" />
  <title>Document</title>
</head>

<body>
  <div class="signin d-flex">

    <div class="bgright ">
      <div class="logo">
        <a href="landing-page.php">
          <div class="logobg d-flex justify-content-center align-items-center">
            <img class="imglogo" src="../imgs/Wix-Logo-Maker-removebg-preview (2) 2.svg" alt="OasisBooks Logo" width="100" height="100">
          </div>
        </a>
        <div class="brandname">
          <h2>OasisBooks</h2>
        </div>
      </div>
      <div class="bookimg">
        <img class="bookimg" src="../imgs/illustration-3d-livres-fermes-ouverts-crayon__2_-removebg-preview 1.png" alt="Bootstrap" width="100" height="100">
      </div>
    </div>
    <div class="signin-form">
      <h3>Create A New Account</h3>
      <form action="registration.php"  method="post" id="form" class="form" enctype="multipart/form-data">
        <div class="d-flex gap-2">
          <div class="form-controll ">
            <label for="exampleFormControlInput1" class="form-label">First name</label>
            <input type="text" name="firstname" class="form-control" id="firstname">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>

          </div>
          <div class="form-controll">
            <label for="exampleFormControlInput1" class="form-label">Last name</label>
            <input type="text" name="lastname" class="form-control" id="lastname">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>

          </div>
          <div class="form-controll">
            <label for="exampleFormControlInput1" class="form-label">Nickname</label>
            <input type="text" name="nickname" class="form-control" id="nickname">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>

          </div>
        </div>
        <div class="form-controll">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="text" name="email" class="form-control" id="email">
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>

        </div>
        <div class="form-controll">
          <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
          <input type="number" name="phonenumber" class="form-control" id="phonenumber">
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>

        </div>
        <div class="form-controll">
          <label for="exampleFormControlInput1" class="form-label">Address</label>
          <input type="text" name="address" class="form-control" id="address">
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>

        </div>
        <div class="d-flex gap-2">
          <div class="form-controll">
            <label for="exampleFormControlInput1" class="form-label">CIN</label>
            <input type="text" name="cin" class="form-control" id="cin">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>

          </div>
          <div class="form-controll">
            <label for="exampleFormControlInput1" class="form-label">Date of birth</label>
            <input type="date" name="birthdate" class="form-control" id="birthdate">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>

          </div>
          <div class="form-controll">
            <select name="type" class="form-select" id="type" aria-label="Default select example">
              <option selected>Type</option>
              <option value="Etudiant">Etudiant</option>
              <option value="Fonctionnaire"> Fonctionnaire</option>
              <option value="Employé">Employé</option>
              <option value="Femme au foyer">Femme au foyer</option>

            </select>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>

          </div>
        </div>
        <div class="form-controll">
          <label for="exampleFormControlInput1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password">
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>

        </div>
        <div class="form-controll">
          <label for="exampleFormControlInput1" class="form-label">Confirm password</label>
          <input type="password" name="confirmpassword" class="form-control" id="confirmpassword">
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error message</small>

        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            <a>you already have an account ? <a href='signin.php'> sign in</a></a>
          </label>
        </div>
        <button type="submit" class="register btn" class="" value="submit" id="submit-btn" name="signup">Register</button>
      </form>
    </div>
  </div>
</body>

</html>
