<?php
    
    include "connection.php";

    if(isset($_POST['deleteStudent'])) {

        $id = $_POST['id'];
        $query = "DELETE FROM student WHERE idStudenta = $id";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci obrisani"); 
                window.location="../admin/studenti.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu obrisani"); 
                window.location="../admin/studenti.php";
            </script>
        <?php
        }
    }
    
?>