<?php defined('ALTUMCODE') || die() ?>
<!DOCTYPE html>
<html lang="<?= $this->language->language_code ?>">
    <head>
        <title><?= \Altum\Title::get() ?></title>
        <base href="<?= SITE_URL; ?>">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        
        <?php foreach(['bootstrap.min.css', 'custom.css', 'link-custom.css', 'animate.min.css'] as $file): ?>
            <link href="<?= url(ASSETS_URL_PATH . 'css/' . $file . '?v=' . PRODUCT_CODE) ?>" rel="stylesheet" media="screen">
        <?php endforeach ?>
        
        <?php if(!empty($this->settings->favicon)): ?>
            <link href="<?= url(UPLOADS_URL_PATH . 'favicon/' . $this->settings->favicon) ?>" rel="shortcut icon" />
        <?php endif ?>

        <link href="<?= url(ASSETS_URL_PATH . 'css/plugins_.css') ?>" rel="stylesheet">
        <link href="<?= url(ASSETS_URL_PATH . 'css/style_.css') ?>" rel="stylesheet">
        <link href="<?= url(ASSETS_URL_PATH . 'fonts/dm.css' . $file) ?>" as="style"  onload="this.rel='stylesheet'">
        <link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet">


        <?= \Altum\Event::get_content('head') ?>

        <?php if(!empty($this->settings->custom->head_js)): ?>
            <?= $this->settings->custom->head_js ?>
        <?php endif ?>

        <?php if(!empty($this->settings->custom->head_css)): ?>
            <style><?= $this->settings->custom->head_css ?></style>
        <?php endif ?>
     
        <style>
            .text-diglink {
                color:#2b2e83;
            }
            .text-diglink:hover {
                color:#5860a8;
            }
            .description-box {
                max-height: 200px;
                margin-top: 10px;
                margin-bottom: 40px;
            }
            .view-more-parent {
                position: relative;
                overflow: hidden;
            }
            .view-more-parent.expanded {
                max-height: none;
                overflow: visible;
            }
            .view-more {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background: linear-gradient(hsla(0,0%,100%,0),hsla(0,0%,100%,.95),#fff);
                display: block;
                padding: 30px 3px 3px 3px;
                color: #007791;
                cursor: pointer;
                z-index: 5;
            }
            .popular .view-more {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background: rgba(48,44,127,0.95);
                display: block;
                padding: 3px 3px 3px 3px;
                color: #007791;
                cursor: pointer;
                z-index: 5;
            }
            .view-less {
                position: absolute;
                bottom: -40px;
                left: 0;
                width: 100%;
                display: block;
                padding: 3px 3px 3px 3px;
                color: #007791;
                cursor: pointer;
            }
        </style>
    </head>

    <body>

        <div class="content-wrapper">
            <?php require THEME_PATH . 'views/layout/header.php' ?>
            <?= $this->views['content'] ?>
        </div>

        <?php if(\Altum\Routing\Router::$controller_key != 'index'): ?>
            <?php require THEME_PATH . 'views/partials/ads_footer.php' ?>
        <?php endif ?>

        <?php require THEME_PATH . 'views/layout/footer.php' ?>

        <?= \Altum\Event::get_content('modals') ?>

        <input type="hidden" id="url" name="url" value="<?= url() ?>" />
        <input type="hidden" name="global_token" value="<?= \Altum\Middlewares\Csrf::get('global_token') ?>" />
        <input type="hidden" name="number_decimal_point" value="<?= $this->language->global->number->decimal_point ?>" />
        <input type="hidden" name="number_thousands_separator" value="<?= $this->language->global->number->thousands_separator ?>" />
        
        <?php foreach(['libraries/jquery.min.js', 'libraries/popper.min.js', 'libraries/bootstrap.min.js', 'main.js', 'functions.js', 'libraries/fontawesome.min.js', 'libraries/clipboard.min.js'] as $file): ?>
            <script src="<?= SITE_URL . ASSETS_URL_PATH ?>js/<?= $file ?>?v=<?= PRODUCT_CODE ?>"></script>
        <?php endforeach ?>

        <?= \Altum\Event::get_content('javascript') ?>
        
    </body>
</html>
