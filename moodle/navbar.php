<nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
    
        <a href="#" class="navbar-brand"><i class="fas fa-book"></i>︁︁ E-ucenje</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menuItems">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuItems">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php 
                        if($_SESSION['tipKorisnika'] == "student") { ?>
                            <a href="../student/kursevi.php" class="nav-link">Kursevi</a>
                        <?php 
                        }

                        else if($_SESSION['tipKorisnika'] == "profesor") { ?>
                            <a href="../nastavnik/kursevi.php" class="nav-link"> Kursevi </a>
                        <?php 
                        }
                    ?>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target">
                    <?php
                        include "logInProcess.php";

                    ?>
                      <?php echo "<img src='../assets/".$_SESSION['fotografijaKorisnika']."' style='width:20px' float:'right'>"?> 
                       <?php
                            
                            
                            if($_SESSION['loggedin'] == true) {
                                echo $_SESSION['imeKorisnika']." ".$_SESSION['prezimeKorisnika'];
                            }

                       ?> 
                       <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_target">
                        <a href="informacije.php" class="dropdown-item"> Moj profil </a>
                        <a href="../logout.php" class="dropdown-item" id="logoutBtn"> Odjava </a>

                    </div>
                </li>

                
            </ul>
        </div>
        
</nav>
