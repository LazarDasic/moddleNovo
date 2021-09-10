<?php

    session_start();
    include "../admin/connection.php";
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">

    <!-- Bootstrap cdn -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--CSS sheet -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        html{
            min-height:100%;
        }
    </style>
</head>

<body style="background-image: linear-gradient(#7ea7e0, white) ;">
<?php  include("../navbar.php")?>
    

    <?php

    include "../admin/connection.php";

    if(!empty($_GET['test_id']) && !empty($_GET['nazivTesta'])) {

        global $conn;

        $_SESSION['id'] = $_GET['test_id'];
        $_SESSION['nazivTesta'] = $_GET['nazivTesta'];
        
    }
 
    ?>

    <div class="container my-5" id="materialContent">
    <h2><span style="color:red"> <?php echo $_SESSION['nazivTesta']; ?> </span></h2>
        <div class="breadcome-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcome-list">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 text-right">
                                    <div class="breadcome-menu">
                                        <div id="countdowntimer" style="display: block; font-weight: bold;" > </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ovde ce ici redni broj pitanja/ukupno pitanja za dati test-->
        <div class="col-lg-2 col-lg-push-10">
            <div id="currentQuestionNumber" style="float:left; font-size: 20px; font-weight: bold"> 0 </div>
            <div style="float:left; font-size: 20px; font-weight: bold"> / </div>
            <div id="totalQuestionNumber" style="float:left; font-size: 20px; font-weight: bold"> 0 </div>
        </div>

        <div class="mt-3" id="loadQuestion">
            
        </div> 
    
        <div class="row mt-5 mb-3">
            <div class="text-left col-6">
                <button class="btn btn-info" style="float:left" id="previousBtn" value="previous" onclick="loadPrevious();">Prethodno pitanje</button>
            </div>
            <div class="text-right col-6">
                <button class="btn btn-info" style="float:right" id="nextBtn" value="next" onclick="loadNext();">Sledeće pitanje</button>
            </div>
            <br>
            <br>
            <br>
            <div class="text-right col-lg-push-1 col-12" style="float:right">
                <button class="btn btn-info" id="resBtn" value="result" onclick="loadResult();">Zavrsi test</button>
            </div>  
        </div>
    </div>

    <div class=" mt-2">
        <?php include("../footer.php")?>
    </div>
   
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   
   
</body>

<script type="text/javascript">

        document.getElementById("resBtn").style.visibility = "hidden";

        const COUNTER_KEY = 'my-counter';

        var timer2 = "1:30";
        $('.countdowntimer').html(timer2);
        var timer = timer2.split(':');

        $(document).ready(function() {
        var timer2 = localStorage.getItem('timer');
        if(timer2 === null) timer2 = "1:30";
        $('.countdowntimer').html(timer2);

        var interval = setInterval(function() {
            var timer = timer2.split(':');
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0){
                clearInterval(interval);
                localStorage.removeItem('timer');
                $('button').show();
            }else{
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                $('.countdowntimer').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
                localStorage.setItem('timer',timer2);
            }
            }, 1000);
        });

        function loadTotalQue() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("totalQuestionNumber").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "../student/loadTotalQuestionsProcess.php", true);
            xmlhttp.send(null);
        }

        var questionNumber = "1";
        loadQuestions(questionNumber);

        function loadQuestions(questionNumber) {
            document.getElementById("currentQuestionNumber").innerHTML = questionNumber;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if(xmlhttp.responseText == "over") {
                        window.location="../student/rezultat.php";
                    }
                    else {
                        document.getElementById("loadQuestion").innerHTML = xmlhttp.responseText;
                        loadTotalQue();
                    }
                }
            };
            xmlhttp.open("GET", "../student/loadQuestionsProcess.php?questionNumber="+questionNumber, true);
            xmlhttp.send(null);
        }


        function checkboxclick(checkboxvalue, questionNumber) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                }
            };
            xmlhttp.open("GET", "../student/saveAnswerProcess.php?questionNumber="+questionNumber+"&checkboxvalue="+checkboxvalue, true);
            xmlhttp.send(null);
            
        }

        function loadPrevious() {
            if(questionNumber == "1") {
                loadQuestions(questionNumber);
                document.getElementById("resBtn").style.visibility = "hidden";
                document.getElementById("nextBtn").style.visibility = "visible";
            }
            else {
                document.getElementById("resBtn").style.visibility = "hidden";
                document.getElementById("nextBtn").style.visibility = "visible";
                questionNumber = eval(questionNumber) - 1;
                loadQuestions(questionNumber);
            }
        }

        function loadNext() {

            if(questionNumber == "20") {
                document.getElementById("nextBtn").style.visibility = "hidden";
                document.getElementById("resBtn").style.visibility = "visible";
            }
            else {
                document.getElementById("resBtn").style.visibility = "hidden";
                document.getElementById("nextBtn").style.visibility = "visible";
                questionNumber = eval(questionNumber) + 1;
                loadQuestions(questionNumber);
            }
        }

        function loadResult() {
            window.location="../student/rezultatiNovo.php";
        }
        
    </script>

</html>