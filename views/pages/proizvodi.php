  <!-- VIDEO -->
  <?php 
  if(isset($_GET['idKategorija'])){
  if($_GET['idKategorija'] == 1){
        echo "<video class='video' autoplay muted loop>
        <source src='assets/videos/nike-men.mp4' type='video/mp4'></source>
    </video>";
    }
    elseif($_GET['idKategorija'] == 2){
        echo "<video class='video' autoplay muted loop>
                <source src='assets/videos/nike-women.mp4' type='video/mp4'></source>
              </video>";
    }
    elseif($_GET['idKategorija'] == 3){
        echo "<video class='video' autoplay muted loop>
                <source src='assets/videos/nike-jungle-pack.mp4' type='video/mp4'></source>
              </video>";
    }
}?>
   
    <!-- ***** Main Banner Area End ***** -->

<?php 
    if(isset($_GET['idKategorija'])){
        $idKategorija = $_GET['idKategorija'];
        // var_dump($idKategorija);
        $fetchData = executeQuery("SELECT * FROM proizvod p INNER JOIN 
                                   kategorija_podkategorija kp ON kp.id_proizvod = p.id_proizvod
                                   INNER JOIN kategorija k ON k.id_kategorija = kp.id_kategorija
                                   INNER JOIN brend b ON b.id_brend = p.id_brend
                                   INNER JOIN slika s ON s.id_slika = p.id_slika
                                   WHERE k.id_kategorija = $idKategorija");
        //    var_dump($fetchData);
    }
    
?>
    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 py-5 my-5">
                    <div class='sortiranje'>
                        <!-- sortiranje -->
                            <label for="">SORTIRANJE</label>
                            <select id="ddlSortiranje" class='form-control color-outline'>
                                <option value="0">Izaberite...</option>
                                <option value="asc">Cena rastuće</option>
                                <option value="desc">Cena opadajuće</option>
                            </select>
                        </div>
                        <!-- ../sortiranje -->
                        <div class="border-bottom mt-5 mb-2"></div>
                        <!-- filter brend -->
                        <?php 
                            // brend
                            $brendovi = executeQuery("SELECT * FROM brend");
                            // broj proizvoda
                            // if(isset($idKategorija)){
                            $count = executeQuery("SELECT *, COUNT(p.id_proizvod) AS count FROM proizvod p 
                                                   INNER JOIN brend b ON p.id_brend = b.id_brend 
                                                   INNER JOIN kategorija_podkategorija kp ON kp.id_proizvod = p.id_proizvod
                                                   WHERE kp.id_kategorija = $idKategorija");
                            
                            // var_dump($count);
                            // var_dump($brendovi);
                            // }
                        ?>
                        
                        <ul class='filtriranjeBrend'>
                            <label for="" class='mb-3 ml-1'>BREND</label>
                            <?php foreach($brendovi as $b):
                                     foreach($count as $c): ?>
                            <li>
                                <div class="form-check d-flex flex-row align-items-center mb-2">
                                <input class="form-check-input" type="checkbox" name='brendovi[]' value="<?=$b->id_brend?>">
                                    <label class="form-check-label ml-4 design-label-checkbox" for="flexCheckDisabled">
                                         <?= $b->naziv_brend ?> <?php 
                                            // if($b->id_brend == $c->id_brend && $b->naziv_brend == $c->naziv_brend){
                                            //     echo "($c->count)";
                                            // }
                                         ?>
                                    </label>
                                </div>
                            </li>
                            <?php endforeach;
                            endforeach; ?>
                        </ul>
                        <!-- ../filter brend -->
                        <div class="border-bottom mt-5 mb-2"></div>
                        <!-- filter podkategorije -->
                        <?php $podkategorije = executeQuery("SELECT * FROM podkategorija"); ?>
                            <ul class="filtriranjePodkategorija">
                                <label for="" class='mb-3 ml-1'>PODKATEGORIJA</label>
                                <?php foreach($podkategorije as $pk):?>
                                <li>
                                    <div class="form-check d-flex flex-row align-items-center mb-2">
                                        <input class="form-check-input" type="checkbox" name='podkategorije[]' value="<?=$pk->id_podkategorija?>" />
                                            <label class="form-check-label ml-4 design-label-checkbox" for="flexCheckDisabled">
                                                    <?= $pk->naziv_podkategorija ?>
                                            </label>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- ../filter podkategorije -->
    
                <!-- proizvod -->
                <div class="col-lg-9 d-flex flex-wrap justify-content-start align-items-center mt-5 pt-5 " id='proizvodi'>
                <?php foreach($fetchData as $proizvod):?>
                    <div class="col-lg-4  col-sm-6 col-12 mb-5 d-flex proizvod">
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="index.php?id=<?=$proizvod->id_proizvod?>&page=proizvod"><i class="fa fa-eye"></i></a></li>
                                        <!-- <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                        <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li> -->
                                    </ul>
                                </div>
                                <div class="slikaP">
                                    <img src="assets/images/<?=$proizvod->manja_slika?>" class='img-fluid' alt="<?=$proizvod->naziv?>" />
                                </div>
                            </div>
                            <div class="down-content">
                                <h4 class='nazivProizvoda'><?=$proizvod->naziv?> <?=$proizvod->sifra?></h4>
                                <p class='brand'><?=$proizvod->naziv_brend?> - <?=$proizvod->naziv_kategorija?></p>
                                <div class='mt-1 d-flex flex-row justify-content-between'>
                                <!-- regularna ili nova cena -->
                                    <span class='cena'>
                                        <?= $proizvod->cena ?> din.
                                    </span>
                                    <!-- ispis stare cene ako postoji -->
                                    <?php 
                                        if($proizvod->stara_cena != NULL){
                                            echo "<s>$proizvod->stara_cena din.</s>";
                                        }
                                        else {
                                            echo "";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- ../proizvod -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Products Area Ends ***** -->