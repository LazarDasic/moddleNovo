<?php 

    include "connection.php";

    if(isset($_POST['changeAdminBtn'])) {

        global $conn;

        $idA = $_POST['idA'];

        $email = $_POST['AdminEmail'];
        $psw = $_POST['AdminPsw'];
        $name = $_POST['AdminName'];
        $lastname = $_POST['AdminLastName'];
        
        $query = "UPDATE administrator SET emailAdmina='$email', sifraAdmina='$psw', imeAdmina='$name', prezimeAdmina='$lastname' WHERE idAdmina='$idA' ";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci azurirani"); 
                window.location="../admin/admini.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu azurirani"); 
                window.location="../admin/admini.php";
            </script>
        <?php
        }
    }


?>