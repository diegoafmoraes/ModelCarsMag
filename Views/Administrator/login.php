<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
        name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta
        name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <!-- <title>Matrix Admin Lite Free Versions Template by WrapPixel</title> -->
    <title>Login Dashboard - Model Car Racing</title>
    <!-- Favicon icon -->
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="<?= BASE_URL; ?>assets/administrator/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="<?= BASE_URL; ?>assets/administrator/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= BASE_URL; ?>assets/administrator/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->

    <!-- Content -->
    <main role="main">
        <!-- MAIN CONTENT -->
        <?php // self::loadViewInDashboard($viewName, $viewData); 
        ?>
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div
            class="
          auth-wrapper
          d-flex
          no-block
          justify-content-center
          align-items-center
          bg-dark
          py-5
        ">
            <div class="auth-box bg-dark border-top border-secondary">

                <div class="auth-box bg-dark border-top border-secondary">
                    <!-- ============================================================== -->
                    <!-- Logo Top -->
                    <!-- ============================================================== -->

                    <div id="loginformArea">
                        <div class="text-left pt-3 pb-3">
                            <span class="db">
                                <img src="<?= BASE_URL; ?>assets/imgs/logo.png" class="img-thumbnail my-3" style="width:200px;" alt="Model Car Racing Magazine Logo">
                            </span>
                        </div>
                        <div class="text-center pt-3 pb-3">
                            <span class="db">
                                <h2 class="text-light">Admin Panel</h2>
                            </span>
                        </div>
                        <!-- Form -->
                        <form class="form-horizontal mt-3" id="loginform" action="<?php echo BASE_ADM_URL . 'login/authenticate'; ?>" method="post">
                            <div class="row pb-4">
                                <div class="col-12">
                                    <!-- Alertas de Mensagens -->
                                    <div id="loginAlert" class="alert" style="display: none;"></div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="mdi mdi-account fs-4"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" placeholder="Admin" aria-label="Admin" aria-describedby="basic-addon1" name="admin" required="" value="Delmir" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="mdi mdi-lock fs-4"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required="" value="Xavasca" />
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top border-secondary">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="pt-3">
                                            <button class="btn btn-info" id="to-recover" type="button">
                                                <i class="mdi mdi-lock fs-4 me-1"></i> Lost password?
                                            </button>
                                            <button class="btn btn-success float-end text-white" type="submit">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="recoverform" style="visibility: hidden;">
                        <div class="text-center">
                            <span class="text-white">Enter your e-mail address below and we will send you
                                instructions how to recover a password.</span>
                        </div>
                        <div class="row mt-3">
                            <!-- Form -->
                            <form class="col-12" action="index.html">
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text bg-danger text-white h-100"
                                            id="basic-addon1"><i class="mdi mdi-email fs-4"></i></span>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control form-control-lg"
                                        placeholder="Email Address"
                                        aria-label="Admin"
                                        aria-describedby="basic-addon1" />
                                </div>
                                <!-- pwd -->
                                <div class="row mt-3 pt-3 border-top border-secondary">
                                    <div class="col-12">
                                        <a
                                            class="btn btn-success text-white"
                                            href="#"
                                            id="to-login"
                                            name="action">Back To Login</a>
                                        <button
                                            class="btn btn-info float-end"
                                            type="button"
                                            name="action">
                                            Recover
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Login box.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper scss in scafholding.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper scss in scafholding.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- MAIN CONTENT -->
    </main>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= BASE_URL; ?>assets/administrator/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= BASE_URL; ?>assets/administrator/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?= BASE_URL; ?>assets/administrator/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= BASE_URL; ?>assets/administrator/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= BASE_URL; ?>assets/administrator/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot/excanvas.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot/jquery.flot.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot/jquery.flot.pie.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot/jquery.flot.time.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot/jquery.flot.stack.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/administrator/js/pages/chart/chart-page-init.js"></script>
    <script>
        // Login functions
        $(document).ready(function() {
            $('#loginform').on('submit', function(event) {
                event.preventDefault(); // Previne o recarregamento da página

                var formData = new FormData(this); // 'this' refere-se ao formulário que está disparando o evento submit

                // Envio AJAX com jQuery
                $.ajax({
                    url: '<?= BASE_ADM_URL; ?>login/authenticate',
                    type: 'POST',
                    data: formData,
                    processData: false, // Não processa os dados
                    contentType: false, // Não define um tipo de conteúdo específico
                    success: function(data) {
                        var alertDiv = $('#loginAlert');

                        if (data.success) {
                            alertDiv.removeClass('alert-danger').addClass('alert alert-success').text('Login successful!').show();

                            // Redireciona para o dashboard
                            setTimeout(function() {
                                window.location.href = data.redirect;
                            }, 1500); // Atraso de 1,5 segundos para exibir a mensagem
                        } else {
                            alertDiv.removeClass('alert-success').addClass('alert alert-danger').text(data.message || 'Login failed!').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>