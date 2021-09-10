<?php

  session_start();
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
    <title>Prikaz kurseva nastavnika</title>
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

		  h2{
		    text-align: center;
		  }
		  .kurs{
			  padding-bottom: 10px;
		  }
    </style>
</head>
<body style="background-image: linear-gradient(#7ea7e0, white) ;">
      <?php 

        include "../navbar.php";
      ?>
      
    <div class="container my-5" id="addNewCourse">

      <a href="noviKurs.php"> Kreiraj kurs </a>
    </div>
    <div class="container my-5" id="materialContent">
		<h2 class="pb-4"> <strong>Moji kursevi</strong></h2>
		<hr>
		<div class="kurs">

        <?php 
        
          include "../admin/connection.php";
          
          global $conn;

          $email = $_SESSION['emailKorisnika'];


          $query = "SELECT * FROM kurs INNER JOIN sifra ON kurs.sifraKursa = sifra.sifraKursa INNER JOIN profesor ON profesor.idProfesora = sifra.idProfesora
          WHERE profesor.emailProfesora = '$email' "; 
          $result = mysqli_query($conn, $query);
          $numberOfrows = $result->num_rows;

          $counter = 0;

          if($numberOfrows > 0) {
            while($counter < $numberOfrows) {
              $row = $result->fetch_assoc();
              $_SESSION['sifraKursa']=$row['sifraKursa'];
              ?>
              
              <a href="<?php echo "../nastavnik/material.php?sifraKursa=".$row['sifraKursa']; ?>" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">
					       <strong> <?php echo $row['naziv']; ?> </strong>
				      </a> <?php

              $counter++;
            }
          }
        
        ?>
		</div>
		<!-- ubaciti u petlju da izlistava iz baze predmete i izbrisati div ispod koji sluzi za izgled -->
	
    </div>
	<div class="fixed-bottom">
		<?php include("../footer.php")?>
	</div>
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

</body>
</html>