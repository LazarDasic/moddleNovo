<?php 

    include "../admin/connection.php";

    if(isset($_POST['addQuestionBtn'])) {
            
        global $conn;

        $idT = $_POST['test_ID'];
        $tekst = $_POST['question'];
        $ans1 = $_POST['ans1'];
        $ans2 = $_POST['ans2'];
        $ans3 = $_POST['ans3'];
        $ans4 = $_POST['ans4'];
        $correct = $_POST['correctAnsws'];

        $sql = "SELECT COUNT(*) as cnt FROM pitanje";
        $res = mysqli_query($conn, $sql);

        $row = $res->fetch_assoc();

        $QuestionNumber = $row['cnt'] + 1;

        $courseID = $_POST['courseID'];

        $query = "INSERT INTO pitanje (`sifraKursa`, `idTesta`, `brojPitanja`, `tekstPitanja`, `poeni`, `tekstOdgovora1`, `tekstOdgovora2`, `tekstOdgovora3`, `tekstOdgovora4`, `tacan`) 
        VALUES ('$courseID', '$idT', '$QuestionNumber', '$tekst', 5, '$ans1', '$ans2', '$ans3', '$ans4', '$correct')";

        $result = mysqli_query($conn, $query);

        if($result) { ?>
            <script> 
                window.alert("Pitanje dodato");
                window.location="../nastavnik/Question.php";
            </script>
        <?php           
        }

        else { ?>
            <script> 
                window.alert("Pitanje nije dodato");
                window.location="../nastavnik/Question.php";
            </script>
        <?php
        } 
    }
        
?> 
                                