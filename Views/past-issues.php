<!-- Header Image -->
<section class="main-section">
    <div class="header-image" id="cover_lil_car">
        <!--     <img src="<?= BASE_URL; ?>assets/imgs/cover_lil_car.png" class="img-fluid" alt="Model Car Racing"> -->

        <div class="container mt-5">
            <div class="row">
                <!-- Repetir esse bloco para cada imagem -->
                <?php foreach ($magCovers as $mag): ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="thumbnail">
                            <img src="<?= BASE_URL . 'assets/images/magazine-covers/' . $mag->cover; ?>" class="img-fluid" alt="Thumbnail">
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Fim do bloco -->
            </div>
        </div>

        <!-- Banner Advertising Space (agora sobrepostos à imagem do carro) -->
        <div class="container text-center banner-container-rel">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="banner red">Banner Advertising Space<br>70 x 450 px</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="banner yellow">Banner Advertising Space<br>70 x 450 px</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="banner green">Banner Advertising Space<br>70 x 450 px</div>
                </div>
            </div>
        </div>
    </div>

</section>