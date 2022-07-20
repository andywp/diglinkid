<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet" media="screen">
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
    <div class="breadcrumb-title pe-3">Account Payments</div>
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
                <div class="card border rounded">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-3" ><?= $this->language->account_payments->header ?></h4>
                            <p><?= $this->language->account_payments->subheader ?></p>
                        </div>
                            <?php if($data->payments_result->num_rows): ?>
                                <div class="table-responsive table-custom-container">
                                <table id="table-list" class="table table-striped table-bordered table-list ">
                                <thead>
                                <tr>
                                    <!-- <th><?= $this->language->account_payments->payments->nr ?></th> -->
                                    <th><?= $this->language->account_payments->payments->type ?></th>
                                   <!--  <th></th> -->
                                    <th><?= $this->language->account_payments->payments->package_id ?></th>
                                    <!-- <th><?= $this->language->account_payments->payments->email ?></th> -->
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
                                        default:
                                            $row->processor = '<span data-toggle="tooltip" title="' . $row->processor.'"><i class="far fa-money-bill-alt"></i></span>';
                                    }
                                    ?>

                                    <tr class="ticketRow" data-id="<?= $row->id ?>" >
                                       <!--  <td><?= $nr++ ?></td> -->
                                        <td><?= $row->type == 'ONE-TIME' ? '<span data-toggle="tooltip" title="' . $row->type . '"><i class="fa fa-hand-holding-usd"></i></span>' : '<span data-toggle="tooltip" title="' . $row->type . '"><i class="fa fa-sync-alt"></i></span>' ?></td>
                                        <!-- <td><?= $row->processor ?></td> -->
                                        <td><?= (new \Altum\Models\Package())->get_package_by_id($row->package_id)->name ?></td>
                                       <!--  <td><?= $row->email ?></td> -->
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
                        <?php endif ?>
                    </div>
                </div>
            </div>
       </div>
    </section>


   
    <?php ob_start() ?>
    <script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>

    <script>
        $( document ).ready(function() {
            $('#table-list').DataTable();

            $( ".ticketRow").on( "click", function() {
                let id=$(this).data('id');
                window.location='<?= url('invoice/') ?>'+id;
            });


        });	
    </script>
    <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
