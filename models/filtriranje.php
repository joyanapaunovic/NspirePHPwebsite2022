<?php 
    header("Content-type: application/json");
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['idKategorija'])){
        $idKategorija = $_POST['idKategorija'];
        // echo $idKategorija;
        // brendovi
        if(isset($_POST['brendovi'])){
            try {
                $brendovi = $_POST['brendovi'];
                // var_dump($brendovi);
                $selektovaniBrendovi = select_where_in("p.id_brend", $brendovi, $idKategorija);
                // $implode = implode(", ", $brendovi);
                // var_dump($implode);
                if($selektovaniBrendovi){
                    echo json_encode($selektovaniBrendovi);
                    http_response_code(200);
                }
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
                http_response_code(500);
            }
        }
        elseif(isset($_POST['podkategorije'])){
            $podkategorije = $_POST['podkategorije'];
            $selektovanePodkategorije = select_where_in("kp.id_podkategorija", $podkategorije, $idKategorija);
            if($selektovanePodkategorije){
                echo json_encode($selektovanePodkategorije);
                http_response_code(200);
            }
        }
        // elseif(isset($_POST['podkategorije']) && isset($_POST['brendovi'])){
        //     $podkategorije = $_POST['podkategorije'];
        //     $brendovi = $_POST['brendovi'];
        //     $selektovano = selekcija_podkategorije_i_brendovi($idKategorija, $brendovi, $podkategorije);
        //     if($selektovano){
        //         echo json_encode($selektovano);
        //         http_response_code(200);
        //     }
        //     else {
        //         echo "ne";
        //     }
        // }
        else {
            $default = executeQuery("SELECT * FROM proizvod p INNER JOIN kategorija_podkategorija kp 
            ON kp.id_proizvod = p.id_proizvod
            INNER JOIN kategorija k ON k.id_kategorija = kp.id_kategorija
            INNER JOIN brend b ON b.id_brend = p.id_brend
            INNER JOIN slika s ON s.id_slika = p.id_slika
            WHERE k.id_kategorija = $idKategorija");
            echo json_encode($default);
            http_response_code(200);
        }
    }
?>