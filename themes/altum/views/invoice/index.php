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
