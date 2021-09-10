<?php 
    include "../admin/connection.php";
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
    }

    if(!empty($_GET['sifraKursa'])) {
        $_SESSION['sifraKursa'] = $_GET['sifraKursa'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--staviti odgovarajuce ime kursa ovde kad  se preuzmu podaci o kursu-->
    <title> Kurs </title>
    
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">

    <!-- Bootstrap cdn -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--CSS sheet -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"></script>
</head>
<body style="background-image: linear-gradient(#7ea7e0, white);">

    <!-- ukoliko je admin na ovoj stranici nece se prikazivati navbar, vec samo dugme za vracanje na admin panel -->
    
   <?php

        if($_SESSION['tipKorisnika'] != "admin") {
            include "../navbar.php";
        } 
   ?>

   <?php if($_SESSION['tipKorisnika'] == "admin") { ?>
        <div class="ml-3 mt-3">
            <button id="adminPanelBtn" type="button" class="btn btn-dark bg-blue rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-arrow-left mr-2"></i><small class="text-uppercase font-weight-bold">Nazad na admin panel</small></button>
        </div> <?php
   }
   
   ?>

    <div class="container my-5" id="materialContent">
    <?php 

        global $conn;

        if($_SESSION['tipKorisnika'] == "profesor") {
            $ime = $_SESSION['imeKorisnika'];
            $prezime = $_SESSION['prezimeKorisnika'];

            $sql = "SELECT * FROM profesor INNER JOIN sifra ON profesor.idProfesora = sifra.idProfesora 
            WHERE imeProfesora = '$ime' AND prezimeProfesora = '$prezime'";

            $R = mysqli_query($conn, $sql);
            $r = $R->fetch_assoc();

            $email = $r['emailProfesora'];
            $courseID = $r['sifraKursa'];

            $query = "SELECT * FROM kurs INNER JOIN sifra ON kurs.sifraKursa = sifra.sifraKursa INNER JOIN profesor ON sifra.idProfesora = profesor.idProfesora 
            WHERE emailProfesora = '$email' AND kurs.sifraKursa='".$_SESSION["sifraKursa"]."'";

            $result = mysqli_query($conn, $query);

            $num = $result->num_rows;

            $counter = 0;

            if($num > 0) {
                while($counter < $num) {
                    $row = $result->fetch_assoc();
                    $sifraKursa=$row['sifraKursa'];
                    ?>
            
                    <h2 class="pb-4"> <strong> <?php echo $row['naziv']; ?> </strong></h2>
                    <p> <strong> Godina slušanja: </strong> <?php echo $row['godinaSlusanja']; ?> </p>
                    <p> <strong> Predmetni nastavnik: </strong> <?php echo $row['imeProfesora']." ".$row['prezimeProfesora']; ?>  </p>
                    <p> <strong> Kontakt: </strong> <?php echo $row['emailProfesora']; ?>  </p>
                
                    <?php
                    break;
                }
            }
        }

        else if($_SESSION['tipKorisnika'] == "admin") {

            if(!empty($_GET['sifraKursa'])) {
                $id = $_GET['sifraKursa'];
            

                $sql = "SELECT * FROM kurs INNER JOIN sifra ON kurs.sifraKursa = sifra.sifraKursa INNER JOIN profesor ON profesor.idProfesora = sifra.idProfesora
                WHERE kurs.sifraKursa = '$id'";

                $res = mysqli_query($conn, $sql);

                $num = $res->num_rows;

                $counter = 0;
                if($num > 0) {
                    while($counter < $num) {
                        $row = $res->fetch_assoc();
                        ?>
            
                        <h2 class="pb-4"> <strong> <?php echo $row['naziv']; ?> </strong></h2>
                        <p> <strong> Godina slušanja: </strong> <?php echo $row['godinaSlusanja']; ?> </p>
                        <p> <strong> Predmetni nastavnik: </strong> <?php echo $row['imeProfesora']." ".$row['prezimeProfesora']; ?>  </p>
                
                        <?php
                        break;
                    }
                }
            }
        }

        else if($_SESSION['tipKorisnika'] == "student") {
            
            $sql = "SELECT * FROM kurs INNER JOIN sifra ON kurs.sifraKursa = sifra.sifraKursa INNER JOIN profesor ON sifra.idProfesora = profesor.idProfesora WHERE kurs.sifraKursa='".$_SESSION["sifraKursa"]."'";

            $result = mysqli_query($conn, $sql);

            $num = $result->num_rows;

            $counter = 0;
            if($num > 0) {
                while($counter < $num) {
                    $row = $result->fetch_assoc();

                    $courseID = $row['sifraKursa'];
                    ?>
            
                    <h2 class="pb-4"> <strong> <?php echo $row['naziv']; ?> </strong></h2>
                    <p> <strong> Godina slušanja: </strong> <?php echo $row['godinaSlusanja']; ?> </p>
                    <p> <strong> Predmetni nastavnik: </strong> <?php echo $row['imeProfesora']." ".$row['prezimeProfesora']; ?>  </p>
                    <p> <strong> Kontakt: </strong> <?php echo $row['emailProfesora']; ?>  </p>
                
                    <?php
                    break;
                }
            }
        }

        ?>

        <?php if($_SESSION['tipKorisnika'] == "admin" || $_SESSION['tipKorisnika'] == "profesor") { ?>
        <hr>
        <h4><strong>Studenti koji slusaju predmet</strong></h4>
        <div class="text-center">
            <button class="btn btn-primary my-2" data-toggle="collapse" data-target="#prikaziStudente">Prikaži studente koji slušaju predmet</button>
        </div>
        <?php
        }
        ?>


        <div id="prikaziStudente" class="collapse my-3">
            <div class="table-responsive text-center">
            <table class="table table-bordered table-md">
                <thead class="thead-dark">
                <tr>
                    <th>Email studenta </th>
                    <th>Broj indeksa</th>
                    <th>Slika studenta</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Godina studija</th>
                    <th>Rezultati na testovima</th>
                    
                </tr>
                </thead>
                <!--ovde ide ucitavanje i prikazivanje svih pitanja za ovaj test do sad-->

                <?php

                    global $conn;

                    $course = $_SESSION['sifraKursa'];
                    $query = "SELECT * FROM prati INNER JOIN student ON prati.idStudenta = student.idStudenta INNER JOIN sifra ON prati.sifraKursa = sifra.sifraKursa
                    WHERE prati.sifraKursa = '$course'";

                    $result = mysqli_query($conn, $query);

                    $numOfRows = $result->num_rows;

                    $counter = 0;

                    if($numOfRows > 0) {
                        while($counter < $numOfRows) {
                            $row = $result->fetch_assoc(); ?>

                            <tr>
                                <td> <?php echo $row['emailStudenta']; ?>
                                <td> <?php echo $row['brojIndeksa']; ?> </td>
                                <td> <?php echo "<img src='../assets/".$row['fotografija']."' style='width: 3em'> "?> </td>
                                <td> <?php echo $row['imeStudenta']; ?> </td>
                                <td> <?php echo $row['prezimeStudenta']; ?> </td>
                                <td> <?php echo $row['godina']; ?> </td>                   
                                <td> <button type="button" class="btn btn-success prikaziBtn"> Prikaži </button> </td>
                            </tr> <?php
                            $counter++;
                        }
                    }
                ?>


                <!--<tr>
                    <td>43/2016</td>
                    <td><img src="../assets/defaultpp.jpg" alt="Profilna slika" style="width:3em;"></td>
                    <td>Marko</td>
                    <td>Markovic</td>
                    <td>IV</td>                   
                    <td><button type="button" class="btn btn-success prikaziBtn">Prikaži</button></td>
                </tr>
                <tr>
                    <td>21/2016</td>
                    <td><img src="../assets/defaultpp.jpg" alt="Profilna slika" style="width:3em;"></td>
                    <td>Petar</td>
                    <td>Jovanovic</td>
                    <td>IV</td>                   
                    <td><button type="button" class="btn btn-success prikaziBtn">Prikaži</button></td>
                </tr>-->
            </table>

            <div class="text-center">
                <button type="button" class="btn btn-primary insertBtn" data-toggle="insertModal" data-target="#insertModal"> Dodaj Studenta </button>
            </div>
            </div>
        </div> <?php

        ?>

        <div class="modal" id="insertModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Dodavanje studenta na kurs</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="addStudentToCourse.php" method="post">
                        <label for="studentEmail" style="display:block;">Email studenta</label>
                        <input type="text" id="studentEmail" name="studentEmail">

                        <!-- <label for="courseID" style="display:block;">Sifra Kursa</label> -->
                        <input type="hidden" id="courseID" name="courseID" value="<?php echo $sifraKursa ?>">
                    
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="addStudentToCourseBtn"> Dodaj studenta na kurs </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
                </div>
                </form>
                </div>
            </div>
        </div>
        
        <div class="modal" id="prikaziModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rezultat testa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="font-size:1.5em;" id="loadResult">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        
        <hr>
        <h4><strong>Testovi</strong></h4>
        
        <?php

            global $conn;
            $email = $_SESSION['emailKorisnika'];

            $courseID = $_SESSION['sifraKursa'];
            
            //if($_SESSION['tipKorisnika'] == "student") {
            //    $query = "SELECT * FROM test INNER JOIN radio ON radio.idTesta = test.idTesta INNER JOIN student ON radio.idStudenta = student.idStudenta
            //    WHERE test.sifraKursa = '$courseID' ";
           //}
            //else {
                $query = "SELECT * FROM test WHERE sifraKursa = '$courseID'";
            //}

            $result = mysqli_query($conn, $query);

            $numOfRows = $result->num_rows;

            $counter = 0;

            if($result) {
                if($numOfRows > 0) {
                    while($counter < $numOfRows) {
                        $row = $result->fetch_assoc(); ?>

                            <div class="nedelje">
                                <div class="material">
                                <?php if($_SESSION['tipKorisnika'] == "profesor" || $_SESSION['tipKorisnika'] == "admin") { ?>
                                    <a  href="<?php echo "../nastavnik/Question.php?test_id=".$row['idTesta']."&nazivTesta=".$row['nazivTesta']; ?>" ><i class="fas fa-scroll"></i> <?php echo $row['nazivTesta']; ?></a>
                                <?php }
                                ?>
                                    
                                <?php if($_SESSION['tipKorisnika'] == "profesor" || $_SESSION['tipKorisnika'] == "admin") { ?>
                                    <a href="<?php echo "deleteTest.php?idTesta=".$row['idTesta'];?>" style="float:right"; class="btn btn-defaut btn-danger"> Obrisi Test </a>
                                <?php
                                }
                                ?>
                                    
                                <?php 
                                if(!empty($row['status'])) {
                                    if($row['status'] == "zatvoren") {
                                        if($_SESSION['tipKorisnika'] == "profesor" || $_SESSION['tipKorisnika'] == "admin") { ?>
                                            <a href="<?php echo "allowTest.php?idTesta=".$row['idTesta'];?> " style="float:right"; class="btn btn-defaut btn-success"> Odobri Test </a>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                                    
                                <?php 
                                if(!empty($row['status'])) {
                                    if($row['status'] == "odobren") {
                                        if($_SESSION['tipKorisnika'] == "profesor" || $_SESSION['tipKorisnika'] == "admin") { ?>
                                            <a href="<?php echo "disallowTest.php?idTesta=".$row['idTesta'];?> " style="float:right"; class="btn btn-defaut btn-warning"> Zatvori Test </a>
                                        <?php
                                        }

                                        else if($_SESSION['tipKorisnika'] == "student") { 
                                            
                                            $SQLquery = "SELECT * FROM radio WHERE emailStudenta = '$email' and sifraKursa='".$_SESSION['sifraKursa']."' and radio.idTesta='".$row['idTesta']."'";
                                            //$SQLquery = "SELECT * FROM radio WHERE emailStudenta = '$email'";

                                            $result = mysqli_query($conn, $SQLquery);
                                                                                
                                     
                                            if(mysqli_num_rows($result) != 0) { ?>
                                            <?php
                                            } else{
                                                ?> 
                                                 <a href="<?php echo "../student/test.php?test_id=".$row['idTesta']."&nazivTesta=".$row['nazivTesta']; ?>"> <i class="fas fa-scroll"> <?php echo $row['nazivTesta']; ?> </i> </a>
                                                <?php
                                            }                                          
                                        }
                                    }
                                }                                       
                                ?>
                            </div>
                        </div>

                    <?php
                    $counter++;
                    }
                }
            }
            
        ?>
            
            <?php if($_SESSION['tipKorisnika'] == "profesor" || $_SESSION['tipKorisnika'] == "admin") { ?>
            <!-- Button to Open the Modal -->
            <div class="text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Kreiraj test </button>
            </div>
            <?php
            }
            ?>


            <!-- The Modal -->
            <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kreiranje testa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="addTest.php" method="post" name="testForm">
                        <label  for="testName" style="display:block;"> Naziv testa:</label>
                        <input type="text" id="testName" name="testName">

                        <label  for="testName" style="display:block;"> Sifra Kursa: </label>
                        <input type="text" id="testName" name="cID" value="<?php echo $courseID; ?>">
                    
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="createTestBtn" >Kreiraj test</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
                </div>
                </form>
                </div>
            </div>
            </div>


       
        <hr>
        <?php if($_SESSION['tipKorisnika'] == "profesor" || $_SESSION['tipKorisnika'] == "admin") { ?>
        <h4><strong>Dodaj dokumenta</strong></h4>
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <?php 

        $email = $_SESSION['emailKorisnika'];

        $query = "SELECT * FROM sifra INNER JOIN profesor ON sifra.idProfesora = profesor.idProfesora WHERE profesor.emailProfesora = '$email' ";
        $result = mysqli_query($conn, $query);

        $row = $result->fetch_assoc();
        
        $_SESSION['kurs'] = $row['sifraKursa']; 
        
        ?>
            <div class="custom-file form-group">
                    <input type="file" class="custom-file-input" id="customFile" name="file">
                    <label class="custom-file-label" for="customFile">Izaberi dokument</label>
            </div>
            <div class="form-group mt-4">
                <label for="sel1">Nedelja kojoj dokument pripada:</label>
                <select class="form-control" id="sel1" name="week">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" name="submitBtn" class="btn btn-primary"> Dodaj materijal </button>
            </div>
            
        </form>
        <hr>
        <?php
        }
        ?>
        <!-- postavlja ce se petlja koja ce prolaziti kroz sav materijal po nedeljama i u svaku nedelju dodavati odgovarajuc materijal
    ukoliko se desi da neka nedelja nema materijal(ispitivanje pomocu if uslova) postavlja se badge sa obavestenjem -->

    <?php include "../ListFiles.php"; ?>


    <?php 
    if($_SESSION['tipKorisnika'] == "profesor") {
        for($i = 1; $i <= 15; $i++) { ?>
            <div class="nedelje">
                <h4> Nedelja <?php echo $i; ?>
                <div class="material">
                <?php ListFiles($_SESSION['sifraKursa'], $i); ?>
                </div>
                <hr>
            </div> <?php
        }
    }

    else if($_SESSION['tipKorisnika'] == "admin") {
        for($i = 1; $i <= 15; $i++) { ?>
            <div class="nedelje">
                <h4> Nedelja <?php echo $i; ?>
                <div class="material">
                    <?php 
                    //if(!empty($_GET['sifraKursa'])) {
                        ListFiles($_GET['sifraKursa'], $i);
                    //}

                    //else { ?>
                    
                </div>
                <hr>
            </div> <?php
        }
    }

    else if($_SESSION['tipKorisnika'] == "student") {
        for($i = 1; $i <= 15; $i++) { ?>
            <div class="nedelje">
                <h4> Nedelja: <?php echo $i; ?>
                    <div class="material">
                    <?php 
                        //if(!isset($_SESSION['sifraKursa'])) {
                            ListFiles($_SESSION['sifraKursa'], $i);
                        //}
                        //else {  ?>
                        
                    </div>
                <hr>
            </div> 
        <?php
        }
    }
    ?>
</div>
   <?php include("../footer.php")?>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

    <script>
        //dodavanje imena kod upload-a dokumenata
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        
        $('.prikaziBtn').on('click',function(){
            
            
            $tr=$(this).closest('tr');
            var data=$tr.children("td").map(function(){
                return $(this).text();
            }).get();

           
            

            //iskoristiti ovo data da se napravi php funkcija koja ce vracati 
            //rezultate za studenta sa indeksom data[0] i te rezultate prikazati unutar modala
            //za slanje javascript varijable u php funkciju ili fajl ce vrv biti potreban ajax
            var indeks=data[0];
            console.log(data);
            email = data[0];

            $('#prikaziModal').modal('show');

            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("loadResult").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "../nastavnik/showTestResult.php?emailStudenta="+email, true);
                xmlhttp.send(null);
            
        })

        $('.insertBtn').on('click', function() {
            $('#insertModal').modal('show');

        })

        $('')

        $('#adminPanelBtn').on('click',function(){

            document.location.href="../admin/kursevi.php"


        });
        
    </script>


    <?php

    if($_SESSION['tipKorisnika'] == "admin") {
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
    }
?>

</body>
</html>
