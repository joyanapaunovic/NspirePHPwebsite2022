
    <!-- ***** Product Area Starts ***** -->
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
    ?>
    <section class="section my-5" id="product">
        <div class="container">
            <div class="row">
                <?php 
                    $proizvod = executeQuery("SELECT * FROM proizvod p
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
                    //   var_dump($proizvod);
                      $velicineProizvoda = executeQuery("SELECT * FROM velicina v
                                                        INNER JOIN velicina_proizvod pv ON pv.id_velicina = v.id_velicina
                                                        WHERE pv.id_proizvod = $id
                                                        ORDER BY v.id_velicina ASC");
                                                        // var_dump($velicineProizvoda);
                ?>
                <?php foreach($proizvod as $p): ?>
                <div class="col-lg-7 pt-5">
                    
                <div class="left-images pt-5">
                    <nav aria-label="breadcrumb mt-5">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=pocetna">Početna</a></li>
                        <li class="breadcrumb-item add-uppercase" aria-current="page">
                            <?=$p->naziv_brend?>
                        </li>
                        <!-- page -->
                        <!-- muskarci -->
                            <?php 
                                if($p->naziv_kategorija == "Muškarci"): 
                            ?>
                            <li class="breadcrumb-item">
                                <a href="index.php?idKategorija=<?=$p->id_kategorija?>&page=muskarci">
                                    <?=$p->naziv_kategorija?>
                                </a>
                            </li>
                        <!-- zene -->
                        <?php 
                            elseif($p->naziv_kategorija == "Žene"):
                        ?>
                        <li class="breadcrumb-item">
                            <a href="index.php?idKategorija=<?=$p->id_kategorija?>&page=zene">
                                <?=$p->naziv_kategorija?>
                            </a>
                        </li>
                        <!-- deca -->
                        <?php else: ?>
                            <li class="breadcrumb-item">
                                <a href="index.php?idKategorija=<?=$p->id_kategorija?>&page=deca">
                                    <?=$p->naziv_kategorija?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active" aria-current="page"><?=$p->naziv_podkategorija?></li>
                        </ol>
                    </nav>
                    <img src="assets/images/<?=$p->veca_slika?>" alt="<?=$p->naziv?>" >
                    <!-- <img src="assets/images/single-product-02.jpg" alt=""> -->
                </div>
                </div>
            <div class="col-lg-4 pt-5">
                <div class="right-content pt-5 mt-5">
                    <div class="quote">
                        <i class="fa fa-quote-left"></i><h4><?=$p->naziv?> <?=$p->sifra?></h4>
                    </div>
                        <span class='cena'>
                                    <?=$p->cena?> din.
                                </span>
                                <!-- ispis stare cene ako postoji -->
                                <?php 
                                    if($p->stara_cena != NULL){
                                        echo "<s>$p->stara_cena din.</s>";
                                    }
                                    else {
                                        echo "";
                                    }
                                ?>
                    <!-- FORM START -->
                    <form method='POST'>
                    <div class="quantity-content2">
                         <p class='add-uppercase m-0 p-0 pb-3 text-center'>Dostupne veličine</p>
                            <div class="right-content d-flex flex-wrap align-items-right">
                                <input type="hidden" id="idProizvoda" value='<?=$_GET['id']?>'/>
                                <?php foreach($velicineProizvoda as $v): ?>
                                    <div class="form-check d-flex flex-row align-items-center mb-2">
                                    <input class="form-check-input" type="checkbox" name='velicina[]' value="<?=$v->id_velicina?>" />
                                        <label class="form-check-label ml-4 design-label-checkbox" for="flexCheckDisabled">
                                            <?=$v->naziv_velicina?>
                                        </label>
                                </div>
                                <?php endforeach; ?>
                                <span id="spanVelicina"></span>
                        </div>
                    </div>
                    <div class="quantity-content mb-3">
                        <div class="left-content p-0 m-0">
                            <h6>Količina</h6>
                        </div>
                        <div class="right-content">
                            <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus"/>
                                <input type="number" id='kolicina' step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" disabled>
                                <input type="button" value="+" class="plus" />
                            </div>
                        </div>
                    </div>
                    <div class="total">
                        <!-- <h4>Total: $210.00</h4> -->
                        <?php 
                            if(isset($_SESSION['korisnik'])){
                                if($_SESSION['korisnik']->naziv_uloga == 'admin'){
                                    // echo $_SESSION['korisnik']->naziv_uloga;
                                    echo "";
                                }
                                elseif($_SESSION['korisnik']->naziv_uloga == 'korisnik'){
                                    // echo $_SESSION['korisnik']->naziv_uloga;
                                    echo "<input class=\"main-border-button2 mt-3\" data-toggle=\"collapse\" aria-expanded=\"false\" aria-controls=\"collapseExample\" data-target=\"#collapseExample\" type=\"button\" name='btnKorpa' id='btnKorpa' value=\"DODAJ U KORPU\"/>";
                                }
                            }
                            else {
                                echo "<input class=\"main-border-button2 mt-3\" aria-expanded=\"false\" aria-controls=\"collapseExample\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseExample\"  name='btnKorpa' value=\"DODAJ U KORPU\"/>";
                            }
                            
                        ?>
                      <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                           <?php 
                                if(isset($_SESSION['korisnik'])){
                                    $korisnik = $_SESSION['korisnik'];
                                    if($korisnik->naziv_uloga == "korisnik"){
                                        if(isset($_SESSION['korpa'])){
                                            $korpa = $_SESSION['korpa'];
                                            // var_dump($korpa);
                                            echo "<div class='font-size'>Proizvod uspešno dodat u korpu. <a class='link' href='index.php?page=korpa'>Pogledaj</a>.</div>";
                                        }
                                        // echo $korisnik->id_korisnik;
                                        echo "<input type='hidden' id='idKorisnika' value='$korisnik->id_korisnik'/>";
                                    }
                                }
                                else {
                                    echo "<div>Da biste na ovaj način obavili online kupovinu i poručili proizvode, potrebno je da budete registrovan korisnik i da se prijavite preko vašeg naloga. 
                                    Ukoliko niste ranije obavili registraciju, to možete uraditi klikom na link za <a class='link' href='index.php?page=registracija'>registraciju.</a></div>";
                                }
                           ?>
                        </div>
                    </div>  
                    </form>
                    <!-- END MODAL -->
                    <!-- FORM END -->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->