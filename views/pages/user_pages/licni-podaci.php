<div class="col-lg-9">
<h5 class='naslov mt-2'>Moji lični podaci</h5>
               <form method="post" class='mt-2'>
                            <div class="row d-flex flex-column flex-wrap form-input-shadow">
                                <!-- ID -->
                                <?php 
                                    if($_SESSION['korisnik']){
                                        $korisnik = $_SESSION['korisnik'];
                                        // var_dump($korisnik);
                                        $id = $korisnik->id_korisnik;
                                    }
                                    $korisnickiPodaci = executeOneRow("SELECT * FROM korisnik WHERE id_korisnik = $id");
                                    // var_dump($korisnickiPodaci);
                                ?>
                                <input type="hidden" id='idKorisnik' value=<?=$id?> />
                                <!-- Ime -->
                                <div class="form-group col-lg-6 col-md-12 mt-4 mr-2">
                                    <input type="text" id="ime" value='<?=$korisnickiPodaci->ime?>' class="col-11 form-control" placeholder='Unesite Vaše ime...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- Prezime -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <input type="text" id="prezime" value='<?=$korisnickiPodaci->prezime?>' class="col-11 form-control" placeholder='Unesite Vaše prezime...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- Broj telefona -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <input type="text" id="telefon" value='<?=$korisnickiPodaci->telefon?>' class="col-11 form-control" placeholder='Unesite Vaš broj telefona...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- Ulica -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <input type="text" id="ulica" value='<?=$korisnickiPodaci->ulica?>' class="col-11 form-control" placeholder='Ulica...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- Email -->
                                <div class="form-group col-lg-6 col-md-12">
                                    <input type="email" id="email" class="col-11 form-control" value='<?=$korisnickiPodaci->email?>'  placeholder='Unesite Vaš e-mail...'/>
                                </div>
                                <span class="porukaIzmena col-lg-6 mb-2"></span>
                                <!-- Lozinka -->
                                <div class="form-group d-flex flex-row align-items-center justify-content-between col-lg-6 col-md-12">
                                    <input type="password" id="lozinkaIzmena" class="col-11 form-control" placeholder='Unesite Vašu lozinku...'/>
                                    <!-- ikonica show/hide -->
                                    <i class="fa fa-eye-slash" id='hide_'></i>
                                    <i class='fa fa-eye' aria-hidden="true" id='show_'></i>
                                </div>  
                                <span class="porukaIzmena col-lg-6 mb-3"></span>
                                <!-- DUGME - IZMENA KORISNIKA -->
                                <div class="col-lg-5 p-0">
                                    <input type="button" id="btnIzmenaKorisnik" class='main-border-button2' value="IZMENA"/>
                                </div>
                                <p id='rezultatIzmene' class='mt-3'></p>                            </div>
                        </form>
</div>