<!-- DODAJ PROIZVOD -->
<div class="col-9 mt-4">
    <h4>Unos proizvoda</h4>
    <form action="models/unos-proizvoda.php" method='post'>
        <!-- naziv -->
        <div class="form-group mt-4 mr-2 col-12">
            <input type="text" id="nazivSlika" class="form-control" placeholder='Naziv proizvoda...'/>
        </div>
        <span class="porukaProizvod"></span>
        <!-- cena -->
        <div class="form-group mt-2 mr-2 col-12">
            <input type="text" id="cena" class="form-control" placeholder='Cena proizvoda...'/>
        </div>
        <span class="porukaProizvod"></span>
        <!-- stara cena -->
        <div class="form-group mt-2 mr-2 col-12">
            <input type="text"  id="staraCena" class="form-control" placeholder='Stara cena proizvoda...'/>
        </div>
        <span class="porukaProizvod"></span>
        <!-- sifra -->
        <div class="form-group mt-2 mr-2 col-12">
            <input type="text" id="sifra" class="form-control" placeholder='Šifra proizvoda...'/>
        </div>
        <span class="porukaProizvod"></span>
        <!-- brend -->
        <select id="ddlBrend" class='p-1 mt-2 mb-3 col-12'>
        <option value="0">Izaberite brend...</option>
            <?php 
                $brendovi = select_all("brend");
                // var_dump($brendovi);
                foreach($brendovi as $b):
            ?>
            <option value="<?= $b->id_brend ?>" >
                <?=$b->naziv_brend?>
            </option>
        <?php endforeach; ?>
        </select>
        <span class="porukaProizvod"></span>
        <!-- slika -->
        <select id='ddlSlika' class='mt-2 p-1 mb-2 col-12'>
        <option value="0">Izaberite sliku...</option>
            <?php 
                $slike = select_all("slika");
                foreach($slike as $s):
            ?>
            <option value="<?= $s->id_slika ?>" >
                <?= $s->id_slika ?> - <?= $s->veca_slika ?>
            </option>
        <?php endforeach; ?>
        </select>
        <span class="porukaProizvod"></span>
        <div class="col-lg-5 mt-2 p-0">
            <input type="submit" id="btnProizvod" class='main-border-button2' value="DODAJ PROIZVOD"/>
        </div>
        <p id="porukaP" class='mt-2'></p>
    </form>
</div>
</div>