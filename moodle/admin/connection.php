<?php 

    $servername = "localhost";
    $Username = "root";
    $Password = "";
    $db = "moodle";

    $conn = mysqli_connect($servername, $Username, $Password, $db);

    if(!$conn) {
        die("Connection failed".mysqli_connect_error());
    }
?>