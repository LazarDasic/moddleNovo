<?php

    include "connection.php";

    if(isset($_POST['addProfesor'])) {

        global $conn;
        $name = $_POST['addProfName'];
        $lastname = $_POST['addProfLastName'];
        $email = $_POST['addProfEmail'];
        $password = $_POST['addProfPsw'];
        $city = $_POST['addProfCity'];
        $country = $_POST['addProfCountry'];


        $query = "INSERT INTO profesor (`emailProfesora`, `sifraProfesora`, `imeProfesora`, `prezimeProfesora`, `grad`, `drzava`) 
        VALUES ('$email', '$password', '$name', '$lastname', '$city', '$country')";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci sacuvani"); 
                window.location="../admin/nastavnici.php";
            </script>;
        <?php
        }

        else {  ?>
            <script> 
                window.alert("Podaci nisu sacuvani"); 
                window.location="../admin/nastavnici.php";
            </script>
        <?php
 
        }
    }           

?>
