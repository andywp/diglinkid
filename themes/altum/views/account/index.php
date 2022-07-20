<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet" media="screen">
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/select2/css/select2-bootstrap4.css') ?>" rel="stylesheet">

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
        <div class="breadcrumb-title pe-3">Account</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-home"></i></a></li>
                </ol>
            </nav>
        </div>
    </div>
    <?php require THEME_PATH . 'views/partials/ads_header.php' ?>

    <section class="pages pt-3">
        <?php display_notifications() ?>
       <div class="row">
            <div class="col-md-3">
                <?php require THEME_PATH . 'views/layout/card-account.php' ?>
            </div>
            <div class="col-md-9">
                
                <div class="card border">
                    <div class="card-body">
                        <form action="" method="post" role="form" autocomplete="off">
                            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
                            <div class="p-2">
                                <h5 class="mb-1 text-uppercase"><?= $this->language->account->settings->header ?></h5>
                                <p><?= $this->language->account->settings->subheader ?></p>
                                <div class="form-group mb-3">
                                    <label for="name"><?= $this->language->account->settings->name ?></label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?= $this->user->name ?>" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email"><?= $this->language->account->settings->email ?></label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?= $this->user->email ?>" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="timezone"><?= $this->language->account->settings->timezone ?></label>
                                    <select id="timezone" name="timezone" class="form-control single-select">
                                        <?php foreach(DateTimeZone::listIdentifiers() as $timezone) echo '<option value="' . $timezone . '" ' . ($this->user->timezone == $timezone ? 'selected' : null) . '>' . $timezone . '</option>' ?>
                                    </select>
                                    <small class="text-muted"><?= $this->language->account->settings->timezone_help ?></small>
                                </div>
                            </div>
                            <div class="mt-3"><hr></div>
                            <div class="">
                                <h5 class="mb-1 text-uppercase"><?= $this->language->account->change_password->header ?></h5>
                                <p><?= $this->language->account->change_password->subheader ?></p>
                                <div class="form-group mb-3">
                                    <label for="old_password"><?= $this->language->account->change_password->current_password ?></label>
                                    <input type="password" id="old_password" name="old_password" class="form-control"  autocomplete="off"/>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="new_password"><?= $this->language->account->change_password->new_password ?></label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" autocomplete="off"/>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="repeat_password"><?= $this->language->account->change_password->repeat_password ?></label>
                                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" autocomplete="off"/>
                                </div>
                            </div>

                            <div class="col mt-3">
                                <button type="submit" name="submit" class="btn btn-outline-primary"><?= $this->language->global->update ?></button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card border rounded">
                    <div class="card-body">
                        <div>
                            <h5 class="mb-1 text-uppercase"><?= $this->language->account->delete->header ?></h5>
                            <p><?= $this->language->account->delete->subheader ?></p>
                        </div>
                        <a href="<?= url('account/delete' . \Altum\Middlewares\Csrf::get_url_query()) ?>" class="btn btn-outline-danger" data-confirm="<?= $this->language->account->delete->confirm_message ?>"><?= $this->language->global->delete ?></a>
                    </div>
                </div>

            </div>
       </div>
    </section>


                       


<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/select2/js/select2.min.js') ?>"></script>
<script>
    //$(function() {
	//"use strict";
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        /* $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        }); */

    //});
</script>

<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

