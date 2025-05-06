<?php 
    //session_start();
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['dugmePrijava'])){
        try {
            $email = $_POST['emailPrijava'];
            $lozinka = $_POST['lozinkaPrijava'];
            // echo $email . " " . $lozinka;
            $greske = 0;
            // REGEX
            $regexEmail = "/^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/";
            $regexLozinka = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/";

            // email
            if(!preg_match($regexEmail, $email)){
                $greske++;
            }
            // lozinka
            if(!preg_match($regexLozinka, $lozinka)){
                $greske++;
            }  
            $sifrovanaLozinka = md5($lozinka);
            // echo $sifrovanaLozinka;
            if($greske == 0){
                $provera = provera_korisnika($email, $sifrovanaLozinka);
                if($provera){
                    // echo "postoji";
                    $_SESSION['korisnik'] = $provera;
                    // echo $korisnik->ime . " " . $korisnik->prezime . " " . $korisnik->telefon . $korisnik->naziv_uloga;
                    // echo $_SESSION['korisnik']->naziv_uloga;
                    $result = ['msg' => "Uspešno ste se ulogovali."];
                    echo json_encode($result);
                    http_response_code(200);
                }
                else {
                    // echo "nije prosao upit";
                    $result = ['msg' => "Pogrešan email ili lozinka. Molimo pokušajte ponovo."];
                    echo json_encode($result);
                }
            } 
            else {
                // echo "Greske na serverskoj strani!";
                http_response_code(422);
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            http_response_code(500);
        }
    }
    else {
        header("Location: ../index.php?page=prijava");
    }
?>