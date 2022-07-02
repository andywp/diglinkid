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

    <?php foreach (['bootstrap.min.css', 'custom.css', 'link-custom.css', 'animate.min.css'] as $file) : ?>
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


    <input type="hidden" id="url" name="url" value="<?= url() ?>" />
    <input type="hidden" name="global_token" value="<?= \Altum\Middlewares\Csrf::get('global_token') ?>" />
    <input type="hidden" name="number_decimal_point" value="<?= $this->language->global->number->decimal_point ?>" />
    <input type="hidden" name="number_thousands_separator" value="<?= $this->language->global->number->thousands_separator ?>" />

    <?php foreach (['libraries/jquery.min.js', 'libraries/popper.min.js', 'libraries/bootstrap.min.js', 'main.js', 'functions.js', 'libraries/fontawesome.min.js', 'libraries/clipboard.min.js'] as $file) : ?>
        <script src="<?= SITE_URL . ASSETS_URL_PATH ?>js/<?= $file ?>?v=<?= PRODUCT_CODE ?>"></script>
    <?php endforeach ?>

    <?= \Altum\Event::get_content('javascript') ?>
	
	
	<?php
		global $config;
		
	?>
	
	
	<script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js"  data-environment="<?= $config['mode'] ?>" 
	data-client-key="<?= $config['client_key'] ?>"></script>
	<script>
		// data kartu dari input customer, contohnya
		/* var cardData = {
		  "card_number": 4811111111111114,
		  "card_exp_month": 02,
		  "card_exp_year": 2025,
		  "card_cvv": 123,
		}; */

		// callback functions
		/* var options = {
		  onSuccess: function(response){
			// Sukses mendapatkan token_id kartu, implementasi sesuai kebutuhan
			console.log('Success to get card token_id, response:', response);
			var token_id = response.token_id;
			console.log('This is the card token_id:', token_id);
		  },
		  onFailure: function(response){
			// Gagal mendapatkan token_id kartu, implementasi sesuai kebutuhan
			console.log('Fail to get card token_id, response:', response);
		  }
		};

		// panggil function `getCardToken`
		MidtransNew3ds.getCardToken(cardData, options);
	 */
	
	</script>
	
	
	
	
	
	
    <script type="text/javascript">
        var ajaxURL = "<?= SITE_URL ?>";

        jQuery(document).ready(function($) {

            $("#cekPembayaran").click(function() {
                var xajaxFile = ajaxURL + "payment/cekpay";
                var dataId = $(this).attr("data-id");
                $.ajax({
                    type: 'POST',
                    url: xajaxFile,
                    data: {val:dataId},
                    dataType: 'json',
                    success: function(data) {

                        if (!data.error) {
                            $(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
							$("#barcode").remove();
							$("#cekPembayaran").attr('disabled');
							window.setTimeout(function(){
								window.location.href = ajaxURL+'invoice/'+data.id
							}, 2000); 
                        } else {
                           
                            $(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
                        }
                        $('.contact-progress').hide();
                    }
                });
                return false;
            });

			setTimeout(cekpay,60*15*1000);



		$("#creditcard").submit(function(){
			var xajaxFile = ajaxURL + "payment/chackout";
			$('.msg-alert').html('');
			var cardnumber 	= $("#cardnumber"). val();
			var expiredate 	= $("#expiredate"). val();
			var cvv		 	= $("#cvv"). val();
			
			var transaksi	=$("#transaksi").val();
			var amount		=$("#amount").val();
			
			
			
			var data=expiredate.split("/",2);
			/* var card_exp_year=expiredate.split("/",2); */
			
			var cardData = {
			  "card_number": cardnumber,
			  "card_exp_month": data[0],
			  "card_exp_year": data[1],
			  "card_cvv": cvv,
			};
				
			//console.log(cardData);
			
			var options = {
			  onSuccess: function(response){
				console.log('Success to get card token_id, response:', response);
				var token_id = response.token_id;
					$.ajax({
						type: 'POST',
						url: xajaxFile,
						data: {transaksi:transaksi,amount:amount,token:token_id},
						dataType: 'json',
						success: function(data) {
							if (!data.error) {
								$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
								window.setTimeout(function(){
									window.location.href = data.url
								}, 1000); 
							} else {
							   
								$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
							}
						}
					});
				
			
					
			  },
			  onFailure: function(response){
					
					$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> ' + response.status_message + "</div>");
				
				
				
			  }
			};

			// panggil function `getCardToken`
			MidtransNew3ds.getCardToken(cardData, options);
			
			
			
			
			/* $.ajax({
				type: 'POST',
				url: xajaxFile,
				data: $("#creditcard").serialize(),
				dataType: 'json',
				success: function(data){
					
					if(!data.error){
						
						$(":input","#creditcard")
						.not(":button, :submit, :reset, :hidden")
						.val("")
						.removeAttr("checked")
						.removeAttr("selected");
						grecaptcha.reset();
						$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
					}
					else{
						grecaptcha.reset();
						$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
					}
					$('.contact-progress').hide();
				}
			}); */
			return false;
	});

















        });
		
		var cekpay=function(){
			var xajaxFile = ajaxURL + "payment/cekpay";
			$.ajax({
			type: 'POST',
			url: xajaxFile,
			data: {val:datatrans},
			dataType: 'json',
			success: function(data){
					if (!data.error) {
						$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
						$("#barcode").remove();
						$("#cekPembayaran").attr('disabled');
						window.setTimeout(function(){
							window.location.href = ajaxURL+'invoice/'+data.id
						}, 2000); 
					} else {
					   
						$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
					}
								//$('.contact-progress').hide();
					}
                });
			
			
			
			
		}
		
		var refInterval = window.setInterval('cekpay()', 60 * 15* 10000);
		
    </script>
</body>

</html>