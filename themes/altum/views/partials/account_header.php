<?php defined('ALTUMCODE') || die() ?>

    <div class="d-flex">
        <h1 class="h3 text-white"><i class="fa fa-xs fa-wrench text-white-700"></i> Account Settings</h1>
    </div>
    <div>
        <span class="badge badge-success"><?= sprintf($this->language->account->package->header, $this->user->package->name) ?></span>

        <?php if($this->user->package_id != 'free'): ?>
            <small><?= sprintf($this->language->account->package->subheader, '<strong>' . \Altum\Date::get($this->user->package_expiration_date, 2) . '</strong>') ?></small>
        <?php endif ?>
    </div>

    <style>
        div > .nav-link{
            color: black !important;
        }
        .nav-link.active{
            background-color: blue !important;
            color: white !important;
        }
        .text-success {
            color: #28a745 !important;
        }
    </style>

    <div class="row mt-5" style="background-color: white; border-radius: 10px;">
        <div class="mt-5 mb-5 mb-lg-0 col-12 col-lg-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link <?= \Altum\Routing\Router::$controller_key == 'account' ? 'active' : null ?>" href="<?= url('account') ?>" style="padding: 0.5em !important">
                    <i class="fa fa-sm fa-user"></i> <?= $this->language->account->menu ?>
                </a>
                <a class="nav-link <?= \Altum\Routing\Router::$controller_key == 'account-package' ? 'active' : null ?>" href="<?= url('account-package') ?>" style="padding: 0.5em !important">
                    <i class="fa fa-sm fa-box-open"></i> <?= $this->language->account_package->menu ?>
                </a>
                <a class="nav-link <?= \Altum\Routing\Router::$controller_key == 'account-payments' ? 'active' : null ?>" href="<?= url('account-payments') ?>" style="padding: 0.5em !important">
                    <i class="fa fa-sm fa-dollar-sign"></i> <?= $this->language->account_payments->menu ?>
                </a>
                <a class="nav-link <?= \Altum\Routing\Router::$controller_key == 'account-logs' ? 'active' : null ?>" href="<?= url('account-logs') ?>" style="padding: 0.5em !important">
                    <i class="fa fa-sm fa-scroll mr-1"></i> <?= $this->language->account_logs->menu ?>
                </a>
            </div>
        </div>
    








