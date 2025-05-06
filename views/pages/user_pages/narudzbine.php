<?php if(isset($_SESSION['korpa'])): ?>
<div class="col-lg-9">
<h5 class='naslov mt-2'>Mojе narudžbine</h5>
  <table class="table table-striped table-responsive-xl mt-5">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Proizvod</th>
        <th scope="col">Veličina</th>
        <th scope="col">Količina</th>
        <th scope='col'>Cena</th>
        <th scope="col">Troškovi dostave</th>
        <th scope="col">Cena sa dostavom</th>
        <th scope="col">Datum naručivanja</th>
        <th scope="col">Datum isporuke</th>
      </tr>
    </thead><tbody>
    <?php
      $narudzbine = executeQuery("SELECT * FROM korpa k INNER JOIN proizvod p
      ON p.id_proizvod = k.id_proizvod INNER JOIN korisnik ko ON ko.id_korisnik = k.id_korisnik
      INNER JOIN velicina v ON v.id_velicina = k.id_velicina
      INNER JOIN slika s ON s.id_slika = p.id_slika
      WHERE ko.id_korisnik =". $_SESSION['korisnik']->id_korisnik);
      // var_dump($narudzbine);
      $brojac = 0;
      
      foreach($narudzbine as $n):
  ?>
      <tr>
        <th scope="row"><?=++$brojac?></th>
        <td>
          <div class="slikaKorpa2">
            <p class='naziv2'><?=$n->naziv?> <?=$n->sifra?></p>
            <img src='assets/images/<?=$n->manja_slika?>'/>
          </div>
        </td>
        <td>
            <?=$n->naziv_velicina?>
        </td>
        <td><?=$n->kolicina?></td>
        <td class='no-wrap '><?=$n->cena?> din.</td>
        <td class='no-wrap  text-center'>330 din.</td>
        <td class='no-wrap  text-center'><?=$n->cena_porudzbine?> din.</td>
        <td class='no-wrap'><?=date("d/m/Y ➤ H:i:s", strtotime($n->datum_porudzbine))?></td>
        <td class='no-wrap'><?=date("d/m/Y ➤ H:i:s", strtotime("+4 days"))?></td>
      </tr>
      <?php endforeach; 
    elseif(!isset($_SESSION['korpa'])): echo "<p class='naslov mt-5'>Posetom ili kupovinom na Internet prodavnici Nspire prihvatate naše Uslove kupovine. Dostava naručenih proizvoda iz narudžbenice se obavlja po evidentiranju vaše uplate.</p>";
    endif;?>
  </table>
  </div>

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
                    //  header("Location:../index.php?page=korisnik");
                 }
                 
             }
         }
     }
     catch(PDOException $ex){
         echo $ex->getMessage();
     }
?>