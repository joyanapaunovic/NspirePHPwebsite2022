<?php 
    include("../config/connection.php");
    include("functions.php");
    if(isset($_POST['dugme'])){
      try {
        $idProizvod = $_POST['idProizvod'];
        $idKategorija = $_POST['idKat'];
        $idPodkategorija = $_POST['idPodkat'];
        $velicine = $_POST['velicine'];
         //    var_dump($velicine);
         //    echo $idKategorija . $idProizvod . $idPodkategorija;
         $insert1 = insert_kategorija_podkategorija($idKategorija, $idPodkategorija, $idProizvod);
         foreach($velicine as $v){
             $insert2 = insert_velicina_proizvod($v, $idProizvod);
         }
         if($insert1 && $insert2){
             http_response_code(201);
             $result = ['msg' => "Uspešno!"];
             echo json_encode($result);
         }
         else {
             echo "neuspesan upit";
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