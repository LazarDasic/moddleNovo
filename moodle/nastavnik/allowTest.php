<?php
        session_start();

    include "../admin/connection.php";


    global $conn;

    if(!empty($_GET['idTesta'])) {
        $id = $_GET['idTesta'];
    }

    $sql = "SELECT COUNT(*) AS cnt FROM pitanje WHERE idTesta = '$id'";
    $res = mysqli_query($conn, $sql);

    $r = $res->fetch_assoc();

    $count = $r['cnt'];

    if($count < 20) { ?>
        <script>
            window.alert("Test mora imati 20 pitanja kako bi mogao biti odobren");
            //window.location="../nastavnik/material.php";
        </script>
    <?php
    }
    else {
        $query = "UPDATE test SET status = 'odobren' WHERE idTesta = '$id'";
    }

    $result = mysqli_query($conn, $query);

    if($result) { ?>
        <script> 
            window.alert("Test odobren");
           // window.location="../nastavnik/material.php?sifraKursa="+<?php echo $_SESSION['sifraKursa']?>;
            console.log("../nastavnik/material.php?sifraKursa="+"<?php echo $_SESSION['sifraKursa']?>");
        </script>
    <?php
    }

    else {  ?>
        <script> 
            window.alert("Test nije odobren");
           // window.location="../nastavnik/material.php?sifraKursa="+<?php echo $_SESSION['sifraKursa']?>;
        </script>
    <?php

    }
    header("location:../nastavnik/material.php?sifraKursa=".$_SESSION['sifraKursa'])

?>

