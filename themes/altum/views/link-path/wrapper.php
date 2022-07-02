<?php defined('ALTUMCODE') || die() ;
$id=$this->params[0];

$data=$this->database->query("SELECT settings,user_id FROM links where url='".$id."'");
$links=$data->fetch_object();
$paketData=$this->database->query("select package_expiration_date from users where user_id='".$links->user_id."'");
$paket=$paketData->fetch_object();

$today = date("Y-m-d H:i:s");  
//$today = '2020-09-17 17:37:03';  
$today=strtotime($today);
$paketa=strtotime($paket->package_expiration_date);

if($paketa > $today ){
	$aktive=1;
}else{
	$aktive=0;
}



$links=json_decode($links->settings);
/* echo '<pre>';
print_r($links);
echo '</pre>'; */
?>
<!DOCTYPE html>
<html lang="<?= $this->language->language_code ?>" class="link-html ">
    <head>

        <title><?= \Altum\Title::get() ?></title>
        <base href="<?= SITE_URL; ?>">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php if(!empty($this->settings->favicon)): ?>
            <link href="<?= url(UPLOADS_URL_PATH . 'favicon/' . $this->settings->favicon) ?>" rel="shortcut icon" />
        <?php endif ?>

        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

        <?php foreach(['bootstrap.min.css', 'custom.css', 'link-custom.css', 'animate.min.css','icodiglink.css'] as $file): ?>
            <link href="<?= url(ASSETS_URL_PATH . 'css/' . $file . '?v=' . PRODUCT_CODE) ?>" rel="stylesheet" media="screen">
        <?php endforeach ?>

        <?= \Altum\Event::get_content('head') ?>

        <?php if(!empty($this->settings->head_js)): ?>
            <?= $this->settings->head_js ?>
        <?php endif ?>
        <link rel="canonical" href="<?= @$this->link->full_url ?>" />
		<?php if($aktive == 1){ ?>
		<?php if(isset($links->google_tag_manager)){ 
				if($links->google_tag_manager !=''){
		?>
			<!-- Google Tag Manager aa-->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','<?= $links->google_tag_manager ?>');</script>
			<!-- End Google Tag Manager -->
		
		<?php } }?>
		<?php } ?>
		
		
    </head>

    <?= isset($this->views['content'])?$this->views['content']:''; ?>

    <input type="hidden" id="url" name="url" value="<?= url() ?>" />
    <input type="hidden" name="global_token" value="<?= \Altum\Middlewares\Csrf::get('global_token') ?>" />
    <input type="hidden" name="number_decimal_point" value="<?= $this->language->global->number->decimal_point ?>" />
    <input type="hidden" name="number_thousands_separator" value="<?= $this->language->global->number->thousands_separator ?>" />

    <?php foreach(['libraries/jquery.min.js', 'libraries/popper.min.js', 'libraries/bootstrap.min.js', 'main.js', 'functions.js', 'libraries/fontawesome.min.js'] as $file): ?>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>js/<?= $file ?>?v=<?= PRODUCT_CODE ?>"></script>
    <?php endforeach ?>

    <?= \Altum\Event::get_content('javascript') ?>
</html>
