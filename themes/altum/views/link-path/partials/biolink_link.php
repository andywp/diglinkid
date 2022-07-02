<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>

<div class="my-3">
    <a target="_blank" href="<?= $link->location_url ?>" data-location-url="<?= $link->url ?>" class="btn btn-block btn-primary link-btn <?= $link->design->link_class ?>" style="<?= $link->design->link_style ?>">

        <?php if($link->settings->icon): ?>
			<div class="float-right">
				<i class="<?= $link->settings->icon ?> mr-3"></i>
			</div>
        <?php endif ?>

        <?= $link->settings->name ?>
    </a>
</div>

<?php $html = ob_get_clean(); ?>

<?php return (object) ['html' => $html] ?>

