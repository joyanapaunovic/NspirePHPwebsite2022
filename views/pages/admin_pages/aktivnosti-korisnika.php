<table class="table table-striped">
    <h5 class="naslov mt-3 mb-2">Aktivnosti korisnika</h5>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ime</th>
      <th scope="col">Prezime</th>
      <th scope="col">Stranica</th>
      <th scope="col">IP adresa</th>
      <th scope="col">Datum i vreme pristupa stranici</th>
    </tr>
  </thead>
  <tbody>
      <?php $logFajl = file("data/log-fajl.txt");
            // var_dump($logFajl);
            //$implode = implode("__", $logFajl);
            // var_dump($implode);
            foreach($logFajl as $aktivnost):
                list($idKorisnika, $ime, $prezime, $stranica, $ipAdresa, $datum) = explode("__", $aktivnost);
                
      ?>
    <tr>
      <th scope="row"><?=$idKorisnika?></th>
      <td><?=$ime?></td>
      <td><?=$prezime?></td>
      <td><?=$stranica?></td>
      <td><?=$ipAdresa?></td>
      <td><?=$datum?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
