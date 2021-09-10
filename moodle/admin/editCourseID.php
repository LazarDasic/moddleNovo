<?php
    
    include "connection.php";

    if(isset($_POST['changeCourseIDBtn'])) {

        global $conn;

        $id = $_POST['editID'];
        $CourseID = $_POST['editIDcourse'];

        $query = "UPDATE sifra SET sifraKursa='$CourseID' WHERE idSifre = $id";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci azurirani"); 
                window.location="../admin/sifre.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu azurirani"); 
                window.location="../admin/sifre.php";
            </script>
        <?php
        }
    }

?>