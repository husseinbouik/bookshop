<nav class="navbar navbar-expand-lg fixed-top" id="nav">
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mr-4">
                        <a class="nav-link text-white" href="guest.php">Home</a>
                    </li>
                </ul>
                
    <?php if(!authenticated()){ ?>
    <a href='Account.php' class="btn btn-outline-warning p-2 m-2" > Sign Up </a>
    <a href='Account.php' class="btn btn-warning p-2 m-2"> Log In </a>
    <?php  
    } else { 
    ?>

    <div class="btn-group me-3">
    <img class="img-fluid rounded-circle" width="50" src="https://i.stack.imgur.com/YQu5k.png" data-bs-toggle="dropdown" aria-expanded="false" alt="avatar">
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="profile.php">profile</a></li>
        <li><a class="dropdown-item" href="logout.php" name="logout">logout</a></li>
    </ul>
    </div>
    <?php } ?>
            </div>
        </div>
    </nav>