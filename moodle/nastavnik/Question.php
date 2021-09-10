<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj pitanje</title>
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

        <h2>Dodavanje pitanja za test: <span style="color:red"> <?php echo $_SESSION['nazivTesta']; ?> </span></h2> 

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <!-- broj pitanja ce zavisiti od broja do sada unetih pitanja za odredjeni test plus 1-->

                    <?php 

                        include "../admin/connection.php";

                        global $conn;

                        if(!empty($_GET['test_id'])) {
                            $_SESSION['test_id'] = $_GET['test_id'];
                        }
                        
                        $id = $_SESSION['test_id'];

                        $sql = "SELECT COUNT(*) AS num FROM pitanje WHERE idTesta = '$id'";

                        $result = mysqli_query($conn, $sql);

                        $row = $result->fetch_assoc();

                        $num = $row['num'];
                        
                    ?>
                    
                    <?php 

                        $count = "SELECT COUNT(*) AS cnt FROM pitanje WHERE idTesta = '$id'";
                        $res = mysqli_query($conn, $count);

                        $r = $res->fetch_assoc();

                        $cnt = $r['cnt'];

                        if($cnt < 20) { ?> 
                        <div class="card-header"><strong> Pitanje broj <?php echo $num + 1; ?> </strong></div>
                            <div class="card-body card-block">
                            
                                <!-- id odgovara id-ju testa za koga dodeljujemo pitanja -->
                                <form action="addQuestion.php" method="post">
                                    <div class="form-group">
                                        <label for="question" class="form-control-label">ID testa</label>
                                        <input type="hidden" name="test_ID" class="form-control" value="<?php echo $id ?>" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="question" class="form-control-label">Sifra kursa</label>
                                        <input type="hidden" name="courseID" class="form-control" value="<?php echo $_SESSION['kurs']; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="question" class="form-control-label">Tekst pitanja</label>
                                        <input type="text" name="question" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ans1" class="form-control-label">Ponuđeni odgovor 1</label>
                                        <input type="text" name="ans1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ans2" class="form-control-label">Ponuđeni odgovor 2</label>
                                        <input type="text" name="ans2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ans3" class="form-control-label">Ponuđeni odgovor 3</label>
                                        <input type="text" name="ans3" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ans4" class="form-control-label">Ponuđeni odgovor 4</label>
                                        <input type="text" name="ans4" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="correctAnsws" class="form-control-label">Tačni odgovori</label>
                                        <p class="font-italic" style="font-size:0.8em">(Redni broj ponuđenih odgovora, odvojeni zarezom)</p>
                                        <input type="text" name="correctAnsws" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="addQuestionBtn"> Dodaj </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
            </div>


            
        </div>
        <div class="row my-3 border-0">
                <div class="col-lg-12 border-0">
                    <div class="card border-0">
                        <div class="card body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID pitanja.</th>
                                    <th> Redni broj pitanja </th>
                                    <th>Pitanje</th>
                                    <th>Opcija 1</th>
                                    <th>Opcija 2</th>
                                    <th>Opcija 3</th>
                                    <th>Opcija 4</th>
                                    <th>Tačni odgovori</th>
                                    <th>Edit</th>
                                    <th>Obriši</th>
                                </tr>
                                </thead>
                                <!--ovde ide ucitavanje i prikazivanje svih pitanja za ovaj test do sad-->

                                <?php

                                    $sql = "SELECT * FROM pitanje WHERE idTesta = '$id'";

                                    $result = mysqli_query($conn, $sql);
                                    $numofRows = $result->num_rows;

                                    $counter = 0;

                                    if($numofRows > 0) {
                                        while($counter < $numofRows) {
                                            $row = $result->fetch_assoc(); ?>

                                            <tr>
                                                <td> <?php echo $row['idPitanja']; ?> </td>
                                                <td> <?php echo $row['brojPitanja']; ?> </td>
                                                <td> <?php echo $row['tekstPitanja']; ?> </td>
                                                <td> <?php echo $row['tekstOdgovora1']; ?> </td>
                                                <td> <?php echo $row['tekstOdgovora2']; ?> </td>
                                                <td> <?php echo $row['tekstOdgovora3']; ?> </td>
                                                <td> <?php echo $row['tekstOdgovora4']; ?> </td>
                                                <td> <?php echo $row['tacan']; ?> </td>
                                                <td><a href="<?php echo "../nastavnik/editQuestion.php?idTesta=".$_SESSION['test_id']."&idPitanja=".$row['idPitanja']; ?>" class="btn btn-success">Uredi</a></td>
                                                <td><a href="<?php echo "../nastavnik/deleteQuestion.php?idPitanja=".$row['idPitanja']; ?>" class="btn btn-danger">Obriši</a></td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                    }
                                ?>
                            </table>
                            </div>
                        </div>
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