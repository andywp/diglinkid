<?php defined('ALTUMCODE') || die() ?>
<!DOCTYPE html>
<html lang="<?= $this->language->language_code ?>">
    <head>
        <title><?= \Altum\Title::get() ?></title>
        <base href="<?= SITE_URL; ?>">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php if(!empty($this->settings->favicon)): ?>
            <link href="<?= url(UPLOADS_URL_PATH . 'favicon/' . $this->settings->favicon) ?>" rel="shortcut icon" />
        <?php endif ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="<?= url(ASSETS_URL_PATH . 'css/bootstrap.min.css') ?>" rel="stylesheet">
        
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
		<?php
			if(\Altum\Routing\Router::$controller == 'Register'){
		?>
			<!-- Google Tag Manager -->
                <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-5RW2XTR');</script> -->
			<!-- End Google Tag Manager -->


		<?php
				
			}
		
		?>
		
		
		
    </head>

    <body class="<?= \Altum\Routing\Router::$controller_settings['body_white'] ? 'bg-white' : null ?> ">
		<?php
			if(\Altum\Routing\Router::$controller == 'Register'){
		?>
		
			<!-- Google Tag Manager (noscript) -->
			<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RW2XTR"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
			<!-- End Google Tag Manager (noscript) -->
		
		<?php
				
			}
		
		?>

        <div class="content-wrapper">
            <?php require THEME_PATH . 'views/layout/header.php' ?>
            <?= $this->views['content'] ?>
        </div>

        <!-- <?php if(\Altum\Routing\Router::$controller_key != 'index'): ?>
            <?php require THEME_PATH . 'views/partials/ads_footer.php' ?>
        <?php endif ?> -->

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
