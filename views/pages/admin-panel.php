<?php 
    if(isset($_SESSION['korisnik'])):
        $korisnik = $_SESSION['korisnik'];
        // var_dump($korisnik);
        if($korisnik->id_uloga == 1):
?> 
<div class="container m-0 p-0 my-5 py-5">
    <div class="row m-0 p-0">
        <div class="col-lg-3 pt-4 mt-5 leva-strana">
            <ul class='admin-links'>
                <li class=''>
                    <i class="fa-solid fa-table-cells-large"></i> <a href="index.php?page=admin-panel&adminPage=tabele">Tabele</a>
                </li>
                <li>
                    <!-- <i class="fa-brands fa-wpforms"></i> <a href="index.php?page=admin-panel&adminPage=forme" class='ml-1'>Forme</a> -->
                    <ul>
                        <li>
                            <i class="fa-brands fa-wpforms"></i><a href="index.php?page=admin-panel&adminPage=unos-slike" class='ml-1'>Unos slike proizvoda</a>
                        </li>
                        <li>
                            <i class="fa-brands fa-wpforms"></i><a href="index.php?page=admin-panel&adminPage=unos-proizvoda" class='ml-1'>Unos proizvoda</a>
                        </li>
                        <li>
                            <i class="fa-brands fa-wpforms"></i><a href="index.php?page=admin-panel&adminPage=unos" class='ml-1'>Unos kategorije, podkategorije i dostupnih veličina proizvoda</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <i class="fa-solid fa-magnifying-glass-chart"></i> <a href="index.php?page=admin-panel&adminPage=aktivnosti-korisnika">Aktivnosti korisnika</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-9 m-0 p-0 mt-4">
                <?php 
                    if(isset($_GET['adminPage'])):
                    $adminPage = $_GET['adminPage'];
                    if($adminPage == "tabele"):
                    include("admin_pages/tabele.php");
                ?>
                <?php elseif($adminPage == "izmena-proizvoda"): include("admin_pages/izmena-proizvoda.php"); ?>
                <?php elseif($adminPage == "unos-slike"): include("admin_pages/unos-slike.php"); ?>
                <?php elseif($adminPage == "unos-proizvoda"): include("admin_pages/unos-proizvoda.php"); ?>
                <?php elseif($adminPage == "unos"): include("admin_pages/unos.php"); ?>
                <?php elseif($adminPage == "aktivnosti-korisnika"): include("admin_pages/aktivnosti-korisnika.php"); ?>
               
                <?php endif;
                    endif; // glavni if
                ?>
        </div>
    </div>
</div>
<?php else: header("Location: index.php?page=404"); 
    endif;
    else: header("Location: index.php?page=404"); 
endif;
?>