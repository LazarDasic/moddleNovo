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
    <title>Sifre</title>
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
  <h2 class="display-4">Sifre</h2>
  <p class="lead  mb-2">Prikaz svih slobodnih sifri</p> 

  <input type="text" id="pretraga" placeholder="Pretraži..." class="form-control">
  <div class="row pt-3">
    <div class="col-lg-12">
    <div class="table-responsive text-center">
        <table class="table table-bordered table-md table-dark">
            <thead class="thead-dark">
            <tr>
                <th> ID </th>
                <th> Šifra kursa </th>
                <th> Status sifre </th>
                <th> ID predmetnog <br> profesora </th>
                <th> Promeni sifru</th> 
                <th> Obriši sifru</th> 
            </tr>
            </thead>
            <!--ovde ide ucitavanje i prikazivanje svih pitanja za ovaj test do sad-->
            <tbody id="tabelaPodataka">
              <?php

                global $conn;

                $query = "SELECT * FROM sifra";

                $result = mysqli_query($conn, $query);

                $numberOfRows = $result->num_rows;
                $counter = 0;

                if($numberOfRows > 0) {
                  while($counter < $numberOfRows) {
                    $row= $result->fetch_assoc(); ?>

                    <tr>
                      <td> <?php echo $row['idSifre']; ?> </td>
                      <td> <?php echo $row['sifraKursa']; ?> </td>
                      <td> <?php echo $row['status']; ?> </td>
                      <td> <?php echo $row['idProfesora']; ?> </td>
                      <td><button type=button class="btn btn-success editBtn">Uredi</button></td>
                      <td><button type=button class="btn btn-danger obrisiBtn">Obriši</button></td>
                    </tr> <?php

                    $counter++;
                  }
                }
              ?>
           
            </tbody>
        </table>
        </div>
       
        <div class="text-center mt-3">
        <button  data-toggle="modal" data-target="#addModal" type="button" class="btn btn-dark bg-blue rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-plus mr-2"></i><small class="text-uppercase font-weight-bold">Dodaj sifru</small></button>

        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj sifru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="addForma" method="post" action="insertCourseID.php">
                <div class="form-group">
                  <label for="sifra"> Šifra kursa </label>
                  <input type="text" class="form-control" id="sifra" placeholder="Unesite šifru" name="addCourseID">
                </div>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                <button type="submit" form="addForma" class="btn btn-primary" name="addCourseIDBtn">Dodaj</button>
              </div>
              </div>
          </div>
        </div>

       

        <!-- Edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Uredi informacije o sifri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="editForma" method="post" action="editCourseID.php">
              <div class="form-group">
                  <label for="updateID"> id Sifre </label>
                  <input type="hidden" class="form-control" id="updateID" name="editID">
              </div>
              <div class="form-group">
                  <label for="updateSifra"> Šifra kursa</label>
                  <input type="text" class="form-control" id="updateSifra" name="editIDcourse">
              </div>
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                <button type="submit" form="editForma" class="btn btn-primary" name="changeCourseIDBtn">Promeni</button>
              </div>
            </div>
          </div>
        </div>



        <!-- Delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brisanje sifre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form id="deleteForma" method="post" action="deleteCourseID.php">
                
              <input type="text" name="idC" id="deleteSifraID">
              <p>Da li želite da obrišete ovu sifru?</p>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
                <button type="submit" form="deleteForma" class="btn btn-danger" name="deleteCourseIDBtn">Obriši</button>
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
          
          
          
          $('#updateID').val(data[0]);
          $('#updateSifra').val(data[1]);
          /*$('#updateSmerSifre').val(data[3]);
          $('#updateStatus').val(data[1]);
          $('#updateSifraTest').val(data[2]);
          $('#updateImeTest').val(data[3]);
          $('#updateImeStudent').val(data[4]);
          $('#updateRezultat').val(data[5]);*/

        });

        $('.obrisiBtn').on('click',function(){
          $('#deleteModal').modal('show');

          $tr=$(this).closest('tr');

          var data=$tr.children("td").map(function(){
            return $(this).text();
          }).get();
          /*var studentInfo=data[4].split(" ");
          console.log(studentInfo[0]);*/
          
          $('#deleteSifraID').val(data[0]);
        }); 
        
    </script>
</body>
</html>