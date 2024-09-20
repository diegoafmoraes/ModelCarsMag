<!doctype html>
<html lang="pt-br">

<head>
  <!-- META TAGS -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="keywords" content="<?= self::prepareMetadata( \Components\Menu\MenuComponent::activePage())->keywords; ?>">
  <meta name="description" content="<?= self::prepareMetadata( \Components\Menu\MenuComponent::activePage())->description; ?>">
  <meta name="author" content="">

  <link rel="icon" href="<?= BASE_URL; ?>favicon.png">
  <!-- TITLE -->
  <title><?= $this->viewTitle($tit) ?></title>

  <!-- Principal CSS do Bootstrap -->
  <link href="<?= BASE_URL; ?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables -->
  <link href="<?= BASE_URL; ?>assets/css/dataTables/datatables.min.css" rel="stylesheet">
  <!-- SWAL -->
  <link href="<?= BASE_URL; ?>assets/css/swal/sweetalert2.min.css" rel="stylesheet">
  <!-- Personal Styles -->
  <link href="<?= BASE_URL; ?>assets/css/personal/style.css" rel="stylesheet">
  <!-- OLW CAROUSEL -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <!-- FONTES -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="<?= BASE_URL; ?>assets/fonts/?family=Volkolak:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>

<body id="page-top">

  <!--  ================================================================================================== -->
  <!-- Navigation bar -->
  <section role="main" class="bg-petroleum text-center pt-5 pb-5 mb-5" id="main">
    <a href="<?= BASE_URL; ?>">
      <img src="<?= BASE_URL; ?>assets/imgs/logo.png" class="img-fluid" width="300px" alt="Model Car Racing">
    </a>
  </section>

  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#"></a>
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sandwich_btn" aria-controls="sandwich_btn" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="effect"></div>

      <div class="collapse navbar-collapse navbar-custom jump-over" id="sandwich_btn">
        <ul class="navbar-nav" role="menu">
          <!-- Menu -->
          <?php foreach (\Components\Menu\MenuComponent::showMenuFromDB() as $key => $val): ?>
            <li class="nav-item ml-0 font-weight-bold">
              <a
                class="nav-link <?= \Components\Menu\MenuComponent::activePage() == $val->slug ? 'text-dark' : 'text-white'; ?>"
                href="<?php
                      echo in_array($val->slug, \Components\Menu\MenuComponent::exceptPages())
                        ? \Components\Menu\MenuComponent::absPages($val->slug)
                        : BASE_URL . $val->slug;
                      ?>"
                <?php
                echo in_array($val->slug, \Components\Menu\MenuComponent::exceptPages())
                  ? "target='_blank'"
                  : "";
                ?>>
                <?= $val->menu_item; ?>
              </a>
            </li>
          <?php endforeach; ?>
          <!-- / Menu -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <main role="main">
    <!-- MAIN CONTENT -->
    <?php self::loadViewInTemplate($viewName, $viewData); ?>
    <!-- MAIN CONTENT -->
  </main>

  <!--  ================================================================================================== -->

  <!-- Bootstrap JavaScript
  ================================================== -->
  <!-- Foi colocado no final para a página carregar mais rápido -->
  <!--   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script> -->
  <script src="<?= BASE_URL; ?>assets/js/jquery/jquery_3.7.1_min.js"></script>
  <script src="<?= BASE_URL; ?>assets/js/bootstrap/bootstrap.min.js"></script>
  <script src="<?= BASE_URL; ?>assets/js/dataTables/datatables.min.js"></script>
  <script src="<?= BASE_URL; ?>assets/js/swal/sweetalert2.all.min.js"></script>
  <script src="<?= BASE_URL; ?>assets/js/jquery/jquery.maskMoney.min.js" type="text/javascript"></script>
  <script src="<?= BASE_URL; ?>assets/js/jquery/jquery.mask.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script src="<?= BASE_URL; ?>assets/js/scripts.js" type="text/javascript"></script>

</body>

</html>