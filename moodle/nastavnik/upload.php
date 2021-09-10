<?php

    session_start();
    include "../admin/connection.php";

    if(isset($_POST['submitBtn'])) {

        global $conn;
        $id = $_SESSION['sifraKursa'];
        $week = $_POST['week'];

        $filename = $_FILES['file']['name'];
        $destination = '../assets/'.$filename;

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $file = $_FILES['file']['tmp_name'];
        $size = $_FILES['file']['size'];

        if(!in_array($extension, ['zip', '7z', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'pdf', 'mp3', 'mp4', 'avi', 'rar', 'jpg', 'jpeg', 'png'])) {
            ?>
                <script> window.alert("Format nije odgovarajuci!"); </script>
            <?php
        }

        else if($_FILES['file']['size'] > 52428800) {
            ?>
                <script> window.alert("Fajl je preveliki!"); </script>
            <?php
        }

        else {
            if(move_uploaded_file($file, $destination)) {
                $query = "INSERT INTO fajl (`nazivFajla`, `size`, `sifraKursa`, `idSekcije`, `tipFajla`) VALUES ('$filename', '$size', '$id', '$week', '$extension')";

                $result = mysqli_query($conn, $query);

                if($result) { ?>
                    <script> 
                        window.alert("Fajl je dodat!");
                        window.location="../nastavnik/material.php"; 
                    </script>
                <?php
                }

                else { ?>
                    <script> 
                        window.alert("Fajl nije dodat"); 
                        window.location="../nastavnik/material.php";
                    </script>
                <?php
                }
            }
        } 
    }

?>