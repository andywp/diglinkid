<?php defined('ALTUMCODE') || die() ?>

<?php

use Altum\Middlewares\Authentication;

?>

<?php $packages_result = $this->database->query("SELECT * FROM `packages` WHERE `is_enabled` = '1'"); ?>

<div class="row gy-6 align-items-center">
    <div class="col-lg-12 pricing-wrapper">
        <div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
            <p class="mb-0 pe-3">Bulan</p>
            <div class="pricing-switchers">
                <div class="pricing-switcher pricing-switcher-active"></div>
                <div class="pricing-switcher"></div>
                <div class="switcher-button bg-primary"></div>
            </div>
            <p class="mb-0 ps-3">Tahun <span class="text-red"><b>(Save 50%)</b></span></p>
        </div>
        <?php $result = \Altum\Database\Database::$database->query("SELECT * FROM `packages` WHERE `is_enabled` = 1 ORDER BY `monthly_price` ASC"); ?>
        <div class="row gy-6 mt-5">
            <div class="col-lg-3 col-md-6 col-sm-12 text-black">
                <div class="pricing card shadow-lg">
                    <div class="card-body pt-8">
                        <div class="prices text-dark">
                            <div class="price price-show">
                                <span class="price-currency"></span>
                                <span class="price-value">14 Hari</span> 
                            </div>
                            <div class="price price-hide price-hidden">
                                <span class="price-currency"></span>
                                <span class="price-value">14 Hari</span> 
                            </div>
                        </div>
                        <!--/.prices -->
                        <h4 class="card-title mt-2">Trial</h4>
                        <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                            <li>
                                <i class="uil uil-check"></i>
                                <span>Starter Features</span>
                            </li>
                            <li>
                                <i class="uil uil-check"></i>
                                <span>Profesional Features</span>
                            </li>
                            <li>
                                <i class="uil uil-check"></i>
                                <span>ADS</span>
                            </li>
                            <li>
                                <i class="uil uil-check"></i>
                                <span>1 Projects</span>
                            </li>
                            <li>
                                <i class="uil uil-check"></i>
                                <span>1 Diglink Pages</span>
                            </li>
                            <li>
                                <i class="uil uil-check"></i>
                                <span>5 Links</span>
                            </li>
                        </ul>
                        <?php if($row->package_id == $this->user->package_id): ?>
                            <button class="pricing-action-disabled"><?= $this->language->package->button->already_free ?></button>
                        <?php else: ?>
                            <a href="<?= Authentication::check() ? url('pay/free') : url('register?redirect=pay/free') ?>" class="btn bg-diglink rounded-pill w-100 mb-2 text-white"><?= $this->language->package->button->choose ?></a>
                        <?php endif ?>
                    </div>
                    <!--/.card-body -->
                </div>
            </div>
            <!--/.pricing -->
            <?php while($row = $result->fetch_object()): $settings = json_decode($row->settings);?>
                <div class="col-lg-3 col-md-6 col-sm-12 text-black">
                    <div class="pricing card shadow-lg">
                        <div class="card-body pt-8" >
                            <div class="prices text-dark">
                                <div class="price price-show">
                                    <span class="price-currency">Rp</span>
                                    <span class="price-value"><?= substr($row->monthly_price, 0, -3); ?>K</span> 
                                    <span class="price-duration">Bulan</span>
                                </div>
                                <div class="price price-hide price-hidden">
                                    <span class="price-currency">Rp</span>
                                    <span class="price-value"><?= substr($row->annual_price, 0, -3); ?>K</span> 
                                    <span class="price-duration">Tahun</span>
                                </div>
                            </div>
                            <!--/.prices -->
                            <h4 class="card-title mt-2"><?= $row->name; ?></h4>
                            <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                                <?php $result2 = \Altum\Database\Database::$database->query("SELECT * FROM `package_features` ORDER BY `package_features_id` ASC"); ?>
                                <?php while($row2 = $result2->fetch_object()):
                                $id = array($row->package_id);
                                $package_features_id = json_decode($row2->package_id, true);
                                if (in_array($id[0], $package_features_id)){
                                    echo '<li><i class="uil uil-check"></i><span>'.$row2->name.'</span></li>';
                                ?>
                                <?php } ?>
                                <?php endwhile ?>
                            </ul>
                            <?php if($row->package_id == $this->user->package_id): ?>
                                <button class="btn btn-success rounded-pill w-100 mb-2 text-white"><?= $this->language->package->button->already_free ?></button>
                            <?php else: ?>
                                <a href="<?= Authentication::check() ? url('pay/' . $row->package_id) : url('register?redirect=pay/' . $row->package_id) ?>" class="btn bg-diglink rounded-pill w-100 mb-2 text-white"><?= $this->language->package->button->choose ?></a>
                            <?php endif ?>
                            
                            <!-- <a href="#" class="btn bg-diglink rounded-pill w-100 mb-2 text-white">Choose Plan</a> -->
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.pricing -->
                </div>
            <?php endwhile ?>
        </div>
        <!--/.row -->
    </div>
    <!--/column -->
</div>
<!--/.row -->
