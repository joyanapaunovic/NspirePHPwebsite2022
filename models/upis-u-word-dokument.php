<?php 
    if(isset($_POST['btnUpisi'])){
        // echo "e";
        $imePrezime = $_POST['imePrezime'];
        $indeks = $_POST['indeks'];
        $predmet = $_POST['predmet'];
        $smer = $_POST['smer'];
        $word = fopen("../data/autor.docx", "r+");
        $sadrzaj = "Ime i prezime studenta: " . "\t" . $imePrezime . "\n"
         . "Indeks: " . "\t" . $indeks . "\n"
        . "Predmet: " . "\t" . $predmet . "\n"
        . "Smer: " . "\t" . $smer;
        fwrite($word, $sadrzaj);
        fclose($word);

        // $fajl = fopen("../data/autor.docx", "r");
        // fread($fajl, filesize("../data/autor.docx"));
        // fclose($fajl);
        echo json_encode(file("../data/autor.docx"));
    }
    else {
        header("Location: ../index.php?page=404");
    }


?>