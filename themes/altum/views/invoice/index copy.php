<?php defined('ALTUMCODE') || die() ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Invoice </div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-home"></i></a></li>
            </ol>
        </nav>
    </div>
</div>
<section class="pages pt-3">
    <?php display_notifications() ?>
    <div class="row">
        <div class="col-md-3">
            <?php require THEME_PATH . 'views/layout/card-account.php' ?>
        </div>
        <div class="col-md-9">
            <div class="card border shadow-none">
                <div class="card-header py-3">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-6 d-flex">
                            <h5 class="mb-0">
                                <?php if ($this->settings->logo != '') : ?>
                                    <img src="<?= url(UPLOADS_URL_PATH . 'logo/' . $this->settings->logo) ?>" class="img-fluid navbar-logo invoice-logo" alt="<?= $this->settings->title ?>" />
                                <?php endif; ?>
                                <?= $this->settings->title ?>
                            </h5>
                        </div>
                        <div class="col-12 col-lg-6 text-md-end">
                            <a href="javascript:;" class="btn btn-sm btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Export as PDF</a>
                            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-secondary"><i class="bi bi-printer-fill"></i> Print</a>
                        </div>
                    </div>
                </div>
                <div class="card-header py-2 bg-light">
                    <div class="row row-cols-1 row-cols-lg-3">
                        <div class="col">
                            <div class="">
                                <small>Vendor</small>
                                <address class="m-t-5 m-b-5">
                                    <strong class="text-inverse"><?= $this->settings->business->name ?>.</strong><br>
                                    <?= !empty($this->settings->business->address) ? $this->settings->business->address . ' <br>' : '' ?>
                                    <?= $this->settings->business->city ?>,<?= $this->settings->business->zip ?><br>
                                    <?= $this->settings->business->country ?><br>
                                    <?= !empty($this->settings->business->phone) ? 'Phone: ' . $this->settings->business->phone . '<br>' : '' ?>
                                    Email: <?= $this->settings->business->email ?>
                                </address>
                            </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <small>Customer</small>
                                <address class="m-t-5 m-b-5">
                                    <strong class="text-inverse"><?= ucwords($this->user->name) ?></strong><br>
                                    email: <?= $this->user->email ?>
                                </address>
                            </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <small>Invoice #<?= $data->payment->id ?></small>
                                <div class=""><b><?= \Altum\Date::get($data->payment->date, true) ?></b></div>
                                <div class="invoice-detail ">
                                    <?= $data->payment->status . ' via ' . $data->payment->processor ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>ITEM DESCRIPTION</th>
                                    <th class="text-right" width="20%">LINE TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= sprintf($this->language->invoice->table->item_value, $data->payment->package->name, $data->payment->plan) ?></td>
                                    <td class="text-right"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
                                </tr>
                                <?php if (!empty($data->payment->discount) && !empty($data->payment->voucher)) {
                                    $potongan = ' Discount ' . $data->payment->discount . '% Voucher ' . $data->payment->voucher;
                                    $discount = ($data->payment->discount / 100) * $data->payment->amount;
                                    $data->payment->amount = $data->payment->amount - $discount;
                                ?>
                                    <tr>
                                        <td>Discount Voucher <b><?= $data->payment->voucher ?> </b> <?= $data->payment->discount ?>% </td>
                                        <td class="text-right"><?= $discount . ' ' . $data->payment->currency ?></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row bg-light align-items-center m-0 d-flex justify-content-end">
                        <div class="col col-auto p-4">
                            <p class="mb-0">SUBTOTAL</p>
                            <h4 class="mb-0"><?= $data->payment->amount . ' ' . $data->payment->currency ?></h4>
                        </div>
                        
                       
                        <div class="col bg-dark col-auto p-4">
                            <p class="mb-0 text-white">TOTAL</p>
                            <h4 class="mb-0 text-white"><?= $data->payment->amount . ' ' . $data->payment->currency ?></h4>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>







<div class="container mt-5 d-flex justify-content-center">
    <div class="col-12 col-lg-10">

        <div class="d-print-none d-flex justify-content-between mb-5">
            <a href="<?= url('account-payments') ?>" class="text-muted" data-toggle="tooltip" title="<?= $this->language->global->go_back_button ?>"><i class="fa fa-arrow-left"></i></a>

            <button type="button" class="btn btn-primary" onclick="window.print()"><i class="fa fa-sm fa-print"></i> <?= $this->language->invoice->print ?></button>
        </div>

        <div class="card border-0">
            <div class="card-body p-5">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <?php if ($this->settings->logo != '') : ?>
                        <img src="<?= url(UPLOADS_URL_PATH . 'logo/' . $this->settings->logo) ?>" class="img-fluid navbar-logo invoice-logo" alt="<?= $this->language->global->accessibility->logo_alt ?>" />
                    <?php else : ?>
                        <h1><?= $this->settings->title ?></h1>
                    <?php endif ?>

                    <div class="d-flex flex-column">
                        <h3><?= $this->language->invoice->invoice ?></h3>

                        <table>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold pr-3"><?= $this->language->invoice->invoice_nr ?>:</td>
                                    <td><?= $data->payment->id ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold pr-3"><?= $this->language->invoice->invoice_date ?>:</td>
                                    <td><?= \Altum\Date::get($data->payment->date, true) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <h5><?= $this->language->invoice->vendor->header ?></h5>

                            <table>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->name ?>:</td>
                                        <td><?= $this->settings->business->name ?></td>
                                    </tr>

                                    <?php if (!empty($this->settings->business->address)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->address ?>:</td>
                                            <td><?= $this->settings->business->address ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->city)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->city ?>:</td>
                                            <td><?= $this->settings->business->city ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->county)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->county ?>:</td>
                                            <td><?= $this->settings->business->county ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->zip)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->zip ?>:</td>
                                            <td><?= $this->settings->business->zip ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->country)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->country ?>:</td>
                                            <td><?= $this->settings->business->country ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->email)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->email ?>:</td>
                                            <td><?= $this->settings->business->email ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->phone)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->language->invoice->vendor->phone ?>:</td>
                                            <td><?= $this->settings->business->phone ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->tax_type) && !empty($this->settings->business->tax_id)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->settings->business->tax_type ?>:</td>
                                            <td><?= $this->settings->business->tax_id ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->custom_key_one) && !empty($this->settings->business->custom_value_one)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->settings->business->custom_key_one ?>:</td>
                                            <td><?= $this->settings->business->custom_value_one ?></td>
                                        </tr>
                                    <?php endif ?>

                                    <?php if (!empty($this->settings->business->custom_key_two) && !empty($this->settings->business->custom_value_two)) : ?>
                                        <tr>
                                            <td class="font-weight-bold pr-3"><?= $this->settings->business->custom_key_two ?>:</td>
                                            <td><?= $this->settings->business->custom_value_two ?></td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 col-md-6">
                            <h5><?= $this->language->invoice->customer->header ?></h5>

                            <table>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold pr-3"><?= $this->language->invoice->customer->name ?>:</td>
                                        <td><?= $this->user->name ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pr-3"><?= $this->language->invoice->customer->email ?>:</td>
                                        <td><?= $this->user->email ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <textarea class="form-control mt-3" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th><?= $this->language->invoice->table->item ?></th>
                                <th class="text-right"><?= $this->language->invoice->table->amount ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= sprintf($this->language->invoice->table->item_value, $data->payment->package->name, $data->payment->plan) ?></td>
                                <td class="text-right"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
                            </tr>
                            <?php if (!empty($data->payment->discount) && !empty($data->payment->voucher)) {
                                    $potongan = ' Discount ' . $data->payment->discount . '% Voucher ' . $data->payment->voucher;
                                    $discount = ($data->payment->discount / 100) * $data->payment->amount;
                                    $data->payment->amount = $data->payment->amount - $discount;
                            ?>
                            <tr>
                                <td>Discount Voucher <b><?= $data->payment->voucher ?> </b> <?= $data->payment->discount ?>% </td>
                                <td class="text-right"><?= $discount . ' ' . $data->payment->currency ?></td>
                            </tr>

                            <?php } ?>



                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="d-flex flex-column">
                                    <span class="font-weight-bold"><?= $this->language->invoice->table->total ?></span>
                                    <small><?= $data->payment->status . ' via ' . $data->payment->processor ?></small>
                                </td>
                                <td class="text-right font-weight-bold"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>