<?php
    
    include "connection.php";

    if(isset($_POST['deleteCourseIDBtn'])) {

        global $conn;

        $idC = $_POST['idC'];
        $query = "DELETE FROM sifra WHERE idSifre = $idC";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci obrisani"); 
                window.location="../admin/sifre.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu obrisani"); 
                window.location="../admin/sifre.php";
            </script>
        <?php
        }

    }
    
?>