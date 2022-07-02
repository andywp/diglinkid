<?php defined('ALTUMCODE') || die() ?>

<div class="modal fade" id="update_project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= $this->language->update_project_modal->header ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form name="update_project" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                    <input type="hidden" name="request_type" value="update" />
                    <input type="hidden" name="project_id" value="" />

                    <div class="notification-container"></div>

                    <div class="form-group">
                        <label><i class="fa fa-fw fa-signature"></i> <?= $this->language->update_project_modal->input->name ?></label>
                        <input type="text" class="form-control" name="name"  />
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->global->submit ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php ob_start() ?>
<script>
    /* On modal show load new data */
    $('#update_project').on('show.bs.modal', event => {
        let project_id = $(event.relatedTarget).data('project-id');
        let name = $(event.relatedTarget).data('name');

        $(event.currentTarget).find('input[name="project_id"]').val(project_id);
        $(event.currentTarget).find('input[name="name"]').val(name);
    });

    $('form[name="update_project"]').on('submit', event => {

        $.ajax({
            type: 'POST',
            url: 'project-ajax',
            data: $(event.currentTarget).serialize(),
            success: (data) => {
                if (data.status == 'error') {
                    let notification_container = $(event.currentTarget).find('.notification-container');

                    notification_container.html('');

                    display_notifications(data.message, 'error', notification_container);
                }

                else if(data.status == 'success') {

                    /* Hide modal */
                    $('#update_project').modal('hide');

                    /* Clear input values */
                    $('form[name="update_project"] input').val('');

                    /* Fade out refresh */
                    redirect(`dashboard`);

                }
            },
            dataType: 'json'
        });

        event.preventDefault();
    })
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
