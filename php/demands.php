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
<!-- Iconify Library -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
    <link href="../css/style-admin.css"  rel="stylesheet" >
    <title>Document</title>
</head>
<body>
    <?php
session_start();
require 'functions.php';

require 'connect.php';

require 'navbar.php';

?>
<div class="buttons" style="margin: 100px;">
  <button class="btn btn-table btnborrowing" type="button" data-toggle="collapse" data-target="#table-container">Borrowing</button>  
  <button class="btn btn-table btnreservation" type="button" data-toggle="collapse" data-target="#table-container">Reservations</button>
</div>
<div class="container" id="table-container">

</div>
<script>
  $(document).ready(function() {
      $(".btn-table").click(function() {
          var tableFile = $(this).text().toLowerCase() + "_table.php";
          $("#table-container").load(tableFile);
      });
  });
  </script>
  
</body>
</html>