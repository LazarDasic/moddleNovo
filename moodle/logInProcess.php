<?php

    include "admin/connection.php";


    if(isset($_POST['logInBtn'])) {

        global $conn;
        $email = $_POST['emailLogIN'];
        $psw = $_POST['pswLogIN'];
        $_SESSION['loggedin'] = false;

        if(empty($email) || empty($psw)) { ?>
            <script> 
                    window.alert("Sva polja moraju biti popunjena");
                    window.location="login.php";
             </script>
        <?php
        }

        $query = "SELECT * FROM student WHERE emailStudenta = '$email' ";
        $query1 = "SELECT * FROM profesor WHERE emailProfesora = '$email' ";
        $query2 = "SELECT * FROM administrator WHERE emailAdmina = '$email' ";
        
        $result = mysqli_query($conn, $query);
        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);

        $numOfRows = $result->num_rows;
        $numOfRows1 = $result1->num_rows;
        $numOfRows2 = $result2->num_rows;

        if($numOfRows > 0) {

            $row = $result->fetch_assoc();
            if($row['sifraStudenta'] == $psw) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['tipKorisnika'] = "student";
                $_SESSION['idKorisnika'] = $row['idStudenta'];
                $_SESSION['emailKorisnika'] = $row['emailStudenta'];
                $_SESSION['sifraKorisnika'] = $row['sifraStudenta'];
                $_SESSION['fotografijaKorisnika'] = $row['fotografija'];
                $_SESSION['brojIndeksa'] = $row['brojIndeksa'];
                $_SESSION['godinaUpisa'] = $row['godinaUpisa'];
                $_SESSION['imeKorisnika'] = $row['imeStudenta'];
                $_SESSION['prezimeKorisnika'] = $row['prezimeStudenta'];
                $_SESSION['godina'] = $row['godina'];
                $_SESSION['smer'] = $row['smer'];
                $_SESSION['grad'] = $row['grad'];
                $_SESSION['drzava'] = $row['drzava'];

                ?>
                <script> window.location="student/kursevi.php"; </script>
                <?php
            }

            else { ?>
                <script>
                    window.alert("Pogresna lozinka ili email");
                    window.location="login.php";
                </script>
            <?php
            }

        }

        else if($numOfRows1 > 0) {
            
            $row = $result1->fetch_assoc();
            if($row['sifraProfesora'] == $psw) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['tipKorisnika'] = "profesor";
                $_SESSION['idKorisnika'] = $row['idProfesora'];
                $_SESSION['fotografijaKorisnika'] = $row['fotografija'];
                $_SESSION['emailKorisnika'] = $row['emailProfesora'];
                $_SESSION['sifraKorisnika'] = $row['sifraProfesora'];
                $_SESSION['imeKorisnika'] = $row['imeProfesora'];
                $_SESSION['prezimeKorisnika'] = $row['prezimeProfesora'];
                $_SESSION['grad'] = $row['grad'];
                $_SESSION['drzava'] = $row['drzava'];

                $q = "SELECT * FROM sifra INNER JOIN profesor ON sifra.idProfesora = profesor.idProfesora";
                
                $R = mysqli_query($conn, $q);
                
                $n = $R->num_rows;
                $i = 0;

                if($n > 0) {
                    while($i < $n) {
                        $r = $R->fetch_assoc();

                        

                        $i++;
                    }

                }

                ?>
                <script> window.location="nastavnik/kursevi.php"; </script>
                <?php
             
            }

            else { ?>
                <script>
                    window.alert("Pogresna lozinka ili email");
                    window.location="login.php";
                </script>
            <?php
            }

        }

        else if($numOfRows2 > 0) {

            $row = $result2->fetch_assoc();
            if($row['sifraAdmina'] == $psw) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['tipKorisnika'] = "admin";
                $_SESSION['idKorisnika'] = $row['idAdmina'];
                $_SESSION['emailKorisnika'] = $row['emailAdmina'];
                $_SESSION['sifraKorisnika'] = $row['sifraAdmina'];
                $_SESSION['imeKorisnika'] = $row['imeAdmina'];
                $_SESSION['prezimeKorisnika'] = $row['prezimeAdmina'];

                ?>
                <script> window.location="admin/nastavnici.php"; </script>
                <?php
            }

            else { ?>
                <script>
                    window.alert("Pogresna lozinka ili email");
                    window.location="login.php";
                </script>
            <?php
            }

        }

        else { ?>
            <script>
                window.alert("Korisnik ne postoji");
                window.location="login.php";
            </script>;
        <?php
        }

    }

?>