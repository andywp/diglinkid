<?php defined('ALTUMCODE') || die() ?>

    <?php ob_start() ?>
    <link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" media="screen">
    <?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
    
    <div class="display-6 mb-4">
        <h1 class="h3 text-diglink">Perfomance of this month</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-tiffany border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->clicks_this_month ?></p>
                        <h4 class="mb-0 text-tiffany"><?= restyle_number($data->links->clicks_month) ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-tiffany text-white">
                        <i class="bi bi-link-45deg"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-success border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->active_users_this_month ?></p>
                        <h4 class="mb-0 text-success"><?= restyle_number($data->users->active_users_month) ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-success text-white">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($this->settings->payment->is_enabled): ?>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-pink border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->payments_this_month ?></p>
                        <h4 class="mb-0 text-pink"><?= restyle_number($data->payments_month) ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-pink text-white">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-orange border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->earnings_this_month ?></p>
                        <h4 class="mb-0 text-orange"><?= restyle_number($data->earnings_month) ?> <?= $this->settings->payment->currency ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-orange text-white">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
    
    <div class="display-6 mb-4">
        <h1 class="h3 text-diglink">Total of Performance</h1>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-tiffany border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->clicks ?></p>
                        <h4 class="mb-0 text-tiffany"><?= restyle_number($data->links->clicks) ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-tiffany text-white">
                        <i class="bi bi-link-45deg"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-success border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->active_users ?></p>
                        <h4 class="mb-0 text-success"><?= restyle_number($data->users->active_users) ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-success text-white">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($this->settings->payment->is_enabled): ?>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-pink border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->payments ?></p>
                        <h4 class="mb-0 text-pink"><?= restyle_number($data->payments->payments) ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-pink text-white">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-orange border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1"><?= $this->language->admin_index->display->earnings ?></p>
                        <h4 class="mb-0 text-orange"><?= restyle_number($data->payments->earnings) ?> <?= $this->settings->payment->currency ?></h4>
                    </div>
                    <div class="ms-auto widget-icon bg-orange text-white">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
    </div>
    
    <?php $result = \Altum\Database\Database::$database->query("SELECT `user_id`, `name`, `email`, `active`, `date` FROM `users` ORDER BY `user_id` DESC LIMIT 25"); ?>
    <div class="card">
        <div class="container mt-4">
            <h1 class="h3 text-diglink"><?= $this->language->admin_index->users->header ?></h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="latest-users-table" class="table table-striped table-bordered mt-4" style="width:100%">
                    <thead>
                    <tr>
                        <th><?= $this->language->admin_index->users->user ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_object()): ?>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="<?= get_gravatar($row->email) ?>" class="user-avatar rounded-circle me-3" alt="" style="width: 45px;"/>
                                        <div class="d-flex flex-column">
                                            <?= '<a href="' . url('admin/user-view/' . $row->user_id) . '">' . $row->name . '</a>' ?>

                                            <span class="text-muted"><?= $row->email ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-column">
                                            <div><?= $row->active ? '<span class="badge badge-pill badge-success"><i class="fa fa-check"></i> ' . $this->language->global->active . '</span>' : '<span class="badge badge-pill badge-warning"><i class="fa fa-eye-slash"></i> ' . $this->language->global->disabled . '</span>' ?></div>
                                            <div><small class="text-muted" data-toggle="tooltip" title="<?= \Altum\Date::get($row->date, 1) ?>"><?= \Altum\Date::get($row->date, 2) ?></small></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= get_admin_options_button('user', $row->user_id) ?></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php $result = \Altum\Database\Database::$database->query("SELECT `payments`.*, `users`.`name` AS `user_name` FROM `payments` LEFT JOIN `users` ON `payments`.`user_id` = `users`.`user_id` ORDER BY `id` DESC LIMIT 25"); ?>
    <?php if($result->num_rows): ?>
        <div class="card">
            <div class="container mt-4">
                <h1 class="h3 text-diglink"><?= $this->language->admin_index->payments->header ?></h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="payment-table" class="table table-striped table-bordered mt-4" style="width:100%">
                        <thead>
                        <tr>
                            <th><?= $this->language->admin_index->payments->payment ?></th>
                            <th><?= $this->language->admin_index->payments->user ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_object()): ?>
                                <?php
                                switch($row->processor) {
                                    case 'STRIPE':
                                        $row->processor = '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->stripe .'"><i class="fab fa-stripe icon-stripe"></i></span>';
                                        break;

                                    case 'PAYPAL':
                                        $row->processor = '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->paypal .'"><i class="fab fa-paypal icon-paypal"></i></span>';
                                        break;
                                }
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <?= $row->name ?>
                                            <span class="text-muted"><?= $row->email ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?= '<a href="' . url( 'admin/user-view/' . $row->user_id) . '">' . $row->user_name . '</a>' ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div><span class="text-success"><?= restyle_number($row->amount) ?></span> <?= $row->currency ?></div>
                                            <div><small class="text-muted" data-toggle="tooltip" title="<?= \Altum\Date::get($row->date, 1) ?>"><?= \Altum\Date::get($row->date, 2) ?></small><div>
                                                </div>
                                    </td>
                                    <td><?= $row->type == 'ONE-TIME' ? '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->one_time . '"><i class="fa fa-hand-holding-usd"></i></span>' : '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->recurring . '"><i class="fa fa-sync-alt"></i></span>' ?></td>
                                    <td><?= $row->processor ?></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>

