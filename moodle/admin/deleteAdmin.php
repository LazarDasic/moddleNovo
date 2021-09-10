<?php
    
    include "connection.php";

    if(isset($_POST['deleteAdminBtn'])) {

        $idA = $_POST['idA'];
        $query = "DELETE FROM administrator WHERE idAdmina = $idA";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci obrisani"); 
                window.location="../admin/admini.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu obrisani"); 
                window.location="../admin/admini.php";
            </script>
        <?php
        }
    }
    
?>