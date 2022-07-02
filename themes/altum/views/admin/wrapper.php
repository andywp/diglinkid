<?php defined('ALTUMCODE') || die() ?>
<!DOCTYPE html>
<html class="admin semi-dark" lang="<?= $this->language->language_code ?>">
    <head>
        <title><?= \Altum\Title::get() ?></title>
        <base href="<?= SITE_URL; ?>">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="<?= SITE_URL . ASSETS_URL_PATH ?>images/favicon.png" type="image/png" />

        <!--plugins-->
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/custom.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/bootstrap-extended.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/style.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>css/custom2.css" rel="stylesheet" />

        <!-- loader-->
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/pace.min.css" rel="stylesheet" />

        <!--Theme Styles-->
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/dark-theme.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/light-theme.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/semi-dark.css" rel="stylesheet" />
        <link href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/header-colors.css" rel="stylesheet" />

        <link rel="stylesheet" href="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/css/toastr.css" as="style" onload="this.rel='stylesheet'">

        <?= \Altum\Event::get_content('head') ?>
    </head>

    <body class="admin">

    <div class="wrapper">
        <?= $this->views['header'] ?>
        <?= $this->views['sidebar'] ?>
        <main class="page-content">
            <?= $this->views['content'] ?>
        </main>
        <?= $this->views['footer'] ?>
    </div>

    <input type="hidden" id="url" name="url" value="<?= url() ?>" />
    <input type="hidden" name="global_token" value="<?= \Altum\Middlewares\Csrf::get('global_token') ?>" />
    <input type="hidden" name="number_decimal_point" value="<?= $this->language->global->number->decimal_point ?>" />
    <input type="hidden" name="number_thousands_separator" value="<?= $this->language->global->number->thousands_separator ?>" />
    
    <!-- Bootstrap bundle JS -->
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/jquery.min.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/pace.min.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/chartjs/js/Chart.min.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/toastr.min.js"></script>

    <!--app-->
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/app.js"></script>
    <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/index.js"></script>
    
    <?php foreach(['libraries/popper.min.js', 'libraries/bootstrap.min.js', 'main.js', 'functions.js', 'libraries/fontawesome.min.js'] as $file): ?>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>js/<?= $file ?>?v=<?= PRODUCT_CODE ?>"></script>
    <?php endforeach ?>

    <?php if(\Altum\Routing\Router::$controller_key == 'index'): ?>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>onedash/js/table-datatable.js"></script>

    <?php endif ?>

    <?= \Altum\Event::get_content('javascript') ?>
    
    <script>
        $(document).ready(function() {
            $('#payment-table').DataTable();
            $('#latest-users-table').DataTable();
        } );
    </script>
    
    </body>
</html>
