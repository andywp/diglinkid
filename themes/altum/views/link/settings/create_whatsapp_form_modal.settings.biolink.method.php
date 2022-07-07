<?php defined('ALTUMCODE') || die() ?>

<div class="modal fade" id="create_biolink_whatsapp_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Whatsapp Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <p class="text-muted modal-subheader">Buat Whatsapp Form</p>
            <div class="modal-body">
                <form name="create_biolink_whatsapp_form" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                    <input type="hidden" name="request_type" value="create" />
                    <input type="hidden" name="link_id" value="<?= $data->link->link_id ?>" />
                    <input type="hidden" name="type" value="biolink" />
                    <input type="hidden" name="subtype" value="whatsapp_form" />

                    <div class="notification-container"></div>

                    <div class="form-group">
                        <label><i class="fa fa-signature"></i>Judul Form</label>
                        <input type="text" class="form-control" name="url" required="required" placeholder="Masukan judul form" />
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-signature"></i>Nomor Whatsapp contoh 628123456754 </label>
                        <input type="text" class="form-control" name="location_url" required="required" placeholder="Masukan Nomor Whatsapp" />
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-outline-primary">Add Whatsapp Form</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<?php ob_start() ?>
<script>
    $('form[name="create_biolink_whatsapp_form"]').on('submit', event => {

        $.ajax({
            type: 'POST',
            url: 'link-ajax',
            data: $(event.currentTarget).serialize(),
            success: (data) => {
                if(data.status == 'error') {

                    let notification_container = $(event.currentTarget).find('.notification-container');

                    notification_container.html('');

                    display_notifications(data.message, 'error', notification_container);

                }

                else if(data.status == 'success') {

                    /* Fade out refresh */
                    fade_out_redirect({ url: data.details.url, full: true });

                }
            },
            dataType: 'json'
        });

        event.preventDefault();
    })
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
