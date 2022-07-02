<?php defined('ALTUMCODE') || die() ?>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">  
    <div class="container pt-18 pb-16" style="z-index: 5; position:relative">  

            <?php display_notifications() ?>

            <h2 class="text-white"><?= sprintf($this->language->pay->header, $data->package->name) ?></h2>
            <div class="text-white mb-5"><?= $this->language->pay->subheader ?></div>


            <?php if($data->package_id == 'free'): ?>

                <?php if($this->user->package_id == 'free'): ?>

                <div class="alert alert-info" role="alert"><?= $this->language->pay->free->free_already ?></div>

                <div class="text-center mt-5">
                    <a href="<?= url('package') ?>" class="btn btn-primary"><?= $this->language->pay->free->choose_another_package ?></a>
                </div>

            <?php else: ?>

                <div class="alert alert-info" role="alert"><?= $this->language->pay->free->other_package_not_expired ?></div>

                <div class="text-center mt-5">
                    <a href="<?= url('package') ?>" class="btn btn-primary"><?= $this->language->pay->free->choose_another_package ?></a>
                </div>
            <?php endif ?>

            <?php elseif($data->package_id == 'trial'): ?>

            <?php if($this->user->package_trial_done): ?>

                <div class="alert alert-warning" role="alert"><?= $this->language->pay->trial->trial_done ?></div>

                <div class="text-center mt-5">
                    <a href="<?= url('package') ?>" class="btn btn-primary"><?= $this->language->pay->trial->choose_another_package ?></a>
                </div>

            <?php else: ?>

                <?php if($this->user->package_id != 'free' && !$this->user->package_is_expired): ?>

                <div class="alert alert-info" role="alert"><?= $this->language->pay->trial->other_package_not_expired ?></div>

            <?php endif ?>

                <form action="<?= 'pay/' . $data->package_id ?>" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />

                    <div class="text-center mt-5">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-stopwatch"></i> <?= $this->language->pay->trial->trial_start ?></button>
                    </div>

                </form>

            <?php endif ?>

            <?php else: ?>

            <?php
            /* Check for extra savings on the prices */
            $annual_price_savings = ceil(($data->package->monthly_price * 12) - $data->package->annual_price);?>

                <div class="margin-top-6 mb-5">
					<i class="fa fa-box-open mr-3"></i> 
					<span class="h5 text-white"><?= $this->language->pay->custom_package->payment_plan ?></span>
				</div>

                <form id="actionpay" action="<?= 'payment/'?>" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
					<input type="hidden" name="pageID" value="<?= $data->package_id ?>">
                    <div class="row d-flex align-items-stretch">
                        <label class="col-12 col-lg-6 custom-radio-box ">

                            <input type="radio" id="monthly_price" name="payment_plan" value="monthly" class="custom-control-input" required="required">

                            <div class="card card-shadow zoomer h-100">
                                <div class="card-body">

                                    <div class="card-title text-center text-black"><?= $this->language->pay->custom_package->monthly ?></div>

                                    <div class="mt-3 text-center text-black">
                                        <span class="custom-radio-box-main-text"><?= restyle_number($data->package->monthly_price) ?></span> <span><?= $this->settings->payment->currency ?></span><span class="custom-radio-box-main-text"> / </span>
                                        <span class="custom-radio-box-main-text"><?= $data->package->monthly_price_usd ?></span> <span>USD</span>
                                    </div>

                                </div>
                            </div>

                        </label>

                        <label class="col-12 col-lg-6 custom-radio-box">

                            <input type="radio" id="annual_price" name="payment_plan" value="annual" class="custom-control-input" required="required">

                            <div class="card card-shadow zoomer h-100">
                                <div class="card-body">

                                    <div class="card-title text-center text-black"><?= $this->language->pay->custom_package->annual ?></div>

                                    <div class="mt-3 text-center text-black">
                                        <span class="custom-radio-box-main-text"><?= restyle_number($data->package->annual_price) ?></span> <span><?= $this->settings->payment->currency ?></span>
										<span class="custom-radio-box-main-text"> / </span>
                                        <span class="custom-radio-box-main-text"><?= $data->package->annual_price_usd ?></span> <span>USD</span>
                                        <div class="text-black">
                                            <small><?= sprintf($this->language->pay->custom_package->annual_savings, $annual_price_savings, $this->settings->payment->currency) ?></small>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </label>
						
                    </div>

				<!--
                    <div class="margin-top-6 mb-5"><i class="fa fa-money-check-alt mr-3"></i> <span class="h5 text-muted"><?= $this->language->pay->custom_package->payment_processor ?></span></div>

                    <?php if(!$this->settings->paypal->is_enabled && !$this->settings->stripe->is_enabled): ?>
                        <div class="alert alert-info" role="alert">
                            <?= $this->language->pay->custom_package->no_processor ?>
                        </div>
                    <?php endif ?>
					
				-->
					<!-- payeman methoss -->
					<!--
					<div class="card payment-method">
						<div id="accordion">
							<div class="row">
								<div class="col-md-5 col-12">
									<div class="card-header collapsed" id="method2" data-toggle="collapse" data-target="#payMethod2" aria-expanded="true">
										<h5 class="mb-0 select-payment-method">
											<div class="btn-method" aria-expanded="false" aria-controls="payMethod2">
												Sesama Bank/Virtual Account
											</div>
										</h5>
									</div>
									<div class="card-header collapsed" id="method3" data-toggle="collapse" data-target="#payMethod3" aria-expanded="false">
										<h5 class="mb-0 select-payment-method">
											<div class="btn-method" aria-expanded="false" aria-controls="payMethod3">
												Gopay
											</div>
										</h5>
									</div>
									<div class="card-header collapsed" id="method4" data-toggle="collapse" data-target="#payMethod4" aria-expanded="false">
										<h5 class="mb-0 select-payment-method">
											<div class="btn-method" aria-expanded="false" aria-controls="payMethod4">
												Debit Card
											</div>
										</h5>
									</div>
									
									
								</div>
								<div class="col-md-7 col-12 pl-md-0">
									<div id="payMethod2" class="collapse show" aria-labelledby="method2" data-parent="#accordion" style="">
										<div class="row d-flex align-items-stretch">
											
											<label class="col-6  custom-radio-box">
												<input type="radio" id="annual_price" name="payment_method" value="bca" class="custom-control-input" required="required">
												<div class="card card-shadow zoomer h-100">
													<div class="card-body">
														<div class="payement-logo">
															<img src="<?= url(UPLOADS_URL_PATH . 'bca.png') ?>" >
														</div>
														<div class="card-title text-center mb-0">BCA Virtual Account</div>
													</div>
												</div>
											</label>
											 <label class="col-6  custom-radio-box">
												<input type="radio" id="annual_price" name="payment_method" value="mandiri" class="custom-control-input" required="required">
												<div class="card card-shadow zoomer h-100">
													<div class="card-body">
														<div class="payement-logo">
															<img src="<?= url(UPLOADS_URL_PATH . 'mandiri.png') ?>" >
														</div>
														<div class="card-title text-center mb-0">Mandiri Virtual Account</div>
													</div>
												</div>
											</label>
											 <label class="col-6  custom-radio-box">
												<input type="radio" id="annual_price" name="payment_method" value="bni" class="custom-control-input" required="required">
												<div class="card card-shadow zoomer h-100">
													<div class="card-body">
														<div class="payement-logo">
															<img src="<?= url(UPLOADS_URL_PATH . 'bni.png') ?>" >
														</div>
														<div class="card-title text-center mb-0">BNI Virtual Account</div>
													</div>
												</div>
											</label>
											 <label class="col-6  custom-radio-box">
												<input type="radio" id="annual_price" name="payment_method" value="permata" class="custom-control-input" required="required">
												<div class="card card-shadow zoomer h-100">
													<div class="card-body">
														<div class="payement-logo">
															<img src="<?= url(UPLOADS_URL_PATH . 'permata.png') ?>" >
														</div>
														<div class="card-title text-center mb-0">Permata Virtual Account</div>
													</div>
												</div>
											</label>
								
								
								
										</div>
									</div>
									<div id="payMethod3" class="collapse " aria-labelledby="method3" data-parent="#accordion" style="">
										<div class="row d-flex align-items-stretch">
											<label class="col-6  custom-radio-box">
												<input type="radio" id="annual_price" name="payment_method" value="gopay" class="custom-control-input" required="required">
												<div class="card card-shadow zoomer h-100">
													<div class="card-body">
														<div class="payement-logo">
															<img src="<?= url(UPLOADS_URL_PATH . 'gopay.png') ?>" >
														</div>
														<div class="card-title text-center mb-0">Gopay</div>
													</div>
												</div>
											</label>
										</div>
									</div>
									<div id="payMethod4" class="collapse " aria-labelledby="method4" data-parent="#accordion" style="">
										<div class="row d-flex align-items-stretch">
											<label class="col-6  custom-radio-box">
												<input type="radio" id="annual_price" name="payment_method" value="creditcard" class="custom-control-input" required="required">
												<div class="card card-shadow zoomer h-100">
													<div class="card-body">
														<div class="payement-logo">
															<img src="<?= url(UPLOADS_URL_PATH . 'creditcard.png') ?>" >
														</div>
														<div class="card-title text-center mb-0">Credit Card</div>
														<p class="text-center mb-0" >Visa, MAsterCard,JCB or Amex</p>
													</div>
												</div>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					-->
					
					
                    
					
                    <div class="margin-top-6 mb-5">
						<i class="fa fa-dollar-sign mr-3"></i> 
						<span class="h5 text-white"><?= $this->language->pay->custom_package->payment_type ?></span>
					</div>

                    <div class="row d-flex align-items-stretch">
                        <!--
                        <label class="col-6 custom-radio-box">
                            <input type="radio" id="one-time_type" name="payment_type" value="one-time" class="custom-control-input" required="required">

                            <div class="card card-shadow zoomer h-100">
                                <div class="card-body">

                                    <div class="card-title text-center"><?= $this->language->pay->custom_package->one_time_type ?></div>

                                    <div class="mt-3 text-center">
                                        <span class="custom-radio-box-main-icon"><i class="fa fa-hand-holding-usd"></i></span>
                                    </div>

                                </div>
                            </div>
                        </label>
                      -->
                        <label class="col-12 col-lg-6 custom-radio-box" id="recurring_type_label">
                            <input type="radio" id="recurring_type" name="payment_type" value="recurring" class="custom-control-input" required="required">

                            <div class="card card-shadow zoomer h-100">
                                <div class="card-body">

                                    <div class="card-title text-center text-black"><?= $this->language->pay->custom_package->recurring_type ?></div>

                                    <div class="mt-3 text-center text-black">
                                        <span class="custom-radio-box-main-icon"><i class="fa fa-sync-alt"></i></span>
                                    </div>

                                </div>
                            </div>
                        </label>
                      
                    </div>
					<!-- payment gateway -->
					<div class="margin-top-6 mb-5">
						<i class="fa fa-dollar-sign mr-3"></i> 
						<span class="h5 text-white">Payment gateway</span>
					</div>

                    <div class="row d-flex align-items-stretch">
                        
                        <label class="col-12 col-lg-6 custom-radio-box">
                            <input type="radio" name="gateway" value="mitrans" class="custom-control-input radiopay" required="required">
                            <div class="card card-shadow zoomer h-100">
                                <div class="card-body">
                                    <div class="card-title text-center text-black">Mitrans</div>

                                    <div class="mt-3 text-center">
                                       <span class="pay-info pay-info text-black">Support Transfer Bank, Virtual Account,credit card,Gopay dll </span>
                                    </div>

                                </div>
                            </div>
                        </label>
                      
                       <label class="col-12 col-lg-6 custom-radio-box" id="recurring_type_label">
                            <input type="radio" name="gateway" value="paypal" class="custom-control-input radiopay" required="required">

                            <div class="card card-shadow zoomer h-100">
                                <div class="card-body">

                                    <div class="card-title text-center text-black">Paypal</div>

                                    <div class="mt-3 text-center">
                                        <span class="pay-info pay-info text-black">Support Paypal </span>
                                    </div>

                                </div>
                            </div>
                        </label>
                      
                    </div>
					<div class="margin-top-6 mb-5">
						<i class="fa fa-dollar-sign mr-3"></i> 
						<span class="h5 text-white">Voucher</span>
					</div>
					<div class="msg-error mt-1 mb-1"></div>
					<div class="row d-flex align-items-stretch">
						
						<div class="form-group col-8">
						  <input type="voucher" class="form-control" id="voucher" placeholder="kode voucher">
						</div>
						<div class="form-group col-4">
							 <button type="button" id="cekvoucher"  class="btn btn-sm btn-primary">Cek</button>
						</div>
					</div>
					
					
                    <div class="margin-top-3 form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" name="accept" type="checkbox" required="required">
                            <?= sprintf(
                                $this->language->pay->accept,
                                '<a href="' . $this->settings->terms_and_conditions_url . '">' . $this->language->register->form->terms_and_conditions . '</a>',
                                '<a href="' . $this->settings->privacy_policy_url . '">' . $this->language->register->form->privacy_policy . '</a>'
                            ) ?>
                        </label>
                    </div>

                    <div class="text-center margin-top-6">
						<div id="addInput"></div>
						<input type="hidden" name="payment_processor" value="paypal">
                        <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->pay->custom_package->pay ?></button>
                    </div>
                </form>


            <?php

            /* Include only if the stripe redirect session was generated */
            if($data->stripe_session):

            ?>
                <script src="https://js.stripe.com/v3/"></script>

                <script>
                    let stripe = Stripe(<?= json_encode($this->settings->stripe->publishable_key) ?>);

                    stripe.redirectToCheckout({
                        sessionId: <?= json_encode($data->stripe_session->id) ?>,
                    }).then((result) => {

                        /* Nothing for the moment */

                    });
                </script>

            <?php endif ?>

            <?php endif ?>
    </div>
</div>

<?php ob_start() ?>
    <script>
        $('[name="payment_processor"]:first').attr('checked', 'checked');
        $('[name="payment_type"]:first').attr('checked', 'checked');
        $('[name="gateway"]:first').attr('checked', 'checked');
		
		$('input:radio[name="gateway"]').change(
		function(){
			if ($(this).is(':checked')) {
				
				if($(this).val() == 'mitrans'){
					$('#actionpay').attr('action', "payment/");
				}else{
					$('#actionpay').attr('action', "pay/<?= $data->package_id ?>");
				}
				
				
			}
		});
			
		$("#cekvoucher").click(function() {
			$('.msg-error').html('');
			$('#addInput').html('');
			var voucher=$('#voucher').val();
			if(voucher == ''){
				$('.msg-error').html('<div class="alert alert-warning" role="alert">voucher not found</div>');
			}else{
				
				
				var xajaxFile = "<?= url('pay/cekvoucher') ?>"; 
					$.ajax({
					type: "POST",
					url: xajaxFile,
					data: $.param({voucher:voucher}),
					dataType: 'json',
					success: function(data){
							if(!data.error){
								$('#voucher').attr('disabled','disabled');
								$('#cekvoucher').addClass('disabled').attr('disabled','disabled');
								$('#addInput').html('<input type="hidden" name="code" value="'+data.voucher+'">');
								$(".msg-error").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.errorMsg+"</div>");
							}else{
								$(".msg-error").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.errorMsg+"</div>");
							}
						
						} 
					}); 
				
			}
		});
		
    </script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
