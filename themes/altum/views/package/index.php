<?php defined('ALTUMCODE') || die() ?>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">  
    <div class="container pt-18 pb-16" style="z-index: 5; position:relative">  
       
            <?php display_notifications() ?>

            <?php if($this->user->package_is_expired && $this->user->package_id != 'free'): ?>
                <div class="alert alert-info" role="alert">
                    <?= $this->language->global->info_message->user_package_is_expired ?>
                </div>
            <?php endif ?>

            <?php if($data->type == 'new'): ?>

                <h1 class="h3 text-white"><?= $this->language->package->header_new ?></h1>
                <span class="text-white"><?= $this->language->package->subheader_new ?></span>

            <?php elseif($data->type == 'upgrade'): ?>

                <h1 class="h3 text-white"><?= $this->language->package->header_upgrade ?></h1>
                <span class="text-white"><?= $this->language->package->subheader_upgrade ?></span>

            <?php elseif($data->type == 'renew'): ?>

                <h1 class="h3 text-white"><?= $this->language->package->header_renew ?></h1>
                <span class="text-white"><?= $this->language->package->subheader_renew ?></span>

            <?php endif ?>

            <?= $this->views['packages'] ?>
    
    </div>
</section>
