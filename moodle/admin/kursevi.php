<?php include "connection.php"; ?>

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
    <title>Kursevi</title>
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">

    <!-- Bootstrap cdn -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--CSS sheet -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"></script>

    
</head>
<body style="min-height: 100vh; overflow-x: hidden;">

    <!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">


  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0 pt-4">Admin panel</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="./nastavnici.php" class="nav-link text-dark bg-light">
      </i><i class="fas fa-chalkboard-teacher mr-3 text-primary fa-fw"></i>
                Nastavnici
            </a>
    </li>
    <li class="nav-item">
      <a href="./studenti.php" class="nav-link text-dark">
      <i class="fas fa-user-graduate mr-3 text-primary fa-fw"></i>
                Studenti
            </a>
    </li>
    <li class="nav-item">
      <a href="./kursevi.php" class="nav-link text-dark">
      <i class="fas fa-book mr-3 text-primary fa-fw"></i>
                Kursevi
            </a>
    </li>
    <li class="nav-item">
      <a href="./sifre.php" class="nav-link text-dark">
      <i class="fas fa-scroll mr-3 text-primary fa-fw"></i>
                Lista slobodnih sifara
            </a>
    </li>
    <li class="nav-item">
      <a href="./admini.php" class="nav-link text-dark">
      <i class="fas fa-tools mr-3 text-primary fa-fw"></i>
                Admini
            </a>
    </li>
    <li class="nav-item">
      <a href="../logout.php" class="nav-link text-dark">
      <i class="fas fa-sign-out-alt mr-3 text-primary fa-fw"></i>
                Odjavite se 
            </a>
    </li>
  </ul>

  
</div>
<!-- End vertical navbar -->


<!-- Page content holder -->
<div class="page-content p-5" id="content">
  <!-- Toggle button -->
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Panel</small></button>

  <!-- Demo content -->
  <h2 class="display-4">Kursevi</h2>
  <p class="lead  mb-2">Prikaz kurseva na fakultetu</p> 

  <input type="text" id="pretraga" placeholder="Pretraži..." class="form-control">
  <div class="row pt-3">
    <div class="col-lg-12">
    <div class="table-responsive text-center">
        <table class="table table-bordered table-md table-dark">
            <thead class="thead-dark">
            <tr>
                <th>ID sifre </th>
                <th>Šifra kursa </th>
                <th>Naziv kursa</th>
                <th>Smer </th>
                <th>Godina studija</th>
                <th>ID predmetnog nastavnika</th>
                <th>Predmetni nastavnik</th>
                <th>Uredi informacije o kursu</th> 
                <th>Uredi materijale kursa</th> 
                <th>Obriši</th> 
            </tr>
            </thead>
            <!--ovde ide ucitavanje i prikazivanje svih pitanja za ovaj test do sad-->
            <tbody id="tabelaPodataka">
              
              <?php

                global $conn;

                $query = "SELECT * FROM kurs INNER JOIN sifra ON kurs.sifraKursa = sifra.sifraKursa INNER JOIN profesor ON sifra.idProfesora = profesor.idProfesora";
                //$query1 = "SELECT * FROM sifra";

                $result = mysqli_query($conn, $query);
                //$result1 = mysqli_query($conn, $query1);
                //$result1 = mysqli_query($conn, $query1);

                $numberOfrows = $result->num_rows;
                //$numberOfrows1 = $result1->num_rows;

                $counter = 0;

                if($numberOfrows > 0) {
                  while($counter < $numberOfrows) {
      
                    $row = $result->fetch_assoc();
                   // $row1 = $result1->fetch_assoc(); 
                    //$row1 = $result1->fetch_assoc(); ?>
      
                    <tr>
                      <td> <?php echo $row['idSifre']; ?> </td>
                      <td> <?php echo $row['sifraKursa']; ?> </td>
                      <td> <?php echo $row['naziv']; ?> </td>
                      <td> <?php echo $row['smer']; ?> </td>
                      <td> <?php echo $row['godinaSlusanja']; ?> </td>
                      <td> <?php echo $row['idProfesora']; ?> </td>
                      <td> <?php echo $row['imeProfesora']." ".$row['prezimeProfesora']; ?> </td>
                      <td><button type="button" class="btn btn-success editBtn">Uredi kurs</button></td>
                      <!--<td><button type="button" class="btn btn-warning editMaterialBtn">Uredi materijal</button></td>-->
                      <td><a href="<?php echo "../nastavnik/material.php?sifraKursa=".$row['sifraKursa'];?> " class="btn btn-defaut btn-warning"> Uredi Materijal </a> </td>
                      <td><button type="button" class="btn btn-danger obrisiBtn">Obriši</button></td>
        
                    </tr> <?php
      
                    $counter++;
                  }
                }
              ?>

            </tbody>
        </table>
        </div>   

        <!-- Edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Uredi informacije o kursu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="editForma" method="post" action="editCourse.php">
              <div class="form-group">
                <label for="updateIDSifre"> ID </label>
                <input type="hidden" class="form-control" id="updateIDSifre" name = "idSifre" value="<?php echo $row['idSifre']; ?>">
              </div> 
              <div class="form-group">
                  <label for="updateSifra"> Šifra kursa </label>
                  <input type="text" class="form-control" id="updateSifra" name="courseID">
                </div>
              <div class="form-group mt-2">                
                  <label for="updateIme">Promeni naziv kursa</label>
                  <input type="text" class="form-control" id="updateIme" placeholder="Unesite naziv kursa" name="courseName">
              </div>
              <div class="form-group mt-2">                
                  <label for="updateSmer">Promeni smer kursa</label>
                  <input type="text" class="form-control" id="updateSmer" placeholder="Unesite smer kursa" name="courseModule">
              </div>
              <div class="form-group">
                  <label for="updateGodina">Promeni godinu slušanja kursa</label>
                  <input type="text" class="form-control" id="updateGodina" placeholder="Unesite godinu slušanja kursa" name="year">
              </div>
              <div class="form-group">
                    <label for="updateProfesor">Nastavnik koji predaje kurs</label>
                    <select class='form-control' id='updateProfesor' name="profesor">
                        <?php 

                          global $conn;
                          $sql = "SELECT * FROM profesor";

                          $result = mysqli_query($conn, $sql);

                          $numOfRows = $result->num_rows;
                          $counter = 0;

                          if($numOfRows > 0) {
                            while($counter < $numOfRows) {

                              $row = $result->fetch_assoc(); ?>

                              <option> <?php echo $row['idProfesora']; ?> </option>

                              <?php

                              echo $string;
                              $counter++;
                            }
                          }

                        ?>
                        
                    </select>
                </div>
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                <button type="submit" form="editForma" class="btn btn-primary" name="changeBtn">Promeni</button> 

              </div>
            </div>
          </div>
        </div>



        <!-- Delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brisanje kursa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="deleteForma" method="post" action="deleteCourse.php">
              <p>Da li želite da obrišete ovaj kurs i sav materijal?</p>
              
              <div class="form-group">
                <label for="deleteID"> ID </label>
                <input type="text" name="sifra" id="deleteID">
              </div>

              <div class="form-group">
                <label for="deleteCourse"> SifraKursa </label>           
                <input type="text" name="sifraKursa" id="deleteCourse">
              </div>

              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
                <button type="submit" form="deleteForma" class="btn btn-danger" name="deleteCourseBtn">Obriši</button>
              </div>
            </div>
          </div>
        </div>


    </div>
  </div>

</div>
<!-- End demo content -->    
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>


    <script>
        $(function() { 
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
            });
        });

        $('#pretraga').on('keyup',function(){
          var vrednost=$(this).val().toLowerCase();
          console.log(vrednost);
          $("#tabelaPodataka tr").filter(function(){
             $(this).toggle($(this).text().toLowerCase().indexOf(vrednost)>-1);
           })
        });

        $('.editBtn').on('click',function(){
          $('#editModal').modal('show');

          $tr=$(this).closest('tr');

          var data=$tr.children("td").map(function(){
            return $(this).text();
          }).get();
          
          
          $('#updateIDSifre').val(data[0]);
          $('#updateSifra').val(data[1]);
          $('#updateIme').val(data[2]);
          $('#updateSmer').val(data[3]);
          $('#updateGodina').val(data[4]);
          //$('#updateProfesor').val(data[3]);

        });

        $('.obrisiBtn').on('click',function(){
          $('#deleteModal').modal('show');

          $tr=$(this).closest('tr');

          var data=$tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data[0]);
          
          $('#deleteID').val(data[0]);
          $('#deleteCourse').val(data[1]);
          

        });

        /*$('.editMaterialBtn').on('click',function(){

          $tr=$(this).closest('tr');

          var data=$tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data[1]);
          
          document.location.href="../nastavnik/material.php?sifraKursa="+data[1];
          
        });*/
        
    </script>

</body>
</html>