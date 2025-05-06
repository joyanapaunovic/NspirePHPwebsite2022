<!-- DODAJ SLIKU -->
<div class="col-4 mt-4">
    <h4>Unos slike</h4>
    <form action='index.php?page=admin-panel&adminPage=unos-slike' method='post' enctype='multipart/form-data'>
        <input type="file" name="upload" class="my-3" />
        <div class="col-lg-5 p-0">
            <input type="submit" name='btnUnosSlike' class='main-border-button2' value="DODAJ SLIKU" />
        </div>
    </form>
</div>

<?php 
    if(isset($_POST['btnUnosSlike'])){
       try {
        $slika = $_FILES['upload'];
         if ($slika['error'] != 0) {
                echo "<p class='mt-2 ml-3 fw'>Došlo je do greške pri uploadu slike.</p>";
                exit;
            }
            // var_dump($slika);
            if($slika['type'] == "image/jpeg" || $slika['type'] == "image/png" || $slika['type'] == "image/jpg"){
                $nameSlike = $slika['name'];
                $slikaNaziv = time() . "_" . $nameSlike;
                $tmpPutanja = $slika['tmp_name'];
                $putanja = "assets/images/$slikaNaziv";
                move_uploaded_file($tmpPutanja, $putanja);
                $dimenzije = getimagesize($putanja);
                // var_dump($dimenzije);
                $sirina = $dimenzije[0];
                $visina = $dimenzije[1];

                $novaSirina = 600;
                $novaVisina = $visina / ($sirina / $novaSirina);

                $ekstenzija = pathinfo($putanja, PATHINFO_EXTENSION);
                // echo $ekstenzija;
                if(empty($nameSlike)){
                    $_SESSION['upload'] = ['Morate izabrati fajl u formatu slike.'];
                }
                if($ekstenzija == "jpg" || $ekstenzija == "jpeg"){
                            $uploadSlika = imagecreatefromjpeg($putanja);
                            $platno = imagecreatetruecolor($novaSirina, $novaVisina);
                            imagecopyresampled($platno, $uploadSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
                            $nazivPng = explode(".", $slikaNaziv);
                            $nazivThumbnailSlika = $nazivPng[0] . "-thumbnail" . ".jpg";
                            $pngSlika = imagejpeg($platno, "assets/images/".$nazivThumbnailSlika);
                            // echo $nazivThumbnailSlika;
                }
                elseif($ekstenzija == "png"){
                    $uploadSlika = imagecreatefrompng($putanja);
                    $platno = imagecreatetruecolor($novaSirina, $novaVisina);
                    imagecopyresampled($platno, $uploadSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
                    $nazivPng = explode(".", $slikaNaziv);
                    $nazivThumbnailSlika = $nazivPng[0] . "-thumbnail" . ".png";
                    $pngSlika = imagepng($platno, "assets/images/".$nazivThumbnailSlika);
                    // echo $nazivThumbnailSlika;
                }
                $insert = insert_slika($nazivThumbnailSlika, $slikaNaziv);
                if($insert){
                    http_response_code(201);
                    // $result = 'Uspesno uneta slika';
                    echo "<p class='mt-2 ml-3 fw'>Uspešno ste uneli sliku.</p>";
                    //$errors['upload'] = ["Uspešno uneta slika u bazu podataka."];
                }
            }
            else {
                //$errors['upload'] = ["Potrebno je da slika bude sa ekstenzijom .jpg ili .png."];
            }
        }
       catch(PDOException $ex){
           echo $ex->getMessage();
           http_response_code(500);
       }
    }
?>