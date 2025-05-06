<?php 
    if(isset($_SESSION['korisnik'])):
        $korisnik = $_SESSION['korisnik'];
        // var_dump($korisnik);
        if($korisnik->id_uloga == 2):
?> 
<div class="container m-0 p-0 my-5 py-5">
    <div class="row m-0 p-0">
        <div class="col-lg-3 pt-4 mt-5 leva-strana">
            <ul class='admin-links'>
                <li class=''>
                    <i class="fa-solid fa-table-cells-large"></i> <a href="index.php?page=korisnik&userPage=licni-podaci">Moji lični podaci</a>
                </li>
                <li>
                    <i class="fa-solid fa-magnifying-glass-chart"></i> <a href="index.php?page=korisnik&userPage=narudzbine">Moje narudžbine</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-9 m-0 p-0 mt-4 d-flex flex-column flex-wrap">
                <?php 
                    if(isset($_GET['userPage'])){
                        if($_GET['userPage'] == "narudzbine"){
                            include("user_pages/narudzbine.php");
                        }
                        elseif($_GET['userPage'] == "licni-podaci"){
                            include("user_pages/licni-podaci.php");
                        }
                    }
                ?>
               
            
        </div>
    </div>
</div>
<?php else: header("Location: index.php?page=404"); 
    endif;
    else: header("Location: index.php?page=404"); 
endif;
?>