<?php

    include "connection.php";

    if(isset($_POST['addAdminBtn'])) {

        global $conn;
        $name = $_POST['addAdminName'];
        $lastname = $_POST['addAdminLastName'];
        $email = $_POST['addAdminEmail'];
        $password = $_POST['addAdminPsw'];

        $query = "INSERT INTO administrator (`emailAdmina`, `sifraAdmina`, `imeAdmina`, `prezimeAdmina`) VALUES ('$email', '$password', '$name', '$lastname')";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci sacuvani"); 
                window.location="../admin/admini.php";
            </script>
        <?php
        }

        else { ?>
            <script> 
                window.alert("Greska! Podaci nisu sacuvani"); 
                window.location="../admin/admini.php";
            </script>
        <?php
        }

    }

?>