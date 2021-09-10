<?php
    session_start();
    include "../admin/connection.php";

    $emailStudenta = trim($_GET['emailStudenta'], " ");
    
    global $conn;

    $query = "SELECT * FROM radio INNER JOIN test on radio.idTesta = test.idTesta WHERE radio.emailStudenta = '$emailStudenta' and test.sifraKursa='".$_SESSION['sifraKursa']."'";

    $result = mysqli_query($conn, $query);

    $numberOfRows = $result->num_rows;

    $counter = 0;

    if($numberOfRows > 0) {
        while($counter < $numberOfRows) {
            $row = $result->fetch_assoc();

            echo $row['nazivTesta'].":  ".$row['bodovi']."/".$row['SviPoeni'];
            $counter++;
        }
    }
    
?>