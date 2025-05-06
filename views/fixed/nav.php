<?php //session_start(); ?>

<nav class="main-nav">
    <!-- ***** Logo Start ***** -->
    <a href="index.php" class="logo">
        <img src="assets/images/logo.png" ->
    </a>
    <!-- ***** Logo End ***** -->

    <!-- ***** Menu Start ***** -->
    <?php 
        // dohvatanje i ispis navigacije iz baze
        $navigacija = executeQuery("SELECT * FROM navigacija");
        // var_dump($navigacija);
    ?>
    <ul class="nav">
        <?php foreach($navigacija as $navEl): ?>
            <li class="scroll-to-section m-0 p-0 mr-2">
                <a class='nav-link add-uppercase' id='navLink<?=$navEl->id_navigacija?>' href="<?=$navEl->link?>">
                    <?=$navEl->ime_linka?>
                </a>
            </li>
        <?php   endforeach; ?>
                    <?php
                        if(isset($_SESSION['korisnik'])){
                            // var_dump($_SESSION['korisnik']);
                            $korisnik = $_SESSION['korisnik'];
                            if($korisnik->naziv_uloga == "admin" && $korisnik->id_uloga == 1):
                            ?>
                                <li class="scroll-to-section m-0 p-0">
                                    <a class='nav-link add-uppercase' href="index.php?page=admin-panel&adminPage=tabele">
                                        <i class="fa fa-user" aria-hidden="true"></i> ADMIN DASHBOARD
                                    </a>
                                </li>
                            <?php 
                            elseif($korisnik->naziv_uloga == "korisnik" && $korisnik->id_uloga == 2):?>   
                                <li class="scroll-to-section m-0 p-0">
                                    <a class='nav-link add-uppercase' href="index.php?page=korisnik&userPage=licni-podaci">
                                    <i class="fa fa-user" aria-hidden="true"></i> Moj profil
                                    </a>
                                </li>
                                
                                <!-- <li class="scroll-to-section m-0 p-0">
                                    <a class='nav-link add-uppercase' href="index.php?page=korpa">
                                       <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li> -->
                            <?php endif; ?>
                            <li class="scroll-to-section m-0 p-0">
                                <a class='nav-link add-uppercase' href="models/logout.php">
                                    <i class="fa fa-sign-out marginAdd" aria-hidden="true"></i>
                                </a>
                            </li>
                  <?php } ?>
                 
    </ul>        
    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
    <!-- ***** Menu End ***** -->
</nav>