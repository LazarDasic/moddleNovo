<?php

    session_start();
    include "../admin/connection.php";

    global $conn;
    $idT = $_SESSION['id'];
    $sum = $_SESSION['points'];
    $testname = $_SESSION['nazivTesta'];
    $email = $_SESSION['emailKorisnika'];
    $id = $_SESSION['idKorisnika'];

    $query = "SELECT * FROM test WHERE idTesta = '$idT' AND test.nazivTesta = '$testname'";

    $result = mysqli_query($conn, $query);

    $row = $result->fetch_assoc();

    $courseID = $row['sifraKursa'];


    $sql = "INSERT INTO radio (`idStudenta`, `idTesta`, `sifraKursa`, `bodovi`, `emailStudenta`)
    VALUES ('$id', '$idT', '$courseID', '$sum', '$email')";

    $res = mysqli_query($conn, $sql);

    if($res) { ?>
        <script> 
            window.location="../nastavnik/material.php"; 
        </script>
    <?php
    }

?>