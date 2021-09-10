<?php

    session_start();
    include "../admin/connection.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikaz kurseva</title>
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">

    <!-- Bootstrap cdn -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--CSS sheet -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"></script>

    <style>
        html{
            min-height:100%;
        }
		h2, h5{
			text-align: center;
		}
		.kurs{
			padding-bottom: 10px;
		}
    </style>
</head>
<body style="background-image: linear-gradient(#7ea7e0, white) ;">
    <?php 

        include("../navbar.php"); 
        
        $sql = "SELECT * FROM student";
        $res = mysqli_query($conn, $sql);
        $row = $res->fetch_assoc();
    ?>
    <div class="container my-5" id="materialContent">
		<h2 class="pb-4"> <strong> <?php echo $row['smer']; ?> </strong></h2>
		<h5 class="pb-4"><strong>Godina studija:</strong> <?php echo $row['godina']; ?> </h2>
		<hr>
		<div class="kurs">
            <?php 

                global $conn;
                
                $idS = $_SESSION['idKorisnika'];
                $query = "SELECT * FROM kurs INNER JOIN prati ON kurs.sifraKursa = prati.sifraKursa INNER JOIN student ON prati.idStudenta = student.idStudenta
                WHERE student.idStudenta = '$idS'";

                $result = mysqli_query($conn, $query);

                $numOfrows = $result->num_rows;

                $counter = 0;

                if($numOfrows > 0) {
                    while($counter < $numOfrows) { 
                        $row = $result->fetch_assoc(); ?>

                        <a href="<?php echo "../nastavnik/material.php?sifraKursa=".$row['sifraKursa']; ?> "class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">
					        <?php echo $row['godinaSlusanja']." godina - Predmet: "; ?>  <strong> <?php echo $row['naziv']; ?> </strong>
				        </a> <?php

                        $counter++;
                        

                    }
                }
            
            
            
            ?>
				<!--<a href="material.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">
					VIII semestar - <strong>Softverski inzenjering 2</strong>
				</a>-->
		</div>
		<!-- ubaciti u petlju da izlistava iz baze predmete i izbrisati div ispod koji sluzi za izgled -->
		<!--<div class="kurs">
				<a href="material.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">
					VIII semestar - <strong>Softverski inzenjering 2</strong>
				</a>
		</div>-->
    </div>


	<!--ako u ovom gore divu imas malo sadrzaja  te ti footer ovako visi, samo ubaci ovo include footer u div sa klasom fixed-bottom-->
    <div class="fixed-bottom">
        <?php include("../footer.php")?>
    </div>
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

</body>
</html>