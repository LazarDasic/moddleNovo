<?php

    include "connection.php";

    if(isset($_POST['addCourseIDBtn'])) {

        global $conn;

        $courseID = $_POST['addCourseID'];

        $query = "INSERT INTO sifra (`sifraKursa`, `status`) VALUES ('$courseID', 'slobodna')";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci sacuvani"); 
                window.location="../admin/sifre.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu sacuvani"); 
                window.location="../admin/sifre.php";
            </script>
        <?php
        }
    }

?>