<?php 
    include "../config/connection.php";
    include "functions.php";
    if(isset($_GET['id'])){
        try{
            $idProizvoda = $_GET['id'];
            // echo $idProizvoda;
            $kategorijePodkategorije = brisanje_proizvoda($idProizvoda, "id_proizvod", "kategorija_podkategorija");
            $korpa = brisanje_proizvoda($idProizvoda, "id_proizvod", "korpa");
            $velicinaProizvod = brisanje_proizvoda($idProizvoda, "id_proizvod", "velicina_proizvod");
            $brisanje = brisanje_proizvoda($idProizvoda, "id_proizvod", "proizvod");
            if($brisanje){
                http_response_code(200);
                header("Location: ../index.php?page=admin-panel&adminPage=tabele");
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