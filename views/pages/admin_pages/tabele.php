 <!-- TABELE..\ -->
            <!-- proizvodi -->
            
                <table class="table table-striped table-hover table-responsive-xl">
                <h6 class='ml-2 mt-4 mb-2 nazivTabele'>PROIZVODI</h6>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv proizvoda</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Stara cena</th>
                        <th scope="col">Šifra</th>
                        <th scope="col">Kategorija</th>
                        <th scope="col">Podkategorija</th>
                        <th scope="col">Slika proizvoda</th>
                        <th scope='col'></th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $brojac = 0;
                        $proizvodi = executeQuery("SELECT * FROM
                        proizvod p INNER JOIN kategorija_podkategorija kp ON p.id_proizvod = kp.id_proizvod
                        INNER JOIN kategorija k ON k.id_kategorija = kp.id_kategorija
                        INNER JOIN podkategorija po ON po.id_podkategorija = kp.id_podkategorija
                        INNER JOIN brend b ON b.id_brend = p.id_brend
                        INNER JOIN slika s ON s.id_slika = p.id_slika");
                        // var_dump($proizvodi);
                        foreach($proizvodi as $proizvod):
                    ?>
                    <tr>
                    <th scope="row"><?=++$brojac?></th>
                        <td><?=$proizvod->naziv?></td>
                        <td><?=$proizvod->cena?></td>
                        <?php if($proizvod->stara_cena != NULL): ?>
                        <td class='text-center'><?=$proizvod->stara_cena?></td>
                        <?php else: ?>
                        <td class='text-center'><i class="fa-solid fa-xmark"></i></td>
                        <?php endif; ?>
                        <td class='text-center'><?=$proizvod->sifra?></td>
                        <td class='text-center'><?=$proizvod->naziv_kategorija?></td>
                        <td class='text-center'><?=$proizvod->naziv_podkategorija?></td>
                        <td>
                            <div class="slikaProizvoda">
                                <img class='img-fluid' src="assets/images/<?=$proizvod->manja_slika?>" alt="<?=$proizvod->naziv?>"/>
                            </div>
                        </td>
                        <td>
                            <a href="models/brisanje-proizvoda.php?id=<?=$proizvod->id_proizvod?>" class='links-admin-panel mt-4'>Obriši</a>
                        </td>
                        <td>
                            <a href="index.php?page=admin-panel&adminPage=izmena-proizvoda&id=<?=$proizvod->id_proizvod?>" class='links-admin-panel mt-4'>Izmeni</a>
                        </td>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <!-- ../proizvodi -->
                <div class="container-fluid d-flex flex-wrap align-items-center flex-row justify-content-between">
                <!-- brendovi -->
                <div class="brendovi flex-column">
                <h6 class='ml-2 mt-4 mb-2 nazivTabele d-flex flex-column'>BRENDOVI</h6>
                <table class="table table-striped">
                    
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naziv brenda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $brend = executeQuery("SELECT * FROM brend");
                                foreach($brend as $b):
                            ?>
                            <tr>
                                <td><?=$b->id_brend?></td>
                                <td><?=$b->naziv_brend?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table></div>
                <!-- ../brendovi -->
                <!-- kategorije -->
                <div class="kategorije flex-column">
                    <h6 class='ml-2 mt-4 mb-2 nazivTabele d-flex flex-column'>KATEGORIJE</h6>
                    <table class="table table-striped">
                           <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naziv kategorije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $kategorija = select_all("kategorija");
                                foreach($kategorija as $k):
                            ?>
                            <tr>
                                <td><?=$k->id_kategorija?></td>
                                <td><?=$k->naziv_kategorija?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table></div>
                <!-- ../kategorije -->
                <!-- podkategorije -->
                <div class="podkategorije flex-column">
                <h6 class='ml-2 mt-4 mb-2 nazivTabele d-flex flex-column'>PODKATEGORIJE</h6>
                <table class="table table-striped">
                    
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naziv podkategorije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $podkategorija = select_all("podkategorija");
                                foreach($podkategorija as $pk):
                            ?>
                            <tr>
                                <td><?=$pk->id_podkategorija?></td>
                                <td><?=$pk->naziv_podkategorija?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table></div>
              
                </div>
                <!-- ../podkategorije -->
                <!-- prikaz korisnika -->
                    <table class="table table-striped table-hover table-responsive">
                    <h6 class='ml-2 mt-4 mb-2 nazivTabele'>KORISNICI</h6>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ime</th>
                                <th scope="col">Prezime</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Lozinka</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Ulica</th>
                                <th scope='col'>Datum registrovanja</th>
                                <th scope='col'>Uloga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $korisnici = executeQuery("SELECT * FROM korisnik k
                                                           INNER JOIN uloga u 
                                                           WHERE k.id_uloga = u.id_uloga");
                                // var_dump($korisnici);
                                $i = 0;
                                foreach($korisnici as $k):
                            ?>
                            <tr>
                                <td><?=++$i?></td>
                                <td><?=$k->ime?></td>
                                <td><?=$k->prezime?></td>
                                <td><?=$k->email?></td>
                                <td><?=$k->lozinka?></td>
                                <td>
                                    <div class="avatar">
                                        <img src="assets/images/default-avatar.jpg" alt="avatar" />
                                    </div>
                                </td>
                                <td><?=$k->telefon?></td>
                                <td><?=$k->ulica?></td>
                                <td><?=date("Y/m/d H:i:s", strtotime($k->datum))?></td>
                                <td><?=$k->naziv_uloga?></td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <!-- ../prikaz korisnika -->
                <!-- ../TABELE -->