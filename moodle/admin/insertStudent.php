<?php

    include "connection.php";

    if(isset($_POST['addStudent'])) {

        global $conn;
        $name = $_POST['addStudentName'];
        $lastname = $_POST['addStudentLastName'];
        $email = $_POST['addStudentEmail'];
        $password = $_POST['addStudentPsw'];
        $indexNumber = $_POST['addIndexNumber'];
        $yearApplied = $_POST['addStudentYearApplied'];
        $currentYear = $_POST['addStudentYear'];
        $city = $_POST['addStudentCity'];
        $country = $_POST['addStudentCountry'];
        $module = $_POST['addStudentModule'];

                
        $query = "INSERT INTO student (`emailStudenta`, `sifraStudenta`, `brojIndeksa`, `godinaUpisa`, `imeStudenta`, `prezimeStudenta`, `godina`, `smer`, `grad`, `drzava`)
        VALUES ('$email', '$password', '$indexNumber', '$yearApplied', '$name', '$lastname', '$currentYear', '$module', '$city', '$country')";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci sacuvani"); 
                window.location="../admin/studenti.php";
            </script>
        <?php
        }

        else {  ?>
            <script> 
                window.alert("Podaci nisu sacuvani"); 
                window.location="../admin/studenti.php";
            </script>

        <?php  
        }
    }
    
?>