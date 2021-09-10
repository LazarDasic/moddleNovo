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

        $image = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        $target = "../assets/".basename($image);

        $extension = pathinfo($image, PATHINFO_EXTENSION);

        if(!in_array($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
            ?>
                <script> 
                    window.alert("Format nije odgovarajuci"); 
                    window.location="../student/FotografijaStudentEdit.php"; 
                </script>
            
            <?php 
        }

        else if($_FILES['img']['size'] > 52428800) {
            ?>
                <script> 
                    window.alert("Slika je prevelika"); 
                    window.location="../student/FotografijaStudentEdit.php"; 
                </script>
            
            <?php  
        }

        else {

            if(move_uploaded_file($tmp, $target)) {

                $query = "UPDATE student SET fotografija='$image' WHERE idStudenta = '$id'";

                $result = mysqli_query($conn, $query);

                if($result) { ?>
                    <script> 
                        window.alert("Fotografija sacuvana"); 
                        window.location="../student/FotografijaStudentEdit.php";
                    </script>;
                <?php
                }

                else {  ?>
                    <script> 
                        window.alert("Fotografija nije sacuvana"); 
                        window.location="../student/FotografijaStudentEdit.php";
                    </script>
                <?php
                } 
            }      
        }
    }
?>