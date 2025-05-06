<?php 
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['idPodkategorija'])){
        try {
            $podkategorija = $_POST['idPodkategorija'];
            // echo $podkategorija;
            $upit = executeQuery("SELECT * FROM velicina 
                                WHERE id_podkategorija = $podkategorija");
            if($upit){
                http_response_code(200);
                echo json_encode($upit);
            }
            if($podkategorija == 0){
                $upit = executeQuery("SELECT * FROM velicina");
                echo json_encode($upit);
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
    else {
        header("Location: ../index.php?page=404");
    }
?>