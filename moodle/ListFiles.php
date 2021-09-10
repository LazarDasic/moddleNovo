<?php

    include "../admin/connection.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    function ListFiles($courseID, $week) {

        global $conn;
        $query = "SELECT * FROM fajl INNER JOIN kurs ON fajl.sifraKursa = kurs.sifraKursa WHERE fajl.sifraKursa = '$courseID' AND fajl.idSekcije = $week";
        $result = mysqli_query($conn, $query);

        $numOfrows = $result->num_rows;
        $counter = 0;

        $result = mysqli_query($conn, $query);
    
        if($result) {
            if($numOfrows > 0) {
                while($counter < $numOfrows) { 
                    $row = $result->fetch_assoc();
                    if($row['tipFajla'] == "pdf") { 
                        
                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-pdf"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-pdf"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>

                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a>
                            <br>

                        <?php 
                        } 

                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php 
                        }
                    }

                    if($row['tipFajla'] == "doc" || $row['tipFajla'] == "docx") { 

                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-word"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-word"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>

                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php               
                        }
                    }

                    if($row['tipFajla'] == "ppt" || $row['tipFajla'] == "pptx") { 
                        
                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-powerpoint"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-powerpoint"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>
                    
                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php                             
                        }
                    }

                    if($row['tipFajla'] == "xls" || $row['tipFajla'] == "xlsx") { 

                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-excel"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-excel"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>
                    
                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        }   
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php                      
                        } 
                    }

                    if($row['tipFajla'] == "csv") { 
                        
                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-csv"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-csv"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>
                    
                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php 
                        }
                    }

                    if($row['tipFajla'] == "zip" || $row['tipFajla'] == "7z") { 
                        
                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-archive"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-archive"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>

                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php    
                        }
                    }

                    if($row['tipFajla'] == "rar") { 
                        
                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-archive"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-archive"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>

                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        }     
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>
  
                        <?php                                
                        } 
                    }

                    if($row['tipFajla'] == "jpg" || $row['tipFajla'] == "png" || $row['tipFajla'] == "jpeg") { 
                        
                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-image"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-image"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>

                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php 
                        }
                    }

                    if($row['tipFajla'] == "mp3") { 

                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-audio"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-audio"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>

                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php   
                        }
                    }

                    if($row['tipFajla'] == "mp4") { 

                        if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-video"> </i> <?php echo $row['nazivFajla']; ?> </a>
                        <?php
                        }
                        else { ?>
                            <br>
                            <a href="downloads.php?file_id=<?php echo $row['idFajla']; ?>" style="float:left"> <i class="fas fa-file-video"> </i> <?php echo $row['nazivFajla']; ?> </a>
                            <br>
                            <?php
                        }
                        ?>
                        
                        <?php if($_SESSION['tipKorisnika'] == "profesor") { ?>
                        
                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" >  Obrisi </a>
                            <br>

                        <?php 
                        } 
                        
                        else if($_SESSION['tipKorisnika'] == "admin") { ?>

                            <a href="<?php echo $_SERVER['PHP_SELF']."?action=delete&file_id=".$row["idFajla"]; ?>" style="float:right"; class="btn btn-default btn-danger" > Obrisi </a> 
                            <br>

                        <?php    
                        }
                    }
                    $counter++;
                }
            }

            else { ?>
            
                <span class="badge badge-info"> Nema postavljenog materijala za ovu nedelju </span>
        
            <?php
            }
        }
    }
?>

<?php

    if(!empty($_GET['file_id']) && $_GET['action'] == 'delete') {

        global $conn;
        $id = $_GET['file_id'];

        $query = "DELETE FROM fajl WHERE idFajla='$id' ";
        $result = mysqli_query($conn, $query);

        if($result) { 
        ?>
            <script>
                window.alert("Fajl obrisan");
            </script>
        <?php
        }

        else { 
        ?>
            <script>
                window.alert("Fajl nije obrisan");
            </script>
        <?php
        }
    }
?>
