  

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- LEVA STRANA => BANER -->
                    <div class="left-content">
                        <?php 
                        $banerSlike = executeQuery("SELECT * FROM baner");
                        // var_dump($banerSlike);
                            foreach($banerSlike as $bs):
                        ?>
                        <div class="thumb">
                            <img src="assets/images/<?=$bs->naziv_baner?>" alt="">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- /..LEVA STRANA -->
                </div>
                <div class="col-lg-6">
                    <!-- DESNA STRANA => BANER -->
                    <div class="right-content">
                        <div class="row">
                            
                                <?php 
                                    $idProizvoda = [17, 15, 25, 21];
                                    for($i=0; $i < count($idProizvoda); $i++):
                                        $izdvojeniProizvodi = executeQuery("SELECT * FROM proizvod p 
                                                                            INNER JOIN slika s
                                                                            ON s.id_slika = p.id_slika
                                                                            WHERE p.id_proizvod = $idProizvoda[$i]");
                                        // var_dump($izdvojeniProizvodi); 
                                        foreach($izdvojeniProizvodi as $proizvod):  ?>     
                                <div class="col-lg-6">     
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <div class="inner">
                                                <div class="main-border-button">
                                                    <a href="index.php?page=proizvod&id=<?=$proizvod->id_proizvod?>" class='saznajVise'>Saznaj više...</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/<?=$proizvod->manja_slika?>">
                                    </div>
                                </div>
                            </div>
                                <?php endforeach; endfor; ?>
                            
                        </div>
                    </div>
                    <!-- /..DESNA STRANA -->
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    <section class="section m-0 p-0" id="men">
        <div class="container">
            <div class="row m-0 p-0">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2 class='mt-5 pt-2 fs-small'>IZDVAJAMO IZ PONUDE</h2>
                        <!-- <span>Details to details is what makes Hexashop different from the other themes.</span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel ">
                            <?php $muskarci = executeQuery("SELECT * FROM proizvod p
                                                            INNER JOIN kategorija_podkategorija pk
                                                            ON pk.id_proizvod = p.id_proizvod
                                                            INNER JOIN kategorija k 
                                                            ON pk.id_kategorija = k.id_kategorija
                                                            INNER JOIN slika s 
                                                            ON s.id_slika = p.id_slika
                                                            WHERE k.id_kategorija = 1 AND p.stara_cena IS NOT NULL");
                                                            // var_dump($muskarci);
                                    foreach($muskarci as $m):
                            ?>
                            <div class="item mb-5">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="index.php?page=proizvod&id=<?=$m->id_proizvod?>"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="slikaP">
                                        <img src="assets/images/<?=$m->manja_slika?>" class='img-fluid' alt="<?= $m->naziv ?>">
                                    </div>
                                </div>
                                <div class="down-content">
                                    <h4><?= $m->naziv ?> <?= $m->sifra ?></h4>
                                    <span><?= $m->cena ?>din. </span>
                                    <?php 
                                        if($m->stara_cena != NULL){
                                            echo "<s>$m->stara_cena din.</s> ";
                                        }
                                        else {
                                            echo "";
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                            <?php $zene = executeQuery("SELECT * FROM proizvod p
                                                            INNER JOIN kategorija_podkategorija pk
                                                            ON pk.id_proizvod = p.id_proizvod
                                                            INNER JOIN kategorija k 
                                                            ON pk.id_kategorija = k.id_kategorija
                                                            INNER JOIN slika s 
                                                            ON s.id_slika = p.id_slika
                                                            WHERE k.id_kategorija = 2 AND p.stara_cena IS NOT NULL");
                                                            // var_dump($zene);
                            foreach($zene as $z):
                                                            ?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="index.php?page=proizvod&id=<?=$z->id_proizvod?>"><i class="fa fa-eye"></i></a></li>
                                            <!-- <li><a href="single-product.html"><i class="fa fa-star"></i></a></li> -->
                                            <!-- <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li> -->
                                        </ul>
                                    </div>
                                    <div class="slikaP">
                                        <img src="assets/images/<?=$z->manja_slika?>" class='img-fluid' alt="<?= $z->naziv ?>">
                                    </div>
                                </div>
                                <div class="down-content">
                                    <h4><?= $z->naziv ?> <?= $z->sifra ?></h4>
                                    <span><?= $z->cena ?>din. </span>
                                    <?php 
                                        if($z->stara_cena != NULL){
                                            echo "<s>$z->stara_cena din.</s> ";
                                        }
                                        else {
                                            echo "";
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    <section class="section" id="kids">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kid-item-carousel">
                        <div class="owl-kid-item owl-carousel">
                            <?php 
                                $deca = executeQuery("SELECT * FROM proizvod p
                                                    INNER JOIN kategorija_podkategorija pk
                                                    ON pk.id_proizvod = p.id_proizvod
                                                    INNER JOIN kategorija k 
                                                    ON pk.id_kategorija = k.id_kategorija
                                                    INNER JOIN slika s 
                                                    ON s.id_slika = p.id_slika
                                                    WHERE k.id_kategorija = 3 AND p.stara_cena IS NOT NULL");
                                foreach($deca as $d):
                                ?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="index.php?page=proizvod&id=<?=$d->id_proizvod?>"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="slikaP">
                                        <img src="assets/images/<?=$d->manja_slika?>" alt="<?=$d->naziv?>">
                                    </div>
                                </div>
                                <div class="down-content">
                                    <h4><?=$d->naziv?> <?=$d->sifra?></h4>
                                    <span><?=$d->cena?> din.</span>
                                   
                                    <?php 
                                        if($d->stara_cena != NULL){
                                            echo "<s>$d->stara_cena din.</s> ";
                                        }
                                        else {
                                            echo "";
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Kids Area Ends ***** -->
    <!-- <section id="show-picture"> -->
        <video class='video' autoplay muted loop>
            <source src='assets/videos/adidas-background.mp4' class="embed-responsive-item" type='video/mp4'></source>
        </video>
    <!-- </section> -->
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    <section class="section" id="social">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class='fs-small'>Pratite nas na instagramu</h2>
                        <!-- <span>Details to details is what makes Hexashop different from the other themes.</span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row images">
                <?php $igSlike = executeQuery('SELECT * FROM instagram_slike');
                    foreach($igSlike as $i):
                ?>
                <div class="col-lg-2 col-md-4 col-sm-6 m-0 p-0">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com" target='_blank'>
                                <h6 class=''><?= $i->naziv_objava ?></h6>
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                        <img src="assets/images/<?=$i->ig_slika?>" alt="<?=$i->naziv_objave?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ***** Social Area Ends ***** -->
<!-- ***** Subscribe Area Ends ***** -->
    