<?php

    include "../loginProcess.php";
    session_start();

    $email = $_SESSION['emailKorisnika'];

    global $conn;

    $sql = "SELECT * FROM profesor WHERE emailProfesora = '$email' ";

    $res = mysqli_query($conn, $sql);
    $r = $res->fetch_assoc();

    $idP = $r['idProfesora'];

    $n = $_POST['rb'];

    if($n == "rtsi") {
        $moduleName = "RTSI";
    }

    else if($n == "mi") {
        $moduleName = "MI";
    }

    else if($n == "vi") {
        $moduleName = "VI";
    }

    else if($n == "ai") {
        $moduleName = "AI";
    }

    else if($n == "ui") {
        $moduleName = "UI";
    }

    //hvatanje godine za kurs 

    $m = $_POST['rb2'];

    
    if($m == "god1") {
        $year = 1;
    }

    else if($m == "god2") {
        $year = 2;
    }

    else if($m == "god3") {
        $year = 3;
    }

    else if($m == "god4") {
        $year = 4;
    }

    $id = $_POST['id'];
    $courseName = $_POST['naziv'];


    $query = "INSERT INTO kurs (`sifraKursa`, `naziv`, `smer`, `godinaSlusanja`) VALUES ('$id', '$courseName', '$moduleName', '$year')";

    $query1 = "UPDATE sifra SET status = 'zauzeta', idProfesora = '$idP' WHERE sifraKursa = '$id' "; 

    $result = mysqli_query($conn, $query);
    $result1 = mysqli_query($conn, $query1);

    if($result && $result1) {
        header("Location: ../nastavnik/kursevi.php");
    }

?>