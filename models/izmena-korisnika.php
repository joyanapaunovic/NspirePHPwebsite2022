<?php 
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['btnIzmenaKorisnik'])){
       try {
             // echo "klik";
        $idKorisnik = $_POST['idKorisnik'];
        // echo $idKorisnik;
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $telefon = $_POST['telefon'];
        $ulica = $_POST['ulica'];
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        // echo $ime . $prezime . $telefon . $ulica . $email . $lozinka;
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
        if($lozinka != ""){
            if(!preg_match($regexLozinka, $lozinka)){
                $greske++;
            }   
        }
        if($greske == 0){
            $sifrovanaLozinka = '';
            $edit = '';
            if($lozinka != ''){
                $sifrovanaLozinka = md5($lozinka);
                $edit = izmena_korisnika($ime, $prezime, $telefon, $ulica, $email, $sifrovanaLozinka, $idKorisnik);
            }
            else {
                $edit = izmena_korisnika($ime, $prezime, $telefon, $ulica, $email, $lozinka, $idKorisnik);
            }
            if($edit){
                $result = ['msg' => "Uspešno ste izmenili Vaše podatke."];
                echo json_encode($result);
            }
        }
    }
       catch(PDOException $ex){
           echo $ex->getMessage();
           http_response_code(500);
       }
        
    }
    else {
        header("Location: ../index.php?page=404");
    }
?>