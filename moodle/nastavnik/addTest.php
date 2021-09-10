<?php

    include "../admin/connection.php";

    if(isset($_POST['createTestBtn'])) {

        global $conn;

        $courseID = $_POST['cID'];
        $testeName = $_POST['testName'];

        $query = "INSERT INTO test (`sifraKursa`, `nazivTesta`, `brojPitanja`, `status`, `SviPoeni`) VALUES ('$courseID', '$testeName', 20, 'zatvoren', 100)";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script>
                window.alert("Test dodat");
                window.location="../nastavnik/material.php";
            </script>
        <?php
        }

        else { ?>
            <script>
                window.alert("Test nije dodat, Greska");
                window.location="../nastavnik/material.php";
            </script>
        <?php
        }
        
    }
?>