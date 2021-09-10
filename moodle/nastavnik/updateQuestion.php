<?php

    include "../admin/connection.php";

    if(isset($_POST['updateQuestionBtn'])) {

        global $conn;

        $idQ = $_POST['questionID'];
        $text = $_POST['question'];
        $ans1 = $_POST['ans1'];
        $ans2 = $_POST['ans2'];
        $ans3 = $_POST['ans3'];
        $ans4 = $_POST['ans4'];
        $correct = $_POST['correctAnsws'];

        $query = "UPDATE pitanje SET tekstPitanja='$text', tekstOdgovora1='$ans1', tekstOdgovora2='$ans2', tekstOdgovora3='$ans3', tekstOdgovora4='$ans4', tacan='$correct'
        WHERE idPitanja = '$idQ' ";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script>
                window.alert("Pitanje azurirano");
                window.location="../nastavnik/Question.php";
            </script>
        <?php
        }

        else {  ?>
            <script>
                window.alert("Pitanje nije azurirano");
                window.location="../nastavnik/Question.php";
            </script>
        <?php
        }
    }
?>
