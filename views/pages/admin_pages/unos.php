<div class="col-6">
    <!-- <h4 class='mb-3'>Unos kategorije, podkategorije i dostupnih veličina za određeni proizvod</h4> -->
    <form action="models/unos.php" method='post'>
            <!--  PROIZVOD -->
            <label for="" class='mt-2'>Proizvod</label>
            <select id='ddlProizvod' class='mt-2 p-1 mb-2 col-12'>
                    <?php 
                        $proizvod = select_all("proizvod");
                        // var_dump($proizvod);
                        foreach($proizvod as $p):
                    ?>
                <option value="<?= $p->id_proizvod ?>" >
                    <?= $p->id_proizvod ?> - <?= $p->naziv ?>
                </option>
            <?php endforeach; ?>
            </select>
            <!-- KATEGORIJA -->
            <label for="" class='mt-2'>Kategorija</label>
            <select id='ddlKategorija' class='mt-2 p-1 mb-2 col-12'>
                    <?php 
                        $kategorija = select_all("kategorija");
                        foreach($kategorija as $k):
                    ?>
                <option value="<?= $k->id_kategorija ?>" >
                    <?= $k->naziv_kategorija ?>
                </option>
            <?php endforeach; ?>
            </select>
            <!-- PODKATEGORIJA -->
            <label for="" class='mt-2'>Podkategorija</label>
            <select id='ddlPodkategorija' class='mt-2 p-1 mb-2 col-12'>
                    <option value="0">Izaberite...</option>
                    <?php 
                        $podkategorija = select_all("podkategorija");
                        foreach($podkategorija as $pk):
                    ?>
                <option value="<?= $pk->id_podkategorija ?>" >
                    <?= $pk->naziv_podkategorija ?>
                </option>
            <?php endforeach; ?>
            </select>
            <!-- VELICINE -->
            <ul id='listaCheckbox' class='mt-3'>
                <label for="">Veličine</label>
                <?php 
                    $velicine = select_all("velicina");
                    foreach($velicine as $v):
                ?>
                <li>
                <div class="form-check d-flex flex-row align-items-center mb-2">
                        <input class="form-check-input" type="checkbox" name='velicina[]' value="<?=$v->id_velicina?>"/>
                        <label class="form-check-label ml-4 design-label-checkbox" for="">
                            <?=$v->naziv_velicina?>
                        </label>
                </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="col-lg-5 p-0 mt-4">
                <input type="button" id='btnUnos' class='main-border-button2' value="DODAJ" />
            </div>
            <p id="rezultatUnos" class='mt-2'></p>
    </form>
</div>