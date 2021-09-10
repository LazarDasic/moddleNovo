<?php

    session_start();
    include "../admin/connection.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    if(isset($_POST['submitBtn'])) {

        global $conn;
        $id = $_SESSION['idKorisnika'];

        $password = $_POST['password'];
        $country = $_POST['drzava'];
        $city = $_POST['grad'];


        $query = "UPDATE profesor SET sifraProfesora='$password', grad='$city', drzava='$country' WHERE idProfesora = '$id'";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Podaci sacuvani"); 
                window.location="../nastavnik/informacije.php";
            </script>;
        <?php
        }

        else {  ?>
            <script> 
                window.alert("Podaci nisu sacuvani"); 
                window.location="../nastavnik/informacijeEdit.php";
            </script>
        <?php
        } 
    }      
?>