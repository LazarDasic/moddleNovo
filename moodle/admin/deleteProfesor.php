<?php
    
    include "connection.php";

    if(isset($_POST['deleteProfesorBtn'])) {

        global $conn;
        $idP = $_POST['idP'];
        $query = "DELETE FROM profesor WHERE idProfesora = $idP";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci obrisani"); 
                window.location="../admin/nastavnici.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu obrisani"); 
                window.location="../admin/nastavnici.php";
            </script>
        <?php
        }
    }
    
?>