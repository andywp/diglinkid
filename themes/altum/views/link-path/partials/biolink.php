<?php defined('ALTUMCODE') || die()?>
<?php ob_start() ?>
<?php
$today = date("Y-m-d H:i:s");  
//$today = '2020-09-17 17:37:03';  
$today=strtotime($today);
$paket=strtotime($user->package_expiration_date);

if($paket > $today ){
	$aktive=1;
}else{
	$aktive=0;
}
/* echo '<pre>';
print_r($link);
echo '</pre>'; */ 
?> 
<style>
	body{
		<?= @$link->design->background_style ?>
		<?= @$link->design->color ?>
	}


</style>


<?php if($link->settings->background_type == 'image'){ ?>
<style>
	body,link-body{
		<?= ($aktive == 1)?$link->design->background_style:''; ?>
	}
	<?php if(@$link->settings->background_mobile !=''){ ?>
	@media(max-width:768px){
		body,link-body{
			background: url(<?= SITE_URL.'uploads/backgrounds/'.$link->settings->background_mobile ?>) !important;
		}
	}
	<?php } ?>
</style>
<?php } ?>

<body class="link-body <?= $link->design->background_class ?>">
	<?php if($aktive == 1){ ?>
		<?php 
			if(isset($link->settings->google_tag_manager)){ 
				if($link->settings->google_tag_manager !=''){ ?>
		
			<!-- Google Tag Manager (noscript) -->
			<noscript>
				<iframe src="https://www.googletagmanager.com/ns.html?id=<?= $link->settings->google_tag_manager  ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe>
			</noscript>
	<!-- End Google Tag Manager (noscript) -->
		
		<?php 
				}
			} 
		?>
	<?php } ?>

    <div class="container animated fadeIn">
        <div class="row d-flex justify-content-center text-center">
            <div class="col-md-8 link-content">

                <header class="d-flex flex-column align-items-center" style="<?= $link->design->text_style ?>">

                    <?php if(!empty($link->settings->image) && file_exists(UPLOADS_PATH . 'avatars/' . $link->settings->image)): ?>
                        <img id="image" src="<?= url(UPLOADS_URL_PATH . 'avatars/' . $link->settings->image) ?>" alt="<?= \Altum\Language::get()->link->biolink->image_alt ?>" class="link-image" />
                    <?php endif ?>

                    <div class="d-flex flex-row align-items-center mt-4">
                        <h1 id="title"><?= $link->settings->title ?></h1>

                        <?php if($user->package_settings->verified): ?>
                        <span data-toggle="tooltip" title="<?= \Altum\Language::get()->global->verified ?>" class="link-verified ml-1"><i class="fa fa-check-circle fa-1x"></i></span>
                        <?php endif ?>
                    </div>

                    <p id="description"><?= $link->settings->description ?></p>
                </header>

                <main id="links" class="mt-4">

                    <?php if($links_result): ?>
                        <?php while($row = $links_result->fetch_object()): ?>

                            <?php

                            /* Check if its a scheduled link and we should show it or not */
                            if(!empty($row->start_date) && !empty($row->end_date) && (new \DateTime() < new \DateTime($row->start_date) || new \DateTime() > new \DateTime($row->end_date))) {
                                continue;
                            }

                            ?>

                            <div data-link-id="<?= $row->link_id ?>">
                                <?= \Altum\Link::get_biolink_link($row, $user)->html ?? null ?>
                            </div>

                        <?php endwhile ?>
                    <?php endif ?>
                </main>

                <footer class="link-footer">
					
                    <?php if($link->settings->display_branding): ?>
                        <?php if(isset($link->settings->branding, $link->settings->branding->name, $link->settings->branding->url) && !empty($link->settings->branding->name)): ?>
                            <a id="branding" href="<?= !empty($link->settings->branding->url) ? $link->settings->branding->url : '#' ?>" style="<?= $link->design->text_style ?>"><?= $link->settings->branding->name ?></a>
                        <?php else: ?>
                            <a id="branding" href="<?= url() ?>" style="<?= $link->design->text_style ?>"><?= \Altum\Language::get()->link->branding ?></a>
                        <?php endif ?>
                    <?php endif ?>
					
					<!--<form action="" method="post" class="subscribe mt-t" autocomplete="off">
						<div class="msg-alert-subscribe"></div>
						<div id="groube" class="input-group">
							<input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
							<input type="hidden" name="biolink" value="<?= $link->link_id ?>" />
							 <input type="email" name="email" class="form-control" placeholder="Enter your email for subscribe" autocomplete="off" required>
							 <span class="input-group-btn">
							 <button class="btn btn-default" type="submit"><i class="fas fa-paper-plane"></i></button>
							 </span>
							  </div>
						</div>
					</form> -->
					<?php if(!empty($link->subscribe)){ ?>
					<div id="subscribeload">
						<?= htmlspecialchars_decode(html_entity_decode($link->subscribe))  ?>
					</div>
					<?php } ?>
                </footer>

            </div>
        </div>
    </div>
</body>
<!-- Modal -->
<div class="modal fade" id="formwhatsapp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<form method="POST" action="">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="disk"></div>
		<div class="loadform">
		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
      </div>
    </div>
	</form>
  </div>
</div>
<?php ob_start() ?>
<script>
    /* Internal tracking for biolink links */
    $('[data-location-url]').on('click', event => {

        let base_url = $('[name="url"]').val();
        let url = $(event.currentTarget).data('location-url');

        $.ajax(`${base_url}${url}?no_redirect`);
    });
	$('.formwhatsapp').click(function() {
		var id=$(this).data('id'); 
		var phone=$(this).data('phone'); 
		var param=$(this).data('param'); 
		var title=$(this).data('title');
		var ket=$(this).data('ket');
		//param=$.parseHTM(param);
		//param = param.replace(/(?:\r\n|\r|\n)/g, '<br>');
		//param=param.replace(new RegExp('\r?\n','g'), '<br />');
		$('#formwhatsapp h5').text(title);
		//$('#formwhatsapp form').attr('action','https://wa.me/?text=');
		
		ket = ket.replace(/\r\n/g, "<br />");
		//console.log(ket);
		$('#formwhatsapp .disk').html(ket);
		$('#formwhatsapp .loadform').html(param);
		
		$('#formwhatsapp').modal({show: true });
		return false;
	});
	$( "#formwhatsapp form" ).submit(function( event ) {
		var data=$('#formwhatsapp form').serializeArray()
		console.log(data,'datri form');
		
		var varlink='';
		var wa='';
		$.each(data, function( index, value ) {
		  //console.log( index + ": " + value.name );
		  if(value.name !='wa'){
			varlink+=encodeURI(removeTags(value.name))+':'+encodeURI(value.value)+'%0A';
		  }else{
			 wa+= value.value;
		  }
		  
		});
		//console.log(varlink,'ini');
		var apiurl='https://api.whatsapp.com/send?phone='+wa+'&text='+varlink;
		//console.log(apiurl,'url');
		window.location.href = apiurl;
	  return false;
	});
	
	function removeTags(str) {
		if ((str===null) || (str===''))
			return false;
		else
			str = str.toString();
			  
		// Regular expression to identify HTML tags in 
		// the input string. Replacing the identified 
		// HTML tag with a null string.
		return str.replace( /(<([^>]+)>)/ig, '');
	}
	function nl2br (str, replaceMode, isXhtml) {

		  var breakTag = (isXhtml) ? '<br />' : '<br>';
		  var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
		  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);

	}
</script>
<?php if($aktive == 1){ ?>

<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

<?php if($user->package_settings->google_analytics && !empty($link->settings->google_analytics)): ?>
    <?php ob_start() ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $link->settings->google_analytics ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= $link->settings->google_analytics ?>');
    </script>

    <?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<?php endif ?>

<?php if($user->package_settings->facebook_pixel && !empty($link->settings->facebook_pixel)): ?>
    <?php ob_start() ?>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?= $link->settings->facebook_pixel ?>');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= $link->settings->facebook_pixel ?>&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->

    <?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<?php endif ?>
<?php } ?>
<?php $html = ob_get_clean(); ?>

<?php return (object) ['html' => $html] ?>

