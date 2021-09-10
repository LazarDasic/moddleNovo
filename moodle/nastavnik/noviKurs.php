<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novi kurs</title>
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
<?php session_start(); include("../navbar.php"); 
	$email = $_SESSION['emailKorisnika'];
?>
    <div class="container my-5" id="materialContent">
		<h2 class="pb-4"> <strong>Kreiranje novog kursa</strong></h2>
		<form action="createCourse.php" method="post">
			<label for="smer"><strong>Izaberite smer:</strong></label></br>
			<fieldset id="smer">
				<input class="form-check-input" type="radio" name="rb" id="flexRadioDefault1" value="rtsi">
				<label class="form-check-label" for="smer"> Računarska tehnika i softversko inženjerstvo </label></br>
				<input class="form-check-input" type="radio" name="rb" id="flexRadioDefault2" value="mi">
				<label class="form-check-label" for="smer"> Mašinsko inženjerstvo </label></br>
				<input class="form-check-input" type="radio" name="rb" id="flexRadioDefault3" value="vi">
				<label class="form-check-label" for="smer"> Vojnoindustrijsko inženjerstvo </label></br>
				<input class="form-check-input" type="radio" name="rb" id="flexRadioDefault4" value="ai">
				<label class="form-check-label" for="smer"> Automobilsko inženjerstvo </label></br>
				<input class="form-check-input" type="radio" name="rb" id="flexRadioDefault5" value="ui">
				<label class="form-check-label" for="smer"> Urbano inženjerstvo </label></br>
			</fieldset>
			<hr>
			<label for="godina"><strong>Izaberite godinu:</strong></label></br>
			<fieldset id="godina">
				<input class="form-check-input" type="radio" name="rb2" id="flexRadio1" value="god1">
				<label class="form-check-label" for="flexRadioDefault2"> I </label></br>
				<input class="form-check-input" type="radio" name="rb2" id="flexRadio2" value="god2">
				<label class="form-check-label" for="flexRadioDefault2"> II </label></br>
				<input class="form-check-input" type="radio" name="rb2" id="flexRadio3" value="god3">
				<label class="form-check-label" for="flexRadioDefault2"> III </label></br>
				<input class="form-check-input" type="radio" name="rb2" id="flexRadio4" value="god4">
				<label class="form-check-label" for="flexRadioDefault2"> IV </label></br>
			</fieldset>
			<hr>
			<label for="naziv"><strong>Unesite naziv novog kursa:</strong></label>
			<input type="text" name="naziv"><br>
			<hr>
			<!--<button type="button" class="btn btn-primary" id="uzmiSifru" onclick="getFreeCourseID()">Preuzmi šifru</button>-->
			<!--<input type="text" id="sifra" readonly>-->

			<div class="form-group">
				<label for="getFreeCourseID"> "Izaberite slobodnu sifru kako bi ste kreirali kurs" </label>
				<select class='form-control' id="getFreeCourseID" name="id">

				<?php 

					include "../admin/connection.php";

					global $conn;

					$query = "SELECT * FROM sifra WHERE status = 'slobodna'";

					$result = mysqli_query($conn, $query);

					$numOfrows = $result->num_rows;

					$counter = 0;

					if($numOfrows > 0) {
						while($counter < $numOfrows) {
							$row = $result->fetch_assoc(); 

							$string = "<option>".$row['sifraKursa']."</option>";

							echo $string;
							$counter++;
						}
					}
				?>
			</select>
			<hr>
			<input type="reset" class="btn btn-danger" value="Očisti polja"> &emsp; <input type="submit" class="btn btn-success" value="Kreiraj kurs">
		</form>
    </div>
				</div>
    <!--ako u ovom gore divu imas malo sadrzaja  te ti footer ovako visi, samo ubaci ovo include footer u div sa klasom fixed-bottom-->
    <?php include("../footer.php"); ?>


	
	<!--<script>
        var dugme = document.getElementById("uzmiSifru");
        var input = document.getElementById("sifra");
  
        function sifra_Run() {
            input.value = "Ovde ubaciti sifru iz baze";		 Ovde izmeniti za sifru 
            input.innerHTML = 
                   "Value = " + "'" + input.value + "'";
        }
    </script>-->
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>
	
</body>
</html>