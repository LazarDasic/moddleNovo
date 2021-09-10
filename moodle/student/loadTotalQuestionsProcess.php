<?php

    session_start();
    include "../admin/connection.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    global $conn;
    $totalQuestionNumber = 0;

    $idT = $_SESSION['id'];

    $sql = "SELECT COUNT(*) as cnt FROM pitanje WHERE idTesta = '$idT'";
    $tmpResult = mysqli_query($conn, $sql);

    $r = $tmpResult->fetch_assoc();

    $count = $r['cnt'];

    if($count >= 20) {
        $query = "SELECT * FROM pitanje WHERE idtesta = '$idT' ORDER BY brojPitanja LIMIT 20";

    }

    else {
        $query = "SELECT * FROM pitanje WHERE idTesta = '$idT' LIMIT $count";
    }

    $result = mysqli_query($conn, $query);

    $totalQuestionNumber = mysqli_num_rows($result);

    echo $totalQuestionNumber;

?>
