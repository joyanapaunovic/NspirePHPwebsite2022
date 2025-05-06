<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['sort']) && isset($_POST['idKategorija'])){
       try {
            $sortVrednost = $_POST['sort'];
            $idKategorija = $_POST['idKategorija'];
            // echo $sortVrednost;
            // echo $idKategorija;
            if($sortVrednost == "asc"){
                $sortAsc = executeQuery("SELECT * FROM proizvod p INNER JOIN kategorija_podkategorija kp 
                                        ON kp.id_proizvod = p.id_proizvod
                                        INNER JOIN kategorija k ON k.id_kategorija = kp.id_kategorija
                                        INNER JOIN brend b ON b.id_brend = p.id_brend
                                        INNER JOIN slika s ON s.id_slika = p.id_slika
                                        WHERE k.id_kategorija = $idKategorija
                                        ORDER BY p.cena ASC
                ");
                echo json_encode($sortAsc);
                http_response_code(200);
            }
            elseif($sortVrednost == "desc") {
                $sortDesc = executeQuery("SELECT * FROM proizvod p INNER JOIN 
                kategorija_podkategorija kp ON kp.id_proizvod = p.id_proizvod
                INNER JOIN kategorija k ON k.id_kategorija = kp.id_kategorija
                INNER JOIN brend b ON b.id_brend = p.id_brend
                INNER JOIN slika s ON s.id_slika = p.id_slika
                WHERE k.id_kategorija = $idKategorija
                ORDER BY p.cena DESC
                ");
                echo json_encode($sortDesc);
                http_response_code(200);
            }
            elseif($sortVrednost == '0'){
                $sortDefault = executeQuery("SELECT * FROM proizvod p INNER JOIN 
                kategorija_podkategorija kp ON kp.id_proizvod = p.id_proizvod
                INNER JOIN kategorija k ON k.id_kategorija = kp.id_kategorija
                INNER JOIN brend b ON b.id_brend = p.id_brend
                INNER JOIN slika s ON s.id_slika = p.id_slika
                WHERE k.id_kategorija = $idKategorija
                ");
                echo json_encode($sortDefault);
                http_response_code(200);
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