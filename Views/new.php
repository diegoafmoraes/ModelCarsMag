<!-- Header Image -->
<section class="main-section">
    <div class="header-image" id="cover_lil_car">
        <!--     <img src="<?= BASE_URL; ?>assets/imgs/cover_lil_car.png" class="img-fluid" alt="Model Car Racing"> -->

        <div class="container-fluid mt-5">

            <section class="container text-section">

                <div class="container mt-5">
                    <div class="owl-carousel">
                        <?php foreach ($carouselCovers as $mag): ?>
                            <div class="item">
                                <img src="<?= BASE_URL; ?>assets/images/magazine-covers/<?= $mag->cover; ?>" class="img-fluid small-issue" alt="Edição Passada">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </section>

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

<script>
    // element.addEventListener('touchstart', handler, { passive: true });
</script>