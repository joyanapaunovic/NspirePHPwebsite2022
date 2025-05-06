<?php 
     try {
         if(isset($_SESSION['korpa'])){
                 $korpa = $_SESSION['korpa'];
                 // var_dump($korpa);
             if(isset($_SESSION['korisnik'])){
                 $korisnik = $_SESSION['korisnik'];
                 // var_dump($korisnik);
                 $idKorisnik = $korisnik->id_korisnik;
                 // echo $idKorisnik;
                 $kolicina = $korpa[2];
                 // echo "-".$kolicina;
                 $velicina = $korpa[1];
                 $idProizvod = $korpa[0];
                 // echo $idProizvod;
                 $proizvod = executeOneRow("SELECT * FROM proizvod WHERE id_proizvod = $idProizvod");
                 // var_dump($proizvod);
                 $cena = cenaSaDostavom($proizvod->cena, $kolicina);
                 // echo $cena;
                 foreach($velicina as $v){
                     // echo $v;
                     $insertKorpa = insert_korpa($idKorisnik, $kolicina, $v, $idProizvod, $cena);
                 }
                 if($insertKorpa){
                     http_response_code(201);
                     header("Location:../index.php?page=korisnik");
                 }
                 
             }
         }
         
     }
     catch(PDOException $ex){
         echo $ex->getMessage();
     }
?>