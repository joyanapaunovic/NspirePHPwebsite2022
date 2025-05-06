<div class="my-5 py-5 container">
   <div class="row">
       <div class="col-12 d-flex flex-wrap mt-5 pt-5">
       <h3 class='fs-font-weight text-center'>PREGLED KORPE</h3>    
       <table class="table table-responsive-xl">
  <tbody>
      <?php 
            // session_start();
            if(isset($_SESSION['korpa'])){
                $korpa = $_SESSION['korpa'];
                // var_dump($korpa);
                // echo $korpa[0];
                $idProizvod = $korpa[0];
                $velicine = $korpa[1];
                // var_dump($velicine);
                $implode = implode(',',$velicine);
                // var_dump($implode);
                $kolicina = $korpa[2];
                // echo $kolicina;
                $proizvod = executeOneRow('SELECT * FROM proizvod p INNER JOIN slika s ON s.id_slika = p.id_slika
                                          WHERE p.id_proizvod ='. $idProizvod);
                // var_dump($proizvod);
                $velicine = executeQuery("SELECT * FROM velicina WHERE id_velicina IN (".$implode.')');
                // var_dump($velicine);
                if(isset($_SESSION['korisnik'])){
                    $korisnik = $_SESSION['korisnik'];
                }
            }            
      ?>
    <tr>
      <th scope="row">
          <div class="slikaKorpa mt-3">
            <img src='assets/images/<?=$proizvod->manja_slika?>' alt='<?=$proizvod->naziv?>' />
          </div>
      </th>
      <td>
          <h3 class='naziv'>
            <?=$proizvod->naziv?> <?=$proizvod->sifra?>
          </h3>
          <p class='mt-3 d-flex flex-row korpa-naslov'>Izabrane veličine: <div class='d-flex'>
          <?php foreach($velicine as $v): ?>
          <?=$v->naziv_velicina?> 
          <?php endforeach; ?>
          </div></p>
          <p class='mt-3 korpa-naslov'>
              Količina: 
          </p><?=$kolicina?>
          <p class='mt-3 korpa-naslov'>Vaša adresa:</p><?=$korisnik->ulica?>
          <p class='mt-3 korpa-naslov'>Cena:</p><?=$proizvod->cena?> din.
          <p class='mt-3 korpa-naslov'>Dostava:</p>330 din.
          <p class='mt-3 korpa-naslov'>Cena sa dostavom:</p><?= cenaSaDostavom($proizvod->cena, $kolicina) ?> din.
      </td>
      <td>
            <a href="index.php?page=korisnik&userPage=narudzbine" class='links-admin-panel mt-4 d-flex flex-row align-items-center justify-content-center' id='potvrdi'>POTVRDI NARUDŽBINU</a>
      </td>
      <td>
        <a href="models/unset-korpa.php" class='links-admin-panel mt-4 d-flex flex-row align-items-center justify-content-center'>UKLONI</a>
      </td>
    </tr>
  </tbody>
</table>
       </div>
   </div>
</div>
