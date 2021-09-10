<?php

    include "../admin/connection.php";

    global $conn;

    if(!empty($_GET['idTesta'])) {
        $id = $_GET['idTesta'];
    }
    $query = "DELETE FROM test WHERE idTesta = '$id'";

    $result = mysqli_query($conn, $query);

    if($result) { ?>
        <script> 
            window.alert("Test obrisan");
            window.location="../nastavnik/material.php";
        </script>
    <?php
    }

    else {  ?>
        <script> 
            window.alert("Test nije obrisan");
            window.location="../nastavnik/material.php";
        </script>
    <?php
    }
?>