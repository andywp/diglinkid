<?php defined('ALTUMCODE') || die() ?>

<div class="modal fade" id="user_login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-sm fa-sign-in-alt text-gray-700"></i>
                    <?= $this->language->admin_user_login_modal->header ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="text-muted"><?= $this->language->admin_user_login_modal->subheader ?></p>

                <div class="mt-4">
                    <a href="" id="user_login_url" class="btn btn-lg btn-block btn-primary"><?= $this->language->global->login ?></a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php ob_start() ?>
<script>
    /* On modal show load new data */
    $('#user_login').on('show.bs.modal', event => {
        let user_id = $(event.relatedTarget).data('user-id');
        let url = $('input[name="url"]').val();
        let global_token = $('input[name="global_token"]').val();

        $(event.currentTarget).find('#user_login_url').attr('href', `${url}admin/users/login/${user_id}&global_token=${global_token}`);
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
