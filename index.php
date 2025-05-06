<?php 
    include("config/connection.php");
    include("models/functions.php");
    include("views/fixed/head.php");
    include("views/fixed/header.php");
    
    if(isset($_GET['page'])){
        switch($_GET['page']){ 
            case "404":
                include "views/pages/404.php";
                break;
            case "proizvod":
                include "views/pages/proizvod.php";
                break; 
            case "registracija":
                include "views/pages/registracija.php";
                break;
            case "prijava":
                include "views/pages/prijava.php";
                break;
            case "pocetna":
                include "views/pages/pocetna.php";
                break;
            case "admin-panel":
                include "views/pages/admin-panel.php";
                break;
            case "korisnik":
                include "views/pages/korisnik.php";
                break;
            case "korpa":
                include "views/pages/korpa.php";
                break;
            case "muskarci" || "zene" || "deca":
                include "views/pages/proizvodi.php";
                break;    
        }
    } 
    // => index.php
    else {
        include "views/pages/pocetna.php";
    }
?>    
<?php 
    include('views/fixed/footer.php');
    include('views/fixed/scripts.php');
?>