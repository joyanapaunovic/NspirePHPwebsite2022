<?php
    session_start();
    pristup_stranici();
    define("SERVER", env("SERVER"));
    define("DATABASE", env("DATABASE"));
    define("USERNAME", env("USERNAME"));
    define("PASSWORD", env("PASSWORD"));

    define("__DIR__", $_SERVER["DOCUMENT_ROOT"]."/nspire");
    function env($marker){
        $niz = file(__DIR__ . "/.env");
        $trazenaVrednost = "";
    
        foreach($niz as $red){
            $red = trim($red);
    
            list($identifikator, $vrednost) = explode("=", $red);
    
            if($identifikator == $marker){
                $trazenaVrednost = $vrednost;
                break;
            }
        }
        return $trazenaVrednost;
    }

    function pristup_stranici(){
        if(isset($_SESSION['korisnik'])){
            $korisnik = $_SESSION['korisnik'];
            // var_dump($korisnik);
            if($korisnik->naziv_uloga == 'korisnik'){
            $fajl = fopen("../data/log-fajl.txt", 'a');
            if($fajl) {
                    $datum = date("Y-m-d H:i:s");
                    $sadrzaj = $korisnik->id_korisnik . "__" . $korisnik->ime . "__" . $korisnik->prezime . "__". $_SERVER['REQUEST_URI'] . "__" . $_SERVER['REMOTE_ADDR'] ."__". $datum . "\n";

                    fwrite($fajl, $sadrzaj);
                    fclose($fajl);
                }
           }
        }
    }
?>