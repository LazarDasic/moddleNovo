<?php

    include "../admin/connection.php";

    if(isset($_POST['changeBtn'])) {

        global $conn;
        $id = $_POST['idSifre'];
        $courseID = $_POST['courseID'];
        $courseName = $_POST['courseName'];
        $module = $_POST['courseModule'];
        $year = $_POST['year'];
        $profesor = $_POST['profesor'];

        $sql = "UPDATE kurs INNER JOIN sifra ON kurs.sifraKursa = sifra.sifraKursa SET kurs.naziv = '$courseName', kurs.smer='$module', kurs.godinaSlusanja='$year' WHERE sifra.idSifre = '$id'";
        $sql1 = "UPDATE sifra SET idProfesora = '$profesor', sifraKursa='$courseID' WHERE idSifre='$id'";

        $result = mysqli_query($conn, $sql);
        $result1 = mysqli_query($conn, $sql1);

        if($result) { ?>
            <script> 
                window.alert("Podaci azurirani"); 
                window.location="../admin/kursevi.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu azurirani"); 
                window.location="../admin/kursevi.php";
            </script>
        <?php
        }
    }

?>