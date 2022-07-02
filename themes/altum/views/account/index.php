<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet" media="screen">

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">  
    <div class="container pt-18 pb-16" style="z-index: 5; position:relative">  

        <?= $this->views['account_header'] ?>
        
            <?php require THEME_PATH . 'views/partials/ads_header.php' ?>

            <!-- <section class="container pt-5"> -->

            <?php display_notifications() ?>
            <div class="col order-1 order-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body" style="padding-top: 0px">
                        <form action="" method="post" role="form">
                            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
                            <div class="mt-5 mb-5 mb-lg-0 col text-black">
                                <h2 class="h3"><?= $this->language->account->settings->header ?></h2>
                                <p><?= $this->language->account->settings->subheader ?></p>
                                <div class="form-group">
                                    <label for="name"><?= $this->language->account->settings->name ?></label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?= $this->user->name ?>" />
                                </div>

                                <div class="form-group">
                                    <label for="email"><?= $this->language->account->settings->email ?></label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?= $this->user->email ?>" />
                                </div>

                                <div class="form-group">
                                    <label for="timezone"><?= $this->language->account->settings->timezone ?></label>
                                    <select id="timezone" name="timezone" class="form-control" style="padding: 0rem 1rem;">
                                        <?php foreach(DateTimeZone::listIdentifiers() as $timezone) echo '<option value="' . $timezone . '" ' . ($this->user->timezone == $timezone ? 'selected' : null) . '>' . $timezone . '</option>' ?>
                                    </select>
                                    <small class="text-muted"><?= $this->language->account->settings->timezone_help ?></small>
                                </div>
                            </div>

                            <div class="margin-top-3"></div>

                            <div class="mt-5 mb-5 mb-lg-0 col text-black">
                                <h2 class="h3"><?= $this->language->account->change_password->header ?></h2>
                                <p><?= $this->language->account->change_password->subheader ?></p>
                                <div class="form-group">
                                    <label for="old_password"><?= $this->language->account->change_password->current_password ?></label>
                                    <input type="password" id="old_password" name="old_password" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="new_password"><?= $this->language->account->change_password->new_password ?></label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="repeat_password"><?= $this->language->account->change_password->repeat_password ?></label>
                                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" />
                                </div>
                            </div>

                            <div class="col">
                                <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->global->update ?></button>
                            </div>

                        </form>
                        <div class="margin-top-6 d-flex justify-content-between align-items-center text-black">
                            <div>
                                <h2 class="h3"><?= $this->language->account->delete->header ?></h2>
                                <p><?= $this->language->account->delete->subheader ?></p>
                            </div>
                            <a href="<?= url('account/delete' . \Altum\Middlewares\Csrf::get_url_query()) ?>" class="btn btn-danger" data-confirm="<?= $this->language->account->delete->confirm_message ?>"><?= $this->language->global->delete ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


