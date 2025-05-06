window.onload = function(){
    $('.collapse').collapse('hide');
    // => EVENT onclick
    // => registracija - provera
    $("#btnRegistracija").on('click', provera_registracija);
    // => prijava - provera
    $("#btnPrijava").on('click', provera_prijava);
    // izmena korisnika - provera
    $("#btnIzmenaKorisnik").on('click', provera_edit_korisnik);
    // preuzmi podatke o autoru
    $("#upisiPodatkeBtn").on('click', function(){
        // alert("eee");
        var podaci = document.getElementsByClassName("podatak");
        // console.log(podaci)
        // console.log(podaci[0].innerHTML)
        // console.log(podaci[1].innerHTML)
        // console.log(podaci[2].innerHTML)
        // console.log(podaci[3].innerHTML)
        var autor = {
            imePrezime: podaci[0].innerHTML,
            indeks: podaci[1].innerHTML,
            predmet: podaci[2].innerHTML,
            smer: podaci[3].innerHTML,
            btnUpisi: true
        };
        ajaxCallback("models/upis-u-word-dokument.php", "POST", autor, "JSON", function(result){
            console.log(result);
        })
    });
    // forma za unos proizvoda
    $("#btnProizvod").on('click', function(event){
        event.preventDefault();
        var naziv = $("#nazivSlika");
        var cena = $("#cena");
        var staraCena = $("#staraCena");
        var sifra = $("#sifra");
        var brend = $("#ddlBrend");
        var slika = $("#ddlSlika");
        // console.log(naziv.val())
        // console.log(cena.val())
        // console.log(staraCena.val())
        // console.log(sifra.val())
        // console.log(brend.val())
        // console.log(slika.val())

        // regex
        var cenaRegex = /^\d{1,7}\.{1}\d{2}$/;
        var staraCenaRegex = /^\d{1,7}\.{1}\d{2}$/;
        var sifraRegex = /^[A-Z]{1}\d{1}$/;

        var greske = 0;
        var poruke = document.getElementsByClassName("porukaProizvod");

        if(naziv.val() == ""){
            validacija = false;
            poruke[0].innerHTML = "Naziv proizvoda je obavezno polje.";
        }
        else {
            poruke[0].innerHTML = "";
        }  
        if(!cenaRegex.test(cena.val())){
            greske++;
            poruke[1].innerHTML = "Cena mora biti u formatu: 2000.00";
        }
        else {
            poruke[1].innerHTML = "";
        }
        // stara cena moze biti null
        if(staraCena.val() != ""){
            if(!staraCenaRegex.test(staraCena.val())){
                greske++;
                poruke[2].innerHTML = "Stara cena mora biti u formatu: 2000.00";
            }
            else {
                poruke[2].innerHTML = "";
            }
        }
        if(!sifraRegex.test(sifra.val())){
            greske++;
            poruke[3].innerHTML = "Šifra se mora sastojati od tačno jednog velikog slova i jednog broja.";
        }
        else {
            poruke[3].innerHTML = "";
        }
        if(brend.val() == 0){
            greske++;
            poruke[4].innerHTML = "Morate izabrati jedan od brendova.";
        }
        else {
            poruke[4].innerHTML = "";
        }
        if(slika.val() == 0){
            greske++;
            poruke[5].innerHTML = "Morate izabrati jednu od unetih slika.";
        }
        else {
            poruke[5].innerHTML = "";
        }

        if(greske == 0){
            // alert("nema gresaka")
            var proizvod = {
                naziv: naziv.val(),
                cena: cena.val(),
                staraCena: staraCena.val(),
                sifra: sifra.val(),
                idBrend: brend.val(),
                idSlika: slika.val(),
                dugmeProizvod: true
            };
            ajaxCallback("models/unos-proizvoda.php", "POST", proizvod, "JSON", function(result){
                // console.log(result);
                $("#porukaP").html(`${result.msg}`);
                setTimeout(function() { window.location=window.location;}, 1500);
            })
        }
        
        
        

      
        

    });
    $("#btnUnos").on('click', function(){
        var idProizvod = $("#ddlProizvod");
        var idKat = $("#ddlKategorija");
        var idPodkat = $("#ddlPodkategorija");
        var velicine = $("#");
        var selected = [];
        var greske = 0;
        var checked = $('input[name="velicina[]"]:checked').val();
        if(idPodkat.val() == 0){
            greske++;
        }
        console.log(checked)
    
        $('input[name="velicina[]"]:checked').each(function(el){
			selected.push(parseInt($(this).val()));
            // console.log(selected);
		});
        if(greske == 0){
            var proizvod = {
                idProizvod: idProizvod.val(),
                idKat: idKat.val(),
                idPodkat: idPodkat.val(),
                velicine: selected,
                dugme: true
            };
            // console.log(proizvod)
            ajaxCallback("models/unos.php", "POST", proizvod, "JSON", function(result){
                console.log(result);
                $("#rezultatUnos").html(`${result.msg}`);
                setTimeout(function() { window.location=window.location;}, 1500);
            })
        }
    })
    // korpa
    $("#btnKorpa").on('click', function(){
        var idProizvod = $("#idProizvoda").val();
        // alert(idProizvod)
        var checked = $('input[name="velicina[]"]:checked').val();
        var selected = [];
        // alert(checked)
        var greske = 0;
        $('input[name="velicina[]"]:checked').each(function(el){
			selected.push(parseInt($(this).val()));
            // console.log(selected);
		});
        var spanPoruka = document.getElementById("spanVelicina");
        var element = document.querySelector(".collapse");
 
        if(!checked){
            greske++; 
            element.removeAttribute("id");
            spanPoruka.innerHTML = "Potrebno je da izaberete makar jednu od dostupnih veličina za ovaj proizvod.";
        }
        else {
            spanPoruka.innerHTML = "";
            element.setAttribute('id', 'collapseExample');
        }
        var kolicina = $("#kolicina").val();
        // alert(kolicina)
        var idKorisnik = $("#idKorisnika").val();
        // alert(idKorisnik)
        if(greske == 0){
            var naruceniProizvod = {
                idProizvod: idProizvod,
                velicine: selected,
                idKorisnik: idKorisnik,
                kolicina: kolicina,
                btnKorpa: true
            };
            ajaxCallback("models/korpa.php", "POST", naruceniProizvod, 'JSON', function(result){
                console.log(result);
            })
        }
    })
    // EVENT onmousever, onmouseout
    show_hide("show", "hide", "lozinka"); // registracija
    show_hide("show2", "hide2", "lozinkaPrijava"); // prijava
    show_hide("show_", "hide_", "lozinkaIzmena"); // izmena korisnika
    // EVENT onchange
    // promena velicine prema izabranoj podkategoriji u formi za unos
    $("#ddlPodkategorija").on("change", function(){
        var podkategorija = $("#ddlPodkategorija").val();
        // alert(podkategorija)
        var podkategorija = {
            idPodkategorija: podkategorija
        };
        ajaxCallback("models/prikaz-velicina.php", "POST", podkategorija, "JSON", function(result){
            // console.log(result);
            prikazVelicina(result);
        })
    });
    // sortiranje prema ceni
    $("#ddlSortiranje").on("change", function(){
        var sortValue = $("#ddlSortiranje").val();
        var idKategorija = window.location.search.split("=");
        // console.log(idKategorija)
        var sortData = {
            sort: sortValue,
            idKategorija: idKategorija[2]
        };
        // alert(sortValue)
        ajaxCallback("models/sortiranje.php", "POST", sortData, "JSON", function(podaci){
            console.log(podaci);
            ispisProizvoda(podaci);
        });
    });
    // filtriranje prema brendu i kategoriji
    $(`input[name="brendovi[]"], input[name="podkategorije[]"]`).on('change', function() {
        var selektovaniBrendovi = [];
        var selektovanePodkategorije = [];
        var idKategorija = window.location.search.split("=");
        // alert("e")
        var checked2 = $('input[name="brendovi[]"]:checked').val();
        var checked = $('input[name="podkategorije[]"]:checked').val();
        
        // console.log(checked)
        // console.log(checked2)
        $('input[name="brendovi[]"]:checked').each(function(el){
			selektovaniBrendovi.push(parseInt($(this).val()));
            // console.log(selektovaniBrendovi);
		});
        $('input[name="podkategorije[]"]:checked').each(function(el){
			selektovanePodkategorije.push(parseInt($(this).val()));
            // console.log(selektovanePodkategorije);
		});

        var podaci_o_brendovima_i_podkategorijama = {
            brendovi: selektovaniBrendovi,
            podkategorije: selektovanePodkategorije,
            idKategorija: idKategorija[2]
        };
            // console.log(podaci_o_brendovima_i_podkategorijama);
            ajaxCallback("models/filtriranje.php", "POST", podaci_o_brendovima_i_podkategorijama, "JSON", function(podaci){
                console.log(podaci);
                ispisProizvoda(podaci);
            })
        });
    // izmena proizvoda
    $("#btnIzmenaProizvoda").on('click', function(){
        var naziv = $("#naziv");
        var cena = $("#cena");
        var staraCena = $("#staraCena");
        var sifra = $("#sifra");
        var brend = $("#brend");
        var kategorija = $("#kategorija");
        var podkategorija = $("#podkategorija");
        var id = $("#id");
        // console.log(naziv.val())
        // console.log(cena.val())
        // console.log(staraCena.val())
        // console.log(sifra.val())
        // console.log(brend.val())
        // console.log(kategorija.val())
        // console.log(podkategorija.val())
        // alert(id.val());
        var cenaRegex = /^\d{1,7}\.{1}\d{2}$/;
        var sifraRegex = /^[A-Z]{1}\d{1}$/;

        var greske = 0;
        
        if(staraCena.val() != ""){
             if(!provera_regex(staraCena, cenaRegex, 2, "porukaIzmena", "Stara cena proizvoda mora biti u formatu: 2000.00")){
                 greske++;
             }
        }
        if(!provera_regex(cena, cenaRegex, 1, "porukaIzmena", "Stara cena proizvoda mora biti u formatu: 2000.00")){
            greske++;
        }
        if(!provera_regex(sifra, sifraRegex, 3, "porukaIzmena", "Stara cena proizvoda mora biti u formatu: 2000.00")){
            greske++;
        }
        var poruka = document.getElementsByClassName('porukaIzmena');
        if(naziv.val() == ""){
            greske++;
            poruka[0].innerHTML = "Naziv proizvoda je obavezno polje.";
        }
        else {
            poruka[0].innerHTML = "";
        }
        if(brend.val() == 0){
            greske++;
            poruka[4].innerHTML = "Potrebno je da izaberete jedan od brendova proizvoda.";
        }
        else {
            poruka[4].innerHTML = "";
        }
        if(kategorija.val() == 0){
            greske++;
            poruka[5].innerHTML = "Potrebno je da izaberete jednu od kategorija proizvoda.";
        }
        else {
            poruka[5].innerHTML = "";
        }
        if(podkategorija.val() == 0){
            greske++;
            poruka[6].innerHTML = "Potrebno je da izaberete jednu od podkategorija proizvoda.";
        }
        else {
            poruka[6].innerHTML = "";
        }

        if(greske == 0){
            // alert("nema gresaka.");
            var modifikovaniProizvod = {
                naziv: naziv.val(),
                cena: cena.val(),
                staraCena: staraCena.val(),
                sifra: sifra.val(),
                idBrend: brend.val(),
                idPodkategorija: podkategorija.val(),
                idKategorija: kategorija.val(),
                idProizvod: id.val(),
                dugmeIzmeni: true
            };
            // console.log(modifikovaniProizvod)
            ajaxCallback("models/izmena-proizvoda.php", 'POST', modifikovaniProizvod, 'JSON', function(result){
                console.log(result);
                $("#rezultatIzmena").html(`${result.msg}`);
                setTimeout(function() { window.location=window.location;}, 1500);
            });
        }
        else {
            alert('ima gresaka');
        }

    });
    
} ///// -----> end window.onload <------ //



/*----------  FUNKCIJE  ----------*/


/*===> AJAX CALLBACK <===*/
function ajaxCallback(url, method, data, dataType, success){
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: dataType,
        success: success,
        error: function(xhr){
            console.log(xhr);
            console.log(xhr.responseText);
            // switch(xhr.status){
            //     case 404:
            //         alert("404");
            //         break;
            //     case 500:
            //         alert("500");
            //     case 200:
            //         alert('200');
            // }
            // console.log(xhr.error);
        }
    });
} 
/*===> show/hide za password polje <===*/ 
function show_hide(showId, hideId, idInputPassword){
    // show
    $("#" + showId).on('mouseover', function(){
        var lozinka = document.getElementById(idInputPassword);
        if(lozinka.type === "password"){
            lozinka.type = "text"; 
            // #hide u css-u je inicijalno none
            document.getElementById(hideId).style.display = "inline-block";
            document.getElementById(showId).style.display = "none";
        }
        else {
            lozinka.type = "password";
            document.getElementById(hideId).style.display = "none";
            document.getElementById(showId).style.display = "inline-block";
        }
    });
    // hide
    $("#" + hideId).on('mouseout', function(){
        var lozinka = document.getElementById(idInputPassword);
        // console.log(lozinka);
        if(lozinka.type === "password"){
            lozinka.type = "text"; 
            // #hide u css-u je inicijalno none
            document.getElementById(hideId).style.display = "inline-block";
            document.getElementById(showId).style.display = "none";
        }
        else {
            lozinka.type = "password";
            document.getElementById(hideId).style.display = "none";
            document.getElementById(showId).style.display = "inline-block";
        }
    });
}
/*===> PROVERA REGEX <===*/
function provera_regex(polje, regex, brojSpana, spanKlasa, poruka){
    var spanPoruka = document.getElementsByClassName(spanKlasa);
    if(!regex.test(polje.val())){
        spanPoruka[brojSpana].innerHTML = poruka;
        return false;
    }
    else {
        spanPoruka[brojSpana].innerHTML = '';
        return true;
    }
}
// provera => registracija
function provera_registracija(){
    // alert("uspesno kliknuto");
    // dohvatanje polja
    var ime = $("#ime");
    var prezime = $("#prezime");
    var email = $("#email");
    var lozinka = $("#lozinka");
    var ulica = $("#ulica");
    var telefon = $("#telefon");
    // greske
    var validacija = true;
    // regex
    var regexIme = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/;
    var regexPrezime = /^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,14})\s?([A-Z][a-z]{2,19})?$/; // mogucnost dva prezimena
    var regexEmail = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;
    var regexLozinka = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/;
    var regexUlica = /^[A-ZČĆŽŠĐ][a-zčćžšđ]+(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s\d+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?$/;
    var regexTelefon = /^(\+381)(\s)?6(([0-9]){8,9})$/; // +381611231971 ili  +381 611231971; +381 6 + (8 ili 9 cifara)
    // provera
    if(!provera_regex(ime, regexIme, 0, "porukaReg", "Ime mora početi velikim početnim slovom i mora sadržati makar 3 karaktera.")){
        validacija = false;
    }
    if(!provera_regex(prezime, regexPrezime, 1, "porukaReg", "Prezime mora početi velikim početnim slovom i mora sadržati makar 3 karaktera.")){
        validacija = false;
    }
    if(!provera_regex(telefon, regexTelefon, 2, "porukaReg", "Vaš broj telefona mora biti u formatu +381.")){
        validacija = false;
    }  
    if(!provera_regex(ulica, regexUlica, 3, "porukaReg", "Ulica mora početi velikim početnim slovom i može sadržati brojeve. ")){
        validacija = false;
    }
    if(!provera_regex(email, regexEmail, 4, "porukaReg", "Format ovog polja je: primer@gmail.com. Dodatno, mogućnost korišćenja brojeva i specijalnih karaktera (. i _).")){
        validacija = false;
    }
    if(!provera_regex(lozinka, regexLozinka, 5, "porukaReg", "Lozinka mora imati makar 8 karaktera od kojih je jedno veliko slovo, jedno malo slovo, jedan broj i jedan specijalan karakter.")){
        validacija = false;
    }
  
    if(validacija){
        // alert("nema gresaka");
        var registrovaniKorisnik = {
            ime: ime.val(),
            prezime: prezime.val(),
            telefon: telefon.val(),
            ulica: ulica.val(),
            email: email.val(),
            lozinka: lozinka.val(),
            dugmeRegistracija: true
        };
        // pozivanje ajaxCallback; slanje podataka
        ajaxCallback("models/registrovanje.php", "POST", registrovaniKorisnik, "json", function(rezultat){
            // console.log(rezultat);
            $("#rezultatReg").html(rezultat.msg);
            // refresh strane
            setTimeout(function() { 
                window.location = window.location;
            }, 2000);
        });
    }
    else {
        // alert("Greska na klijentskoj strani!");
    }

}
function provera_edit_korisnik(){
    var id = $("#idKorisnik");
    // alert(id.val())
    var ime = $("#ime");
    // console.log(ime.val())
    var prezime = $("#prezime");
    var telefon = $("#telefon");
    var ulica = $("#ulica");
    var email = $("#email");
    var lozinka = $("#lozinkaIzmena");
    // console.log(prezime.val())
    // console.log(telefon.val())
    // console.log(ulica.val())
    // console.log(email.val())
    // console.log(lozinka.val())
    var validacija = true;
    // regex
    var regexIme = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/;
    var regexPrezime = /^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,14})\s?([A-Z][a-z]{2,19})?$/; // mogucnost dva prezimena
    var regexEmail = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;
    var regexLozinka = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/;
    var regexUlica = /^[A-ZČĆŽŠĐ][a-zčćžšđ]+(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?(\s\d+)?(\s[A-ZČĆŽŠĐa-zčćžšđ]+)?$/;
    var regexTelefon = /^(\+381)(\s)?6(([0-9]){8,9})$/; // +381611231971 ili  +381 611231971; +381 6 + (8 ili 9 cifara)
    // provera
    if(!provera_regex(ime, regexIme, 0, "porukaIzmena", "Ime mora početi velikim početnim slovom i mora sadržati makar 3 karaktera.")){
        validacija = false;
    }
    if(!provera_regex(prezime, regexPrezime, 1, "porukaIzmena", "Prezime mora početi velikim početnim slovom i mora sadržati makar 3 karaktera.")){
        validacija = false;
    }
    if(!provera_regex(telefon, regexTelefon, 2, "porukaIzmena", "Vaš broj telefona mora biti u formatu +381.")){
        validacija = false;
    }  
    if(!provera_regex(ulica, regexUlica, 3, "porukaIzmena", "Ulica mora početi velikim početnim slovom i može sadržati brojeve. ")){
        validacija = false;
    }
    if(!provera_regex(email, regexEmail, 4, "porukaIzmena", "Format ovog polja je: primer@gmail.com. Dodatno, mogućnost korišćenja brojeva i specijalnih karaktera (. i _).")){
        validacija = false;
    }
    if(lozinka.val() != ""){
        if(!provera_regex(lozinka, regexLozinka, 5, "porukaIzmena", "Lozinka mora imati makar 8 karaktera od kojih je jedno veliko slovo, jedno malo slovo, jedan broj i jedan specijalan karakter.")){
                validacija = false;
            }
        }
        if(validacija){
            var edit = {
                ime: ime.val(),
                prezime: prezime.val(),
                telefon: telefon.val(),
                ulica: ulica.val(),
                email: email.val(),
                lozinka: lozinka.val(),
                btnIzmenaKorisnik: true,
                idKorisnik: id.val()
            };
            // console.log(edit)
            ajaxCallback("models/izmena-korisnika.php", 'POST', edit, 'JSON', function(result){
                console.log(result);
                $("#rezultatIzmene").html(`${result.msg}`);
                setTimeout(function() { 
                    window.location = window.location;
                }, 2000);
            })
        }
    }
    
// provera => prijava
function provera_prijava(){
    var email = $("#emailPrijava");
    var lozinka = $("#lozinkaPrijava");

    // greske
    var validacija = true;
    // regex
    var regexEmail = /^[\w\.\_]+\@([a-z0-9]+\.)+[a-z]{2,3}$/;
    var regexLozinka = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%.^&*-]).{8,}$/;
    // email
    if(!provera_regex(email, regexEmail, 0, "porukaPrijava", "Format ovog polja je: primer@gmail.com. Dodatno, mogućnost korišćenja brojeva i specijalnih karaktera (. i _).")){
        validacija = false;
    }
    // lozinka
    if(!provera_regex(lozinka, regexLozinka, 1, "porukaPrijava", "Lozinka mora imati makar 8 karaktera od kojih je jedno veliko slovo, jedno malo slovo, jedan broj i jedan specijalan karakter.")){
        validacija = false;
    }

    if(validacija){
        var korisnik = {
            emailPrijava: email.val(),
            lozinkaPrijava: lozinka.val(),
            dugmePrijava: true
        };
        ajaxCallback("models/prijavljivanje.php", "POST", korisnik, "JSON", function(rezultat){
            // console.log(rezultat);
            $("#rezultatPrijava").html(rezultat.msg);
            setTimeout(function() { 
                window.location = window.location;
            }, 2000);
        });
    }
    else {
        // alert("Greske na klijentskoj strani!");
    }
}


   // ispisivanje proizvoda
function ispisProizvoda(podaci){
    // alert("poziv")
    var html = ``;
    // alert(podaci.length)
    if(podaci.length == 0) {
                html += `<h4 class='col-xl-12 text-center d-flex my-5 mx-auto align-items-center justify-content-center'>Trenutno nije pronadjen nijedan proizvod. </h4>`;
        }
    else {
        for(var p of podaci){
            // alert("u petlji sam");
            html += `
                <div class="col-lg-4 col-sm-6 col-12 d-flex flex-wrap ">
                <div class="item">
                    <div class="thumb">
                        <div class="hover-content">
                            <ul>
                                <li><a href="index.php?id=${p.id_proizvod}&page=proizvod"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <div class="slikaP">
                            <img src="assets/images/${p.manja_slika}" class='img-fluid' alt="${p.naziv}" />
                        </div>
                    </div>
                    <div class="down-content">
                        <h4>${p.naziv} ${p.sifra}</h4>
                        <p class='brand'>${p.naziv_brend} - ${p.naziv_kategorija}</p>
                        <div class='mt-1 d-flex flex-row justify-content-between'>
                        <!-- regularna ili nova cena -->
                            <span class='cena'>
                                ${p.cena} din.
                            </span>` 
                                if(p.stara_cena == null){
                                   html+= ``;
                                }
                                else {
                                    html += `<s>${p.stara_cena}</s>`;
                                }
                        html+= `
                        </div>
                    </div>
                </div>
            </div>
            `;
          
        } // for
        
    } 
    $("#proizvodi").html(html);  
} // end - funkcija

function prikazVelicina(data){
    console.log(data)
    var html = `<label for="">Veličine</label>`;
    for(var d of data){
    html+=`<li>
        <div class="form-check d-flex flex-row align-items-center mb-2">
                <input class="form-check-input" type="checkbox" name='velicina[]' value="${d.id_velicina}"/>
                <label class="form-check-label ml-4 design-label-checkbox" for="">
                    ${d.naziv_velicina}
                </label>
        </div>
        </li>`;
    }
    $("#listaCheckbox").html(html);
}

