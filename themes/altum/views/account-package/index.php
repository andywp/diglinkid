<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet" media="screen">

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
    <div class="breadcrumb-title pe-3">Account Package</div>
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
                        <div>
                            <h4 class="card-title mb-3" ><?= $this->language->account_package->header ?></h4>
                        </div>
                        <hr>
                        <div>
                        <h6 class="card-title" ><?= $this->user->package_id ?></h6>
                        <?php if($this->user->package_id != 'free'): ?>
                            <p>
                                <?= sprintf(
                                    $this->user->payment_subscription_id ? $this->language->account_package->package->renews : $this->language->account_package->package->expires,
                                    '<strong>' . \Altum\Date::get($this->user->package_expiration_date, 2) . '</strong>'
                                ) ?>
                            </p>
                        <?php endif ?>
                        </div>
                        <div class="package"> 
                            <ul class="list-group list-group-flush mb-3">
                                <?php foreach(['no_ads', 'removable_branding', 'custom_branding', 'custom_colored_links', 'statistics', 'google_analytics', 'facebook_pixel','custom_backgrounds', 'verified', 'scheduling'] as $row): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div class="ms-2 me-auto">
                                        <?= $this->language->global->package_settings->{$row} ?>
                                    </div>
                                    <i class="fa fa-sm me-3 <?= $this->user->package_settings->{$row} ? 'fa-check-circle text-success' : 'fa-times-circle text-muted' ?>"></i>
                                </li>
                                <?php endforeach ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div class="ms-2 me-auto">
                                        <?php if($this->user->package_settings->projects_limit == -1): ?>
                                            <?= $this->language->global->package_settings->unlimited_projects_limit ?>
                                        <?php else: ?>
                                            <?= sprintf($this->language->global->package_settings->projects_limit, '<span class="badge bg-primary rounded-pill">' . nr($this->user->package_settings->projects_limit) . '</span>') ?>
                                        <?php endif ?>
                                    </div>
                                    <i class="fa fa-check-circle fa-sm me-3 text-success"></i>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div class="ms-2 me-auto">
                                        <?php if($this->user->package_settings->biolinks_limit == -1): ?>
                                            <?= $this->language->global->package_settings->unlimited_biolinks_limit ?>
                                        <?php else: ?>
                                            <?= sprintf($this->language->global->package_settings->biolinks_limit, '<span class="badge bg-primary rounded-pill">' . nr($this->user->package_settings->biolinks_limit) . '</span>') ?>
                                        <?php endif ?>
                                    </div>
                                    <i class="fa fa-check-circle fa-sm me-3 text-success"></i>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div class="ms-2 me-auto">
                                        <?php if($this->user->package_settings->links_limit == -1): ?>
                                            <?= $this->language->global->package_settings->unlimited_links_limit ?>
                                        <?php else: ?>
                                            <?= sprintf($this->language->global->package_settings->links_limit, '<span class="badge bg-primary rounded-pill">' . nr($this->user->package_settings->links_limit) . '</span>') ?>
                                        <?php endif ?>
                                    </div>
                                    <i class="fa fa-check-circle fa-sm me-3 text-success"></i>
                                </li>

                            </ul>
                        </div>
                        <div class="text-center mb-4">
                            <?php if($this->settings->payment->is_enabled): ?>
                                <?php if($this->user->package_id == 'free'): ?>
                                    <a href="<?= url('package/upgrade') ?>" class="btn btn-outline-primary"><i class="fa fa-arrow-up"></i> <?= $this->language->account->package->upgrade_package ?></a>
                                <?php elseif($this->user->package_id == 'trial'): ?>
                                    <a href="<?= url('package/renew') ?>" class="btn btn-outline-primary"><i class="fa fa-sync-alt"></i> <?= $this->language->account->package->renew_package ?></a>
                                <?php else: ?>
                                    <a href="<?= url('package/renew') ?>" class="btn btn-outline-primary"><i class="fa fa-sync-alt"></i> <?= $this->language->account->package->renew_package ?></a>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <?php if($this->user->package_id != 'free' && $this->user->payment_subscription_id): ?>                       
                <div class="card border">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-3" ><?= $this->language->account_package->cancel->header ?></h4>
                            <p><?= $this->language->account_package->cancel->subheader ?></p>
                        </div>
                        <div class="col-auto mt-3">
                            <a href="<?= url('account/cancelsubscription' . \Altum\Middlewares\Csrf::get_url_query()) ?>" class="btn btn-outline-secondary" data-confirm="<?= $this->language->account_package->cancel->confirm_message ?>"><?= $this->language->account_package->cancel->cancel ?></a>
                        </div> 
                    </div>
                </div>
                <?php endif ?>

            </div>
       </div>
    </section>



