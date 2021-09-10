<?php

    session_start();
    include "../admin/connection.php";

    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }


    global $conn;
    $questionNumber = "";
    $question = "";
    $opt1 = "";
    $opt2 = "";
    $opt3 = "";
    $opt4 = "";
    $answer = "";
    $count = 0;
    $ans = "";
    $ans2 = "";
    $ans3 = "";
    $ans4 = "";

    $idT = $_SESSION['id'];

    $queno = $_GET['questionNumber'];

    if(isset($_SESSION['answer'][$queno])) {
        //$ans = $_SESSION['answer'][$queno];
        //$ans2 = $_SESSION['answer'][$queno];
        //$ans3 = $_SESSION['answer'][$queno];
        //$ans4 = $_SESSION['answer'][$queno];
    }
    if($idT !=1 ){
        $upit="SELECT MAX(brojPitanja) as mx from pitanje where idTesta<'$idT'";
        $result=mysqli_query($conn,$upit);
        $numOfRows = $result->num_rows;
        if($numOfRows>0){        
            $row = $result->fetch_assoc();
            $brojDodavanja=(int)$row['mx'];
            $_SESSION['offset']=$brojDodavanja;
            $queno=(int)$queno;
            $rezultatPitanja=$brojDodavanja+$queno;
        

        $query = "SELECT * FROM pitanje WHERE brojPitanja = '$rezultatPitanja' AND idTesta='$idT' and sifraKursa='".$_SESSION['sifraKursa']."'";
}

    }
    else{
        $_SESSION['offset']=0;
        $query = "SELECT * FROM pitanje WHERE brojPitanja = '$queno' AND idTesta='$idT' and sifraKursa='".$_SESSION['sifraKursa']."'";
    }
    

    $result = mysqli_query($conn, $query);

    $count = mysqli_num_rows($result);

    //if($count == 0) {
    //    echo "over";
    //}
    //else {
        
        while($row = mysqli_fetch_array($result)) {
            $questionNumber = $row['brojPitanja'];
            $question = $row['tekstPitanja'];
            $opt1 = $row['tekstOdgovora1'];
            $opt2 = $row['tekstOdgovora2'];
            $opt3 = $row['tekstOdgovora3'];
            $opt4 = $row['tekstOdgovora4'];
            $answer = $row['tacan'];
        }

        ?>

        <br>

        <table>
            <tr>
                <td style="font-weight: bold; font-size: 18px; padding-left: 5px" colspan="2">
                <?php if($idT==1){?>
                    <h5 class="mt-4" > <?php echo $questionNumber.". ".$question; ?> </h5>
                <?php } else { 
                    $questionNumber=(int)$questionNumber-$brojDodavanja?>
                    
                    <h5 class="mt-4" > <?php echo $questionNumber.". ".$question; ?> </h5>
                 <?php }?>   
                    <p class="font-italic" style="font-size:0.8em">
                    <?php 
                        if(preg_match_all('/[1-4]+/', $answer) > 1) {
                            echo "Vise tacnih odgovora!";
                        } 
                    ?> </p>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                <div class="custom-control custom-checkbox form-group">    
                    <!--za svaki input je potrebno uraditi i proveru da li je student vec odgovara na njega i ako jeste
                    postaviti property checked-->
                    <input type="checkbox" name="c1" id="c1" value="<?php echo 1; ?>" onclick="checkboxclick(this.value, <?php echo $questionNumber; ?> )"
                    <?php if($ans == 1) {
                            echo "checked";
                        }
                    ?>> 
                    <?php echo $opt1; ?>
                </div>
                </td>
            </tr>        
            
            <tr>
                <td>
                <div class="custom-control custom-checkbox form-group">
                    <input type="checkbox" name="c2" id="c2" value="<?php echo 2; ?>" onclick="checkboxclick(this.value, <?php echo $questionNumber ?> )"
                    <?php if($ans2 == 2) {
                            echo "checked";
                        }
                    ?>> 
                    <?php echo $opt2; ?>
                </div>
                </td> 
            </tr>
            
            <tr>    
                <td>
                <div class="custom-control custom-checkbox form-group">
                    <input type="checkbox" name="c3" id="c3" value="<?php echo 3; ?>" onclick="checkboxclick(this.value, <?php echo $questionNumber; ?> )"
                    <?php if($ans3 == 3) {
                            echo "checked";
                        }
                    ?>> 
                    <?php echo $opt3; ?>
                </div>
                </td> 
            </tr>           

            <tr>
                <td>
                <div class="custom-control custom-checkbox form-group">       
                    <input type="checkbox" name="c4" id="c4" value="<?php echo 4; ?>" onclick="checkboxclick(this.value, <?php echo $questionNumber; ?> )"
                    <?php if($ans4 == 4) {
                            echo "checked";
                        }
                    ?>> 
                    <?php echo $opt4; ?>
                </div>       
                </td>
            </tr>
        </table>

        <?php
    //}

?>

