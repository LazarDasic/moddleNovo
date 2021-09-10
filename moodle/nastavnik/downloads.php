<?php

    include "../admin/connection.php";

    if(isset($_GET['file_id'])) {

        global $conn;
        $id = $_GET['file_id'];

        $sql = "SELECT * FROM fajl WHERE idFajla='$id'";
        $result = mysqli_query($conn, $sql);

        $row = $result->fetch_assoc();

        $filePath = "../assets/".$row['nazivFajla'];

        if(file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filePath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize("../assets/" . $row['nazivFajla']));
            readfile("../assets/" . $row['nazivFajla']);

            exit;
        }
    }

?>