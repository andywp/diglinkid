<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>

<div class="my-3 link-iframe-round">
    <blockquote class="tiktok-embed" data-video-id="<?= $embed ?>">
        <section></section>
    </blockquote>

    <script defer src="https://www.tiktok.com/embed.js"></script>
</div>

<?php $html = ob_get_clean(); ?>

<?php return (object) ['html' => $html] ?>

