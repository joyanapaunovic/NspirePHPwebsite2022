<?php 
    session_start();
    if(isset($_SESSION['korisnik'])){
        unset($_SESSION['korisnik']);
        header("Location:../index.php?page=prijava");
    }
    else {
        header("Location: ../index.php?page=404");
    }
?>