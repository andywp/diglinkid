<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet" media="screen">

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">  
    <div class="container pt-18 pb-16" style="z-index: 5; position:relative">  

        <?= $this->views['account_header'] ?>
            <?php require THEME_PATH . 'views/partials/ads_header.php' ?>

            <?php display_notifications() ?>

            <div class="col mt-5 mb-5 mb-lg-0 text-black">
                <h2 class="h3"><?= $this->language->account_payments->header ?></h2>
                <p><?= $this->language->account_payments->subheader ?></p>

                <?php if($data->payments_result->num_rows): ?>
                    <div class="table-responsive table-custom-container">
                        <table class="table table-custom">
                            <thead>
                            <tr>
                                <th><?= $this->language->account_payments->payments->nr ?></th>
                                <th><?= $this->language->account_payments->payments->type ?></th>
                                <th></th>
                                <th><?= $this->language->account_payments->payments->package_id ?></th>
                                <th><?= $this->language->account_payments->payments->email ?></th>
                                <th><?= $this->language->account_payments->payments->name ?></th>
                                <th><?= $this->language->account_payments->payments->amount ?></th>
                                <th><?= $this->language->account_payments->payments->date ?></th>
                                <?php if($this->settings->business->invoice_is_enabled): ?>
                                <th></th>
                                <?php endif ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $nr = 1; while($row = $data->payments_result->fetch_object()): ?>
                                    
                                <?php
                                
                                if(!empty($row->voucher) && !empty($row->discount)  ){
                                    $discount=($row->discount / 100 ) * $row->amount;
                                    $row->amount = $row->amount - $discount;
                                }
                                
                                
                                
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
                                    <td><?= $nr++ ?></td>
                                    <td><?= $row->type == 'ONE-TIME' ? '<span data-toggle="tooltip" title="' . $row->type . '"><i class="fa fa-hand-holding-usd"></i></span>' : '<span data-toggle="tooltip" title="' . $row->type . '"><i class="fa fa-sync-alt"></i></span>' ?></td>
                                    <td><?= $row->processor ?></td>
                                    <td><?= (new \Altum\Models\Package())->get_package_by_id($row->package_id)->name ?></td>
                                    <td><?= $row->email ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><span class="text-success"><?= restyle_number($row->amount) ?></span> <?= $row->currency ?></td>
                                    <td><span data-toggle="tooltip" title="<?= \Altum\Date::get($row->date, true) ?>"><?= \Altum\Date::get($row->date) ?></span></td>
                                    <?php if($this->settings->business->invoice_is_enabled): ?>
                                    <td>
                                        <a href="<?= url('invoice/' . $row->id) ?>">
                                            <span data-toggle="tooltip" title="<?= $this->language->account_payments->payments->invoice ?>"><i class="fa fa-file-invoice"></i></span>
                                        </a>
                                    </td>
                                    <?php endif ?>
                                </tr>
                            <?php endwhile ?>

                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p><?= $this->language->account_payments->info_message->no_payments ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
            
