<?php

    include "../admin/connection.php";

    if(!empty($_GET['idPitanja'])) {

        global $conn;
        $idQ = $_GET['idPitanja'];

        $query = "DELETE FROM pitanje WHERE idPitanja = '$idQ'";

        $result = mysqli_query($conn, $query);

        if($result) {       
            mysqli_query($conn, "SET @num := 0");
            mysqli_query($conn, "UPDATE pitanje SET brojPitanja = @num := (@num + 1)");
            mysqli_query($conn, "ALTER TABLE pitanje AUTO_INCREMENT = 1");
            
            ?>
            <script>
                window.alert("Pitanje izbrisano");
                window.location="../nastavnik/Question.php";
            </script>
        <?php
        }

        else { ?>
            <script>
                window.alert("Pitanje nije izbrisano");
                window.location="../nastavnik/Question.php";
            </script>
        <?php
        }
    }
?>