<?php

    include "../admin/connection.php";
    
    if(isset($_POST['deleteCourseBtn'])) {
        
        global $conn;
        $id = $_POST['sifra'];
        $courseID = $_POST['sifraKursa'];

        $query = "DELETE FROM kurs WHERE sifraKursa = (SELECT sifraKursa FROM sifra WHERE idSifre='$id')";
        $query1 = "UPDATE sifra SET status='slobodna' WHERE idSifre='$id'";

        $result = mysqli_query($conn, $query);
        $result1 = mysqli_query($conn, $query1);

        if($result && $result1) { ?>
            <script> 
                window.alert("Podaci obrisani"); 
                window.location="../admin/kursevi.php";
            </script>
        <?php
        }
    
        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu obrisani"); 
                window.location="../admin/kursevi.php";
            </script>
        <?php     
        }
    }

?>