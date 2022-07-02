<?php defined('ALTUMCODE') || die() ?>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="wrapper bg-soft-primary pt-10 pb-12 pt-md-8 pb-md-17">
        <?php display_notifications() ?>

        <div class="container">
            <div class="row justify-content-md-center" data-cue="zoomIn">
                <div class="col-lg-6">
                    <figure><img src="https://okupasi.id/demo/assets/front/sandbox/img/okupasi_img/register.png" alt="" /></figure>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="display-5 mb-5 text-diglink text-center"><?= $this->language->login->header ?></h1>
                            <form action="" method="post" class="mt-4" role="form">
                                <div class="form-group">
                                    <label class="mb-1"><?= $this->language->login->form->email ?></label>
                                    <input type="text" name="email" class="form-control" placeholder="<?= $this->language->login->form->email_placeholder ?>" value="<?= $data->values['email'] ?>" required="required" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><?= $this->language->login->form->password ?></label>
                                    <input type="password" name="password" class="form-control" placeholder="<?= $this->language->login->form->password_placeholder ?>"  required="required" />
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="rememberme">
                                        <small class="text-muted"><?= $this->language->login->form->remember_me ?></small>
                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" name="submit" class="btn bg-diglink rounded-pill w-100 mb-2 text-white"><?= $this->language->login->form->login ?></button>
                                </div>
                            </form>
                            <div class="form-group text-center">
                                <p class="mb-1">
                                    <a href="forgot-password" class="hover"><?= $this->language->login->display->lost_password ?></a>
                                </p>
                                <?= sprintf($this->language->login->display->register, '<a href="' . url('register') . '" class="font-weight-bold">' . $this->language->login->display->register_help . '</a>') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
