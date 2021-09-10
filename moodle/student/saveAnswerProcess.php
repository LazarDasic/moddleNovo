<?php

    session_start();

    $questionno = $_GET['questionNumber'];
    $value = $_GET['checkboxvalue'];
    if(!isset($_SESSION['answer'][$questionno]))
    {
        $_SESSION['answer'][$questionno]=[];
    }
    //else if(!in_array($value,$_SESSION['answer'][$questionno])){
        array_push($_SESSION['answer'][$questionno],$value)
    //}

    // $value1 = $_GET['checkboxvalue'];
    // $value2 = $_GET['checkboxvalue'];
    // $value3 = $_GET['checkboxvalue'];
    // $value4 = $_GET['checkboxvalue'];
    // $_SESSION['answer'][$questionno] = $value1;
    // $_SESSION['answer2'][$questionno] = $value2;
    // $_SESSION['answer3'][$questionno] = $value3;
    // $_SESSION['answer4'][$questionno] = $value4;
    
?>