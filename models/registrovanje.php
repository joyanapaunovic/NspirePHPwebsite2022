<?php 
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['dugmeRegistracija'])){
        try {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $telefon = $_POST['telefon'];
            $ulica = $_POST['ulica'];
            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            // echo $ime . " " . $prezime . " " . $telefon . " " . $ulica . " " . $email . " " . $lozinka;
            $sifrovanaLozinka = md5($lozinka);
            // echo $sifrovanaLozinka;

            /* REGEX */
            $regexIme = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/";
            $regexPrezime = "/^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,14})\s?([A-Z][a-z]{2,19})?$/"; // mogucnost dva prezimena
            $regexEmail = "/^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/";
            $regexLozinka = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/";
            $regexUlica = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]+(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s\d+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?$/";
            $regexTelefon = "/^(\+381)(\s)?6(([0-9]){8,9})$/";

            $greske = 0;
            // ime
            if(!preg_match($regexIme, $ime)){
                $greske++;
            }
            // prezime
            if(!preg_match($regexPrezime, $prezime)){
                $greske++;
            }
            // telefon
            if(!preg_match($regexTelefon, $telefon)){
                $greske++;
            }
            // ulica
            if(!preg_match($regexUlica, $ulica)){
                $greske++;
            }
            // email
            if(!preg_match($regexEmail, $email)){
                $greske++;
            }
            // lozinka
            if(!preg_match($regexLozinka, $lozinka)){
                $greske++;
            }   
            // ako nema gresaka         
            if($greske == 0){
                $upis_novog_korisnika = dodavanje_korisnika($ime, $prezime, $telefon, $ulica, $email, $sifrovanaLozinka, 2);
                if($upis_novog_korisnika){
                    // echo "uspesno registrovan";
                    http_response_code(201);
                    $poruka = ['msg' => "Uspešno ste se registrovali."];
                    echo json_encode($poruka);
                }
            }
            else {
                http_response_code(422);
                echo "Greska pri serverskoj validaciji.";
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            http_response_code(500);
        }
    }
    else {
        header("Location: ../index.php?page=registracija");
    }
?>