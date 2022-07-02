<?php defined('ALTUMCODE') || die() ?>

    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content" data-image-src="./assets/img/photos/bg4.jpg">   
        <?php display_notifications() ?>

        <div class="container pt-18 pb-16" style="z-index: 5; position:relative">
            <div class="row justify-content-md-center align-items-center" data-cue="zoomIn">
                <div class="col-lg-6">
                    <figure><img src="./assets/img/concept/concept16.png" alt="" /></figure>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="display-5 mb-5 text-diglink text-center"><?= $this->language->register->header ?></h1>
                            <form action="" method="post" class="mt-4" role="form">
                                <div class="form-group">
                                    <label class="mb-1"><?= $this->language->register->form->name ?></label>
                                    <input type="text" name="name" class="form-control" value="<?= $data->values['name'] ?>" placeholder="<?= $this->language->register->form->name_placeholder ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label class="mb-1"><?= $this->language->register->form->email ?></label>
                                    <input type="text" name="email" class="form-control" value="<?= $data->values['email'] ?>" placeholder="<?= $this->language->register->form->email_placeholder ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label class="mb-1"><?= $this->language->register->form->password ?></label>
                                    <input type="password" name="password" class="form-control" value="<?= $data->values['password'] ?>" placeholder="<?= $this->language->register->form->password_placeholder ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label class="mb-1"><?= $this->language->register->form->repeat_password ?></label>
                                    <input type="password" name="repeat_password" class="form-control" value="<?= $data->values['repeat_password'] ?>" placeholder="<?= $this->language->register->form->repeat_password ?>" required="required" />
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="accept" type="checkbox" required="required">
                                        <small class="text-muted">
                                            <?= sprintf(
                                                $this->language->register->form->accept,
                                                '<a href="' . $this->settings->terms_and_conditions_url . '" target="_blank">' . $this->language->register->form->terms_and_conditions . '</a>',
                                                '<a href="' . $this->settings->privacy_policy_url . '" target="_blank">' . $this->language->register->form->privacy_policy . '</a>'
                                            ) ?>
                                        </small>
                                    </label>
                                </div>

                                <div class="form-group mt-3">
                                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                    <button type="submit" name="submit" class="btn bg-diglink rounded-pill w-100 mb-2 text-white"><?= $this->language->register->form->register ?></button>
                                </div>
                                <!-- <div class="msg-validate">
                                    <div class="form-label-group mb-4">
                                        <input type="text" name="name" class="form-control" value="<?= $data->values['name'] ?>" placeholder="<?= $this->language->register->form->name_placeholder ?>" required="required">
                                        <label><?= $this->language->register->form->name ?></label>
                                    </div>
                                </div>
                                <div class="msg-validate">
                                    <div class="form-label-group mb-4">
                                        <input type="email" name="email" class="form-control" value="<?= $data->values['email'] ?>" placeholder="<?= $this->language->register->form->email_placeholder ?>" required="required">
                                        <label><?= $this->language->register->form->email ?></label>
                                    </div>
                                </div>
                                <div class="msg-validate">
                                    <div class="form-label-group mb-4">
                                        <input type="password" name="password" class="form-control" value="<?= $data->values['password'] ?>" placeholder="<?= $this->language->register->form->password_placeholder ?>" required="required">
                                        <label><?= $this->language->register->form->password ?></label>
                                    </div>
                                </div>
                                <div class="msg-validate">
                                    <div class="form-label-group mb-4">
                                        <input type="password" name="repeat_password" class="form-control" value="<?= $data->values['repeat_password'] ?>" placeholder="<?= $this->language->register->form->repeat_password ?>" required="required">
                                        <label><?= $this->language->register->form->repeat_password ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php $data->captcha->display() ?>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="accept" type="checkbox" required="required">
                                        <small class="text-muted">
                                            <?= sprintf(
                                                $this->language->register->form->accept,
                                                '<a href="' . $this->settings->terms_and_conditions_url . '" target="_blank">' . $this->language->register->form->terms_and_conditions . '</a>',
                                                '<a href="' . $this->settings->privacy_policy_url . '" target="_blank">' . $this->language->register->form->privacy_policy . '</a>'
                                            ) ?>
                                        </small>
                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                    <button type="submit" name="submit" class="btn bg-diglink rounded-pill w-100 mb-2 text-white"><?= $this->language->register->form->register ?></button>
                                </div> -->
                            </form>
                            <div class="form-group text-center">
                                <p class="mb-0"><?= $this->language->register->login ?>
                                    <a href="login" class="hover"><?= $this->language->login->header ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php ob_start() ?>

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<script async src="https://www.google.com/recaptcha/api.js?render=6LfbJGYcAAAAAA5PDsvt1GsOklNDU9yRx9EgNITV"></script>
<script>
/* 	grecaptcha.ready(function () {
		grecaptcha.execute('6LfbJGYcAAAAAA5PDsvt1GsOklNDU9yRx9EgNITV', { action: 'contact' }).then(function (token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
			console.log(token,'alalal');
			recaptchaResponse.value = token;
			// Make the Ajax call here
		});
	}); */
	
	
	var interval = setInterval(function(){
	  if(window.grecaptcha){
			grecaptcha.ready(function() {
				grecaptcha.execute('6LfbJGYcAAAAAA5PDsvt1GsOklNDU9yRx9EgNITV', {action: 'homepage'}).then(function(token) {
				  $('#recaptchaResponse').val(token);
				});
			});
		clearInterval(interval);
	  }
	}, 100);
	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>