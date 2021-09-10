<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacije o nastavniku</title>
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
    </style>
</head>
<body style="background-image: linear-gradient(#7ea7e0, white) ;">
<?php session_start(); include("../navbar.php")?>
    <div class="container my-5" id="materialContent">
    <?php echo "<img src='../assets/".$_SESSION['fotografijaKorisnika']."' style='height:20%; width:20%; float:right; alt='Profila slika'>"?>
		<h2 class="pb-4"> <strong>Informacije o nastavniku</strong></h2>

        <?php  include "../logInProcess.php"; ?>

        
		<p><strong>Ime i prezime:</strong> <?php echo $_SESSION['imeKorisnika']." ".$_SESSION['prezimeKorisnika']; ?> </p>
		<p><strong>Email adresa:</strong> <?php echo $_SESSION['emailKorisnika']; ?> </p>
		<p><strong>Država:</strong> <?php echo $_SESSION['drzava']; ?> </p>
		<p><strong>Grad:</strong> <?php echo $_SESSION['grad']; ?> </p>
		<p><strong>Kursevi:</strong> <?php /*echo $_SESSION['sviKurseviProfesora'];*/ ?> </p>
		
        <a href="informacijeEdit.php" >Izmeni informacije</a>
        <br>
        <a href="FotografijaProfesorEdit.php"> Izmeni Fotografiju </a>
        </div>
    </div>
	<div class="fixed-bottom">
		<?php include("../footer.php")?>
	<div>
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

</body>
</html>