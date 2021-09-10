<?php

    include "connection.php";

    if(isset($_POST['changeProfesorBtn'])) {

        global $conn;

        $idP = $_POST['idProfesora'];

        $email = $_POST['ProfesorEmail'];
        $psw = $_POST['ProfesorPsw'];
        $name = $_POST['ProfesorName'];
        $lastname = $_POST['ProfesorLastName'];
        $city = $_POST['ProfesorCity'];
        $country = $_POST['ProfesorCountry'];
        
        $query = "UPDATE profesor SET emailProfesora='$email', sifraProfesora='$psw', imeProfesora='$name', prezimeProfesora='$lastname', grad='$city', 
        drzava='$country' WHERE idProfesora='$idP' ";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                    window.alert("Podaci azurirani");
                    window.location = "../admin/nastavnici.php"; 
            </script>
        <?php
        }
        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu azurirani");
                window.location = "../admin/nastavnici.php";
             </script>
        <?php
        }

    }

?>