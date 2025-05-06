 <!-- ***** Footer Start ***** -->
 <footer>
        <div class="row  m-0 p-0">
            <div class="col-lg-12 col-md-6 d-flex justify-content-around flex-wrap">
                <div class="col-lg-3">
                    <h4>Korisni linkovi</h4>
                    <ul>
                        <li><a href='#' data-target="#exampleModalCenter" data-toggle='modal' >Autor</a></li>
                        <li><a href="dokumentacija.pdf" target='_blank'>Dokumentacija</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Kontakt podaci</h4>
                    <ul>
                        <li><a href="mailto:nspire@yahoo.com">E-mail: nspire&#64;yahoo&#46;com</a></li>
                        <li><a href="tel:011-020-0340">Telefon: 011-020-0340</a></li>
                        <li><a href="https://goo.gl/maps/9iP3xUP4o6vLrVEi8" target="_blank">Lokacija: Bulevar Mihajla Pupina 4, Beograd 11070</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="col-lg-12">
                <div class="under-footer">
                    <p>Copyright © 2022 Nspire</p>
                </div>
            </div>
    </footer>
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Autor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
          <img src="assets/images/close2.png" alt="close" />
        </button>
      </div>
      <div class="modal-body">
          
        <div class="row">
        <div class="slika-autor col-6">
            <img src="assets/images/autor.jpg" class='img-fluid' alt="autor" />
        </div>
        <div class="col-6">
            <p class='podatak naziv mb-2'>Jovana Paunović</p>
            <p class='podatak mb-2'>94/19</p>
            <p class='podatak mb-2'>Praktikum iz web programiranja PHP</p>
            <p class='podatak'>Internet tehnologije</p>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Preuzmi podatke o autoru</button> -->
        <!-- <form action="models/download.php" method='POST'>
            <input type='submit' class='main-border-button2' value='Preuzmi podatke o autoru' />
        </form> -->
        <a href="#" id='upisiPodatkeBtn' class="main-border-button2">Upiši podatke o autoru u word dokument </a>
        <!-- <a href="data/autor.docx" target="_blank" id='' class="main-border-button2">Pogledaj word dokument</a> -->
      </div>
    </div>
  </div>
</div>