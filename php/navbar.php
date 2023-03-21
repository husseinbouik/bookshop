
<?php if (!authenticated()) { ?>
    <nav class="navbar navbar-transparent fixed-top" style="    background-color: #f5f5dc22;
 padding: 0%;">
        <div class="d-flex">
            <a href="../php/landing-page.php">
                <div>
                    <img src="../imgs/Wix-Logo-Maker-removebg-preview (2) 2.svg" alt="Bootstrap" width="100" height="100">
                </div>
            </a>
            <div class="mt-5">
                <span class="brown">OasisBooks</span>
            </div>
        </div>
        <div class="">
            <a href="../php/signup.php" class="btn sign-up">Sign Up</a>
            <a href="../php/signin.php" class="btn sign-in">Sign In</a>
        </div>
    </nav>
        <?php
    } else {


        require('connect.php');
        $initial = strtoupper(substr($_SESSION['nickname'], 0, 1));
        if (isset($_SESSION["admin"])) {
            if ($_SESSION["admin"] == '1') {

        ?>
                <nav class="navbar navbar-transparent fixed-top" style="  background-color: #f5f5dca9;
 padding: 0%;">
                    <div class="d-flex">
                        <a href="../php/admin.php">
                            <div>
                                <img src="../imgs/Wix-Logo-Maker-removebg-preview (2) 2.svg" alt="Bootstrap" width="100" height="100">
                            </div>
                        </a>
                        <div class="mt-5">
                            <span class="brown">OasisBooks</span>
                        </div>
                    </div>

                    <div class="btn-group me-3">
                        <div class="d-flex gap-3">
                            <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;background-color: #9C382E;">
                                <span class="text-white display-5 font-weight-bold"><?php echo $initial; ?></span>
                            </div>

                            <a data-bs-toggle="dropdown" aria-expanded="false" alt="avatar">
                                <div class="moreicon">
                                    <i class="fa-solid fa-ellipsis-vertical" style="font-size: 36px;margin: 8px;color: #9C382E;"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li><a class="dropdown-item" href="profiladmin.php">profile</a></li> -->
                                <li><a class="dropdown-item" href="admin.php" name="logout">BookLists</a></li>
                                <li><a class="dropdown-item" href="demands.php" name="logout">Reservations<br>&Borrowings</a></li>
                                <li><a class="dropdown-item" href="logout.php" name="logout">logout</a></li>
                            </ul>
                        </div>
                    </div>

                    </div>
                    </div>
                </nav>
            <?php } else { ?>
                <nav class="navbar navbar-transparent fixed-top" style="  background-color: #f5f5dca9;
 padding: 0%;">
                    <div class="d-flex">
                        <a href="../php/homepage.php">
                            <div>
                                <img src="../imgs/Wix-Logo-Maker-removebg-preview (2) 2.svg" alt="Bootstrap" width="100" height="100">
                            </div>
                        </a>
                        <div class="mt-5">
                            <span class="brown">OasisBooks</span>
                        </div>
                    </div>

                    <div class="btn-group me-3">
                        <div class="d-flex gap-3">
                            <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;background-color: #9C382E;">
                                <span class="text-white display-5 font-weight-bold"><?php echo $initial; ?></span>
                            </div>

                            <a data-bs-toggle="dropdown" aria-expanded="false" alt="avatar">
                                <div class="moreicon">
                                <i class="fa-solid fa-ellipsis-vertical" style="font-size: 36px;margin: 8px;color: #9C382E;"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profil.php">profile</a></li>
                                <li><a class="dropdown-item" href="logout.php" name="logout">logout</a></li>
                            </ul>
                        </div>
                    </div>

                    </div>
                    </div>
                </nav>
    <?php
            }
        } else {
            echo 'whaaaaaaaaaaaaaat';
        }
    } ?>
    <script>
        // Get the moreicon element
        var moreicon = document.querySelector(".moreicon");

        // Get the dropdown menu element
        var dropdown = document.querySelector(".dropdown-menu");

        // Hide the dropdown menu by default
        dropdown.style.display = "none";

        // Add a click event listener to the moreicon element
        moreicon.addEventListener("click", function() {
            // Toggle the display of the dropdown menu
            dropdown.style.display = (dropdown.style.display === "none") ? "block" : "none";
        });
    </script>