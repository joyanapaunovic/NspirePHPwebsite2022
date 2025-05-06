<?php 

// => SELECT *
function select_all($imeTabele){
    global $conn;
    $query = "SELECT * FROM $imeTabele";
    $content = $conn->query($query)->fetchAll();
    return $content;
}

/*====> REGISTRACIJA <====*/
function dodavanje_korisnika($ime, $prezime, $telefon, $ulica, $email, $sifrovanaLozinka, $idUloga){
    global $conn;
    $upit = "INSERT INTO korisnik(ime, prezime, email, lozinka, telefon, ulica, id_uloga)
    VALUES (:ime, :prezime, :email, :lozinka, :telefon, :ulica, :idUloga)";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":ime", $ime);
    $prepare->bindParam(":prezime", $prezime);
    $prepare->bindParam(":email", $email);
    $prepare->bindParam(":lozinka", $sifrovanaLozinka);
    $prepare->bindParam(":telefon", $telefon);
    $prepare->bindParam(":ulica", $ulica);
    $prepare->bindParam(":idUloga", $idUloga);

    $result = $prepare->execute();
    return $result;
}
/*====> PRIJAVA <====*/
function provera_korisnika($email, $sifrovanaLozinka){
    global $conn;
    $upit = "SELECT * FROM korisnik k INNER JOIN uloga u ON u.id_uloga = k.id_uloga
    WHERE k.email = :email AND k.lozinka = :lozinka";

    $prepare = $conn->prepare($upit);
    
    $prepare->bindParam(":email", $email);
    $prepare->bindParam(":lozinka", $sifrovanaLozinka);

    $prepare->execute();
    $result = $prepare->fetch();

    return $result;
}

/*====> admin panel <====*/
// brisanje proizvoda
function brisanje_proizvoda($id, $nazivKolone, $nazivTabele){
    global $conn;
    $upit = "DELETE FROM $nazivTabele WHERE $nazivKolone = :id";
    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":id", $id);

    $result = $prepare->execute();

    return $result;
}

// filtriranje
function select_where_in($idKolone, $podaci, $idKategorija){
    global $conn;

    $implode_niz = implode(', ', $podaci);
    
    $query = "SELECT * FROM proizvod p 
    INNER JOIN kategorija_podkategorija kp 
    ON kp.id_proizvod = p.id_proizvod
    INNER JOIN kategorija k 
    ON k.id_kategorija = kp.id_kategorija
    INNER JOIN brend b 
    ON b.id_brend = p.id_brend
    INNER JOIN slika s 
    ON s.id_slika = p.id_slika
    WHERE $idKolone IN($implode_niz) 
    AND k.id_kategorija = $idKategorija";

    $content = $conn->query($query);

    $result = $content->fetchAll();

    return $result;
}

// function selekcija_podkategorije_i_brendovi($idKategorija, $podaci1, $podaci2){ // idKategorija, brendovi, podkategorije
//     global $conn;

//     $implode_niz1 = implode(', ', $podaci1); // brendovi
//     $implode_niz2 = implode(', ', $podaci2); // podkategorije

//     $query = "SELECT * FROM proizvod p 
//     INNER JOIN kategorija_podkategorija kp 
//     ON kp.id_proizvod = p.id_proizvod
//     INNER JOIN kategorija k 
//     ON k.id_kategorija = kp.id_kategorija
//     INNER JOIN brend b 
//     ON b.id_brend = p.id_brend
//     INNER JOIN slika s 
//     ON s.id_slika = p.id_slika
//     WHERE (pk.id_podkategorija IN($implode_niz2) && p.id_brend IN ($implode_niz1))  
//     AND k.id_kategorija = $idKategorija";

//     $content = $conn->query($query);

//     $result = $content->fetchAll();

//     return $result;

// }
// dohvatanje jednog reda
function executeOneRow($upit){
    global $conn;
    return $conn->query($upit)->fetch();
}
/*====> INSERT <====*/
function insert_slika($thumbnail, $original){
    global $conn;
    $upit = "INSERT INTO slika (manja_slika, veca_slika)
    VALUES(:thumbnail, :original)";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":thumbnail", $thumbnail);
    $prepare->bindParam(":original", $original);
    $result = $prepare->execute();
    return $result;
}

function insert_proizvod($naziv, $cena, $staraCena, $sifra, $idBrend, $slika){
    global $conn;
   
    $upit = "INSERT INTO proizvod (naziv, cena, stara_cena, sifra, id_brend, id_slika)
    VALUES(:naziv, :cena, :staraCena, :sifra, :idBrend, :idSlika)";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":naziv", $naziv);
    $prepare->bindParam(":cena", $cena);
    if($staraCena != ""){
        $prepare->bindParam(":staraCena", $staraCena);
    }
    else {
        $staraCenaNULL = NULL;
        $prepare->bindParam(":staraCena", $staraCenaNULL);
    }
    $prepare->bindParam(":sifra", $sifra);
    $prepare->bindParam(":idBrend", $idBrend);
    $prepare->bindParam(":idSlika", $slika);

    $result = $prepare->execute();
    return $result;
}

function insert_kategorija_podkategorija($idKategorija, $idPodkategorija, $idProizvod){
    global $conn;

    $upit = "INSERT INTO kategorija_podkategorija(id_kategorija, id_podkategorija, id_proizvod)
    VALUES (:idKat, :idPodkat, :idProizvod)";
    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":idKat", $idKategorija);
    $prepare->bindParam(":idPodkat", $idPodkategorija);
    
    $prepare->bindParam(":idProizvod", $idProizvod);

    $result = $prepare->execute();
    return $result;
}

function insert_velicina_proizvod($idVelicina, $idProizvod){
    global $conn;

    $upit = "INSERT INTO velicina_proizvod (id_velicina, id_proizvod)
    VALUES (:idVelicina, :idProizvod)";
    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":idVelicina", $idVelicina);
    $prepare->bindParam(":idProizvod", $idProizvod);

    $result = $prepare->execute();
    
    return $result;

}
function insert_korpa($idKorisnik, $kolicina, $velicina, $idProizvod, $cena){
    global $conn;

    $upit = "INSERT INTO korpa(id_korisnik, kolicina, id_velicina, id_proizvod, cena_porudzbine)
    VALUES (:idKorisnik, :kolicina, :idVelicina, :idProizvod, :cena)";
    
    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":idKorisnik", $idKorisnik);
    $prepare->bindParam(":kolicina", $kolicina);
    $prepare->bindParam(":idVelicina", $velicina);
    $prepare->bindParam(":idProizvod", $idProizvod);
    $prepare->bindParam(":cena", $cena);

    $result = $prepare->execute();

    return $result;

}
function cenaSaDostavom($cena, $kolicina){
    return ($cena * $kolicina) + 330.00;
}
function izmena_korisnika($ime, $prezime, $telefon, $ulica, $email, $lozinka, $idKorisnik){
    global $conn;
    if($lozinka != ""){
        $upit = "UPDATE korisnik
        SET ime = :ime,
        prezime = :prezime,
        telefon = :telefon,
        ulica = :ulica,
        email = :email,
        lozinka = :lozinka
        WHERE id_korisnik = :id";
    }
    elseif($lozinka == ""){
        $upit = "UPDATE korisnik
        SET ime = :ime,
        prezime = :prezime,
        telefon = :telefon,
        ulica = :ulica,
        email = :email
        WHERE id_korisnik = :id";
    }
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":ime", $ime);
    $prepare->bindParam(":prezime", $prezime);
    $prepare->bindParam(":telefon", $telefon);
    $prepare->bindParam(":ulica", $ulica);
    $prepare->bindParam(":email", $email);
    if($lozinka != ""){
        $prepare->bindParam(":lozinka", $lozinka);
    }
    $prepare->bindParam(":id", $idKorisnik);

    $result = $prepare->execute();

    return $result;



}
function update_proizvod($naziv, $cena, $staraCena, $sifra, $brend, $id){
    global $conn;
    $upit = "";
    if($staraCena != ""){
        $upit = "UPDATE proizvod SET naziv = :naziv,
        cena = :cena, stara_cena = :staraCena,
        sifra = :sifra, id_brend = :brend
        WHERE id_proizvod = :id";
    }
    elseif($staraCena == ""){
        $upit = "UPDATE proizvod SET naziv = :naziv,
        cena = :cena, stara_cena = :staraCena,
        sifra = :sifra, id_brend = :brend
        WHERE id_proizvod = :id";
    }

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":naziv", $naziv);
    $prepare->bindParam(":cena", $cena);
    if($staraCena != ""){
        $prepare->bindParam(":staraCena", $staraCena);
    }
    elseif($staraCena == '') {
        $staraCenaNULL = NULL;
        $prepare->bindParam(":staraCena", $staraCenaNULL);
    }
    $prepare->bindParam(":sifra", $sifra);
    $prepare->bindParam(":brend", $brend);
    $prepare->bindParam(":id", $id);

    $result = $prepare->execute();

    return $result;

}
function update_pk($kategorija, $podkategorija, $id){
    global $conn;
    $upit = "UPDATE kategorija_podkategorija SET
    id_kategorija = :kategorija, id_podkategorija = :podkategorija
    WHERE id_proizvod = :id";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(":kategorija", $kategorija);
    $prepare->bindParam(":podkategorija", $podkategorija);
    $prepare->bindParam(":id", $id);

    $result = $prepare->execute();
    return $result;
}

?>