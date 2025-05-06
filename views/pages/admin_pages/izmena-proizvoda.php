<!-- IZMENA PROIZVODA -->
    <h2 class='mt-5 mb-4'>Izmena proizvoda</h2>
                                    <?php 
                                    if(isset($_GET['id'])){
                                        $id = $_GET['id'];
                                    } ?>
                                    <?php
                                    $proizvod = executeOneRow("SELECT * FROM proizvod p
                                                               INNER JOIN kategorija_podkategorija kp
                                                               ON kp.id_proizvod = p.id_proizvod
                                                               INNER JOIN podkategorija po
                                                               ON po.id_podkategorija = kp.id_podkategorija
                                                               INNER JOIN kategorija k 
                                                               ON k.id_kategorija = kp.id_kategorija
                                                               INNER JOIN brend b 
                                                               ON b.id_brend = p.id_brend
                                                               INNER JOIN slika s
                                                               ON s.id_slika = p.id_slika
                                                               WHERE p.id_proizvod = $id");
                                    // var_dump($proizvod);
                                ?>
                        <form method="post" class='col-xl-12 mx-auto'>
                            <div class="row d-flex flex-column flex-wrap form-input-shadow"/>
                                <!-- id -->
                                    <input type="hidden" id='id' value='<?= $id ?>'>
                                <!-- naziv -->
                                <div class="form-group col-lg-6 col-md-12 mt-4 mr-2">
                                    <label for="">Naziv proizvoda</label>
                                    <input type="text" id="naziv" class=" form-control" value='<?= $proizvod->naziv ?>' placeholder='Naziv proizvoda...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- cena -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <label for="">Cena</label>
                                    <input type="text" id="cena"  value='<?= $proizvod->cena ?>' class="col-11 form-control" placeholder='Cena proizvoda...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- stara cena -->
                                <?php 
                                    if($proizvod->stara_cena != NULL):
                                ?>
                                <div class="form-group col-lg-6 col-md-12">
                                    <label for="">Stara cena</label>
                                    <input type="text" value='<?=$proizvod->stara_cena?>' id="staraCena" class="col-11 form-control" placeholder='Stara cena proizvoda...'/>
                                </div>
                                <?php else: ?>
                                <div class="form-group col-lg-6 col-md-12">
                                    <label for="">Stara cena</label>
                                    <input type="text" value='' name="staraCena" id="staraCena" class="col-11 form-control" placeholder='Stara cena proizvoda...'/>
                                </div>
                                <?php endif; ?>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- sifra -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <label for="">Šifra</label>
                                    <input type="text" name="sifra" id="sifra" value='<?=$proizvod->sifra?>' class="col-11 form-control" placeholder='Šifra proizvoda...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- brend -->
                                <label for="">Brend</label>
                                <select id="brend" class='p-1 mb-3 col-6'>
                                    <?php 
                                        $brendovi = executeQuery("SELECT * FROM brend");
                                    ?>
                                    <option value="0">Izaberite brend...</option>

                                    <?php foreach($brendovi as $b):?>

                                        <?php if($b->id_brend == $proizvod->id_brend):?>

                                        <option value="<?=$proizvod->id_brend?>" selected>
                                            <?=$proizvod->naziv_brend?>
                                        </option>

                                        <?php else: ?>

                                        <option value="<?=$b->id_brend?>">
                                            <?=$b->naziv_brend?>
                                        </option>

                                    <?php   endif; 
                                            endforeach; ?>
                                </select>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- kategorija -->
                                <label for="">Kategorija</label>
                                <select id="kategorija" class='p-1 mb-3 col-6'>
                                    <?php 
                                        $kategorije = select_all("kategorija");
                                    ?>
                                    <option value="0">Izaberite kategoriju...</option>

                                    <?php foreach($kategorije as $k):?>

                                        <?php if($k->id_kategorija == $proizvod->id_kategorija): ?>

                                        <option value="<?=$proizvod->id_kategorija?>" selected>
                                            <?=$proizvod->naziv_kategorija?>
                                        </option>

                                        <?php else: ?>

                                            <option value="<?=$k->id_kategorija?>" >
                                                <?=$k->naziv_kategorija?>
                                            </option>

                                    <?php   
                                            endif; 
                                            endforeach; ?>
                                </select>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- podkategorija -->
                                <label for="">Podkategorija</label>
                                <select id="podkategorija" class='p-1 col-6'>
                                    
                                    <?php 
                                        $podkategorije = executeQuery("SELECT * FROM podkategorija");
                                    ?>
                                    <option value="0">Izaberite podkategoriju...</option>

                                    <?php foreach($podkategorije as $p):?>

                                        <?php if($p->id_podkategorija == $proizvod->id_podkategorija):?>

                                            <option value="<?=$proizvod->id_kategorija?>" selected>
                                                <?=$proizvod->naziv_podkategorija?>
                                            </option>

                                        <?php 
                                            else:
                                        ?>

                                        <option value="<?=$p->id_kategorija?>">
                                            <?=$p->naziv_podkategorija?>
                                        </option>

                                    <?php   endif;
                                            endforeach; ?>
                                </select>
                                <span class="porukaIzmena col-lg-6 mb-2 mt-2"></span>
                                <!-- DUGME - izmena -->
                                <div class="col-lg-5 p-0 mt-3">
                                    <input type="button" id='btnIzmenaProizvoda' class='main-border-button2' value="IZMENA"/>
                                </div>
                            </div>
                            <p id="rezultatIzmena" class='mt-3'></p>
                        </form>
<!-- ../IZMENA PROIZVODA -->