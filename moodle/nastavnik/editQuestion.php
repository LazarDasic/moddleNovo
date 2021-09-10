<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit pitanje</title>
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

    <?php 

    if(!empty($_GET['nazivTesta'])) {
        $_SESSION['nazivTesta'] = $_GET['nazivTesta'];
    }
    ?>


    <div class="container my-5" id="materialContent">
    <h2>Uredi pitanje za test <span style="color:red"> <?php echo $_SESSION['nazivTesta']; ?> </span></h2>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <?php 
                    if(!empty($_GET['idTesta']) && !empty($_GET['idPitanja'])) {
                        $_SESSION['idTesta'] = $_GET['idTesta'];
                        $_SESSION['idPitanja'] = $_GET['idPitanja'];
                    }
                    ?>
                    <!-- broj pitanja ce zavisiti od broja do sada unetih pitanja za odredjeni test plus 1-->
                    <div class="card-header"><strong> Pitanje broj <?php echo $_SESSION['idPitanja']; ?> </strong></div>
                    <div class="card-body card-block">
                        <?php
                            $id = $_SESSION['idPitanja'];
                            $sql = "SELECT * FROM pitanje WHERE idPitanja = '$id'";
                            $res = mysqli_query($conn, $sql);

                            $row = $res->fetch_assoc();
                        ?>
                        <!-- id odgovara id-ju testa za koga dodeljujemo pitanja, vrednosti atributa value ce biti odgovarajuce 
                    vrednosti iz baze podataka -->
                        <form action="updateQuestion.php" method="post">
                            <div class="form-group">
                                <label for="question" class="form-control-label">ID pitanja</label>
                                <input type="hidden" name="questionID" class="form-control" value="<?php echo $row['idPitanja']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="question" class="form-control-label">Tekst pitanja</label>
                                <input type="text" name="question" class="form-control" value="<?php echo $row['tekstPitanja']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="odgovor1" class="form-control-label">Ponuđeni odgovor</label>
                                <input type="text" name="ans1" class="form-control" value="<?php echo $row['tekstOdgovora1']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="odgovor2" class="form-control-label">Ponuđeni odgovor</label>
                                <input type="text" name="ans2" class="form-control" value="<?php echo $row['tekstOdgovora2']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="odgovor3" class="form-control-label">Ponuđeni odgovor</label>
                                <input type="text" name="ans3" class="form-control" value="<?php echo $row['tekstOdgovora3']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="odgovor4" class="form-control-label">Ponuđeni odgovor</label>
                                <input type="text" name="ans4" class="form-control" value="<?php echo $row['tekstOdgovora4']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tacniOdgovori" class="form-control-label">Tačni odgovori</label>
                                <p class="font-italic" style="font-size:0.8em">(Redni broj ponuđenih odgovora, odvojeni zarezom)</p>
                                <input type="text" name="correctAnsws" class="form-control" value="<?php echo $row['tacan']; ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" name="updateQuestionBtn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </div>

<?php include("../footer.php")?>
   
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

 
</body>
</html>