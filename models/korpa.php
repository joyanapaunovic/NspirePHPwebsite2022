<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    // session_start();
    if(isset($_SESSION['korisnik'])){
        $korisnik = $_SESSION['korisnik'];
        // var_dump($korisnik);
       if($_SESSION['korisnik']->id_uloga == 2){
        if(isset($_POST['btnKorpa'])){
            $idProizvod = $_POST['idProizvod'];
            // echo $idProizvod;
            $greske = 0;
            // echo $id;
            if($_POST['velicine'] != NULL){
                $velicine = $_POST['velicine'];
            }
            else {
                $greske++;
            }
            $kolicina = $_POST['kolicina'];
            // echo $kolicina;
            if($kolicina == 0 && $kolicina < 0){
                $greske++;
            }
            $korisnik = $_SESSION['korisnik'];
            $idKorisnik = $korisnik->id_korisnik;
            
            $_SESSION['korpa'] = [$idProizvod, $velicine, $kolicina, $idKorisnik];
            // echo $velicina[1][0];
            // echo $velicina[1][1];
            var_dump($_SESSION['korpa']);
            // echo $_SESSION['korpa'][3];
            // echo $kolicina;
            // var_dump($velicinaId);
            // header("Location: ../index.php?page=korpa");
            // echo json_encode($_SESSION['korpa']);
        }
        else {
            header("Location: ../index.php?page=404");
        }
       }
    }
    else {
        header("Location: ../index.php?page=prijava");
    }
?>