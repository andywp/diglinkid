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
			
			$("#phone").on("keyup", function() {
				$("#contact").html($("#phone-code").val() + $(this).val());
			});
			$("#pesan").on("keyup", function() {
				var val = $(this).val();
					val = val.replace(/</g, '&lt;');
					val = val.replace(/>/g, '&gt;');
					val = val.replace(/\n/g, '<br>');
					val = val.replace(/\*([a-zA-Z0-9]+)\*/g, '<b>$1</b>');
					val = val.replace(/\~([a-zA-Z0-9]+)\~/g, '<s>$1</s>');
					val = val.replace(/\_([a-zA-Z0-9]+)\_/g, '<i>$1</i>');
					val = val.replace(/([a-zA-Z0-9]+)\.([a-zA-Z0-9]+)/g, '<a href="http://$1.$2">$1.$2</a>');
				
				
				$("#message").html(val);
			});
			
			bootstrapValidate('#phone', 'min:10:Minimal 10 Digit!');
			bootstrapValidate('#phone', 'max:12:Max 12 Digit!');
			bootstrapValidate('#phone', 'numeric:Please only enter numeric characters!');
			
			/*ajax*/

			$("#generatorWa").submit(function(){
				var xajaxFile = ajaxURL+"wa-generator/create";
				$('.msg-alert').html('');
				$.ajax({
					type: 'POST',
					url: xajaxFile,
					data: $("#generatorWa").serialize(),
					dataType: 'json',
					success: function(data){
						if(!data.error){
							$(":input","#generatorWa")
							.not(":button, :submit, :reset, :hidden")
							.val("")
							.removeAttr("checked")
							.removeAttr("selected");
							$('#secID').html('');
							$('#result-link').val(data.url);
							$('.result').show();
							
							$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
						}
						else{
							$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
						}
					}
				});
				return false;
			});
					
			new Clipboard('#btnCopy');
			
			
			
        });
		function intOnly(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		  return true;
		} 


    </script>
</body>

</html>