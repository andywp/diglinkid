<?php defined('ALTUMCODE') || die() ?>
<!DOCTYPE html>
<html lang="<?= $this->language->language_code ?>">

<head>
    <title><?= \Altum\Title::get() ?></title>
    <base href="<?= SITE_URL; ?>">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if (!empty($this->settings->favicon)) : ?>
        <link href="<?= url(UPLOADS_URL_PATH . 'favicon/' . $this->settings->favicon) ?>" rel="shortcut icon" />
    <?php endif ?>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <?php foreach (['bootstrap.min.css', 'custom.css', 'link-custom.css', 'animate.min.css','wa.css'] as $file) : ?>
        <link href="<?= url(ASSETS_URL_PATH . 'css/' . $file . '?v=' . PRODUCT_CODE) ?>" rel="stylesheet" media="screen,print">
    <?php endforeach ?>
    <?= \Altum\Event::get_content('head') ?>
    <?php if (!empty($this->settings->custom->head_js)) : ?>
        <?= $this->settings->custom->head_js ?>
    <?php endif ?>
    <?php if (!empty($this->settings->custom->head_css)) : ?>
        <style>
            <?= $this->settings->custom->head_css ?>
        </style>
    <?php endif ?>
</head>

<body class="<?= \Altum\Routing\Router::$controller_settings['body_white'] ? 'bg-white' : null ?>">
    <main class="animated fadeIn">
        <?= $this->views['content'] ?>

    </main>


    <?php foreach (['libraries/jquery.min.js', 'libraries/popper.min.js', 'libraries/bootstrap.min.js','bootstrap-validate.js', 'main.js', 'functions.js', 'libraries/fontawesome.min.js', 'clipboard.min.js'] as $file) : ?>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>js/<?= $file ?>?v=<?= PRODUCT_CODE ?>"></script>
    <?php endforeach ?>

    <?= \Altum\Event::get_content('javascript') ?>
	
    <script type="text/javascript">
        var ajaxURL = "<?= SITE_URL ?>";

        jQuery(document).ready(function($) {
			$( "#formwhatsapp" ).submit(function( event ) {
				var data=$('#formwhatsapp').serializeArray()
				//console.log(data,'datri form');
				
				var varlink='';
				var wa='';
				$.each(data, function( index, value ) {
				  //console.log( index + ": " + value.name );
				  if(value.name !='wa'){
					varlink+=encodeURI(value.name)+' : '+encodeURI(value.value)+' %0A';
				  }else{
					 wa+= value.value;
				  }
				  
				});
				
				var apiurl='https://wa.me/'+wa+'?text='+varlink;
				//console.log(apiurl,'url');
				window.location.href = apiurl;
			  return false;
			});
        });
		
    </script>
</body>

</html>