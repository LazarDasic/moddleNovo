<?php

    include "../admin/connection.php";

    if(isset($_POST['addStudentToCourseBtn'])) {

        global $conn;
        $email = mysqli_real_escape_string($conn, ($_POST['studentEmail']));

        $sql = "SELECT * FROM student WHERE emailStudenta = '$email'";

        $result = mysqli_query($conn, $sql);

        $num = $result->num_rows;

        $row = $result->fetch_assoc();
        $counter = 0;

        if($num > 0) {
            while($counter < $num) {
                    
                $idS = $row['idStudenta'];
                $courseID = $_POST['courseID'];

                $query = "INSERT INTO prati (`idStudenta`, `sifraKursa`) VALUES ('$idS', '$courseID')";

                $res = mysqli_query($conn, $query);

                if($res) {  ?>
                    <script> 
                        window.alert("Student je ubacen na kurs");
                        window.location="../nastavnik/material.php";
                    </script>
                <?php
                }
            
                else {  ?>
                    <script> 
                        window.alert("Student nije ubacen na kurs");
                        window.location="../nastavnik/material.php";
                    </script>
                <?php
                    
                }
            }
        }

        else {  ?>
            <script> 
                window.alert("Student sa unetim email-om ne postoji");
                window.location="../nastavnik/material.php";
            </script>
        <?php
        }
    }

?>