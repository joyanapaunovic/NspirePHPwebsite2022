<?php 
    header("Content-type: application/json");
    include "../config/connection.php";
    include "functions.php";
    if(isset($_POST['dugmeIzmeni'])){
        try {
            $naziv = $_POST['naziv'];
            $cena = $_POST['cena'];
            $staraCena = $_POST['staraCena'];
            $sifra = $_POST['sifra'];
            $brend = $_POST['idBrend'];
            $kategorija = $_POST['idKategorija'];
            $podkategorija = $_POST['idPodkategorija'];
            $id = $_POST['idProizvod'];
        
           
        
                $update = update_proizvod($naziv, $cena, $staraCena, $sifra, $brend, $id);
                $update_podkategorija_kategorija = update_pk($kategorija, $podkategorija, $id);
                if($update){
                    if($update_podkategorija_kategorija){
                        $result = ["msg" => "Uspešno ste izmenili proizvod."];
                        echo json_encode($result);
                        http_response_code(200);
                    }
                }
                // else {
                //     echo "nije";
                // }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
?>