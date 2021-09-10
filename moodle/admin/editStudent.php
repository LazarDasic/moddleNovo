<?php 

    include "connection.php";

    if(isset($_POST['changeStudentBtn'])) {

        global $conn;

        $id = $_POST['idStudenta'];

        $indexNumber = $_POST['IndexNumber'];
        $email = $_POST['StudentEmail'];
        $psw = $_POST['StudentPsw'];
        $name = $_POST['StudentName'];
        $lastname = $_POST['StudentLastName'];
        $module = $_POST['Module'];
        $currentYear = $_POST['CurrentYear'];
        $yearApplied = $_POST['YearApplied'];
        $city = $_POST['City'];
        $country = $_POST['Country'];
        
        $query = "UPDATE student SET emailStudenta='$email', sifraStudenta='$psw', brojIndeksa='$indexNumber', godinaUpisa='$yearApplied', 
        imeStudenta='$name', prezimeStudenta='$lastname', smer='$module', godina='$currentYear', grad='$city', drzava='$country' WHERE idStudenta='$id' ";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                    window.alert("Podaci azurirani");
                    window.location = "../admin/studenti.php"; 
            </script>
        <?php
        }
        else { ?>
            <script> 
                    window.alert("Greska! Podaci nisu azurirani");
                    window.location = "../admin/studenti.php"; 
            </script>
        <?php
        }
    }


?>