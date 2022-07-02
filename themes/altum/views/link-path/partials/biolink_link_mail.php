<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>

<div class="my-3">
    <a href="#" target="_blank" data-toggle="modal" data-target="#mail_<?= $link->link_id ?>" class="btn btn-block btn-primary link-btn <?= $link->design->link_class ?>" style="<?= $link->design->link_style ?>">

        <?php if($link->settings->icon): ?>
			<div class="float-right">
				<i class="<?= $link->settings->icon ?> mr-1"></i>
			</div>
        <?php endif ?>

        <?= $link->settings->name ?>
    </a>

</div>

<?php $html = ob_get_clean(); ?>


<?php ob_start() ?>
<div class="modal fade" id="mail_<?= $link->link_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= $link->settings->name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="mail_form_<?= $link->link_id ?>" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                    <input type="hidden" name="request_type" value="mail" />
                    <input type="hidden" name="link_id" value="<?= $link->link_id ?>" />
                    <input type="hidden" name="type" value="biolink" />
                    <input type="hidden" name="subtype" value="mail" />

                    <div class="notification-container"></div>

                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg" name="email" required="required" placeholder="<?= $link->settings->email_placeholder ?>" />
                    </div>

                    <?php if($link->settings->show_agreement): ?>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" id="agreement" name="agreement" class="mr-3" required="required" />
                        <label for="agreement" class="text-muted mb-0">
                            <a href="<?= $link->settings->agreement_url ?>">
                                <?= $link->settings->agreement_text ?>
                            </a>
                        </label>
                    </div>
                    <?php endif ?>

                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary"><?= $link->settings->button_text ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php \Altum\Event::add_content(ob_get_clean(), 'modals') ?>

<?php return (object) ['html' => $html] ?>

