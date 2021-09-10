<?php
    session_start();
    include "../admin/connection.php";

    global $conn;

    if(!empty($_GET['idTesta'])) {
        $id = $_GET['idTesta'];
    }
    $query = "UPDATE test SET status = 'zatvoren' WHERE idTesta = '$id'";

    $result = mysqli_query($conn, $query);

    if($result) { ?>
        <script> 
            window.alert("Test zatvoren");
            //window.location="../nastavnik/material.php?sifraKursa="+<?php echo $_SESSION['sifraKursa']?>;
        </script>
    <?php
    }

    else {  ?>
        <script> 
            window.alert("Test nije zatvoren");
            //window.location="../nastavnik/material.php?sifraKursa="+<?php echo $_SESSION['sifraKursa']?>;
        </script>
    <?php
    }
    header("location:../nastavnik/material.php?sifraKursa=".$_SESSION['sifraKursa'])

?>