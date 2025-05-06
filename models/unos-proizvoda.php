<?php 
    header("Content-type: application/json");
    include "../config/connection.php";
    include "functions.php";
    if(isset($_POST['dugmeProizvod'])){
        try {
            $naziv = $_POST['naziv'];
            $cena = $_POST['cena'];
            $staraCena = $_POST['staraCena'];
            $sifra = $_POST['sifra'];
            $brend = $_POST['idBrend'];
            $slika = $_POST['idSlika'];
            // echo $naziv . $cena . $staraCena . $sifra . $brend . $slika;
            $greske = 0;
            if($naziv == ''){
                $greske++;
            }
            $cenaRegex = "/^\d{1,7}\.{1}\d{2}$/";
            $sifraRegex = "/^[A-Z]{1}\d{1}$/";
            
            if(!preg_match($cenaRegex, $cena)){
                $greske++;
            }
          if($staraCena != ""){
                if(!preg_match($cenaRegex, $staraCena)){
                    $greske++;
                }
          }
            if(!preg_match($sifraRegex, $sifra)){
                $greske++;
            }

            if($brend == 0){
                $greske++;
            }
            if($slika == 0){
                $greske++;
            }

            if($greske == 0){
                $insert = insert_proizvod($naziv, $cena, $staraCena, $sifra, $brend, $slika);
                if($insert){
                    http_response_code(201);
                    $result = ['msg' => "Uspešno dodat proizvod."];
                    echo json_encode($result);
                }
            }
            
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
?>