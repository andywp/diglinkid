<?php defined('ALTUMCODE') || die() ?>
<div class="d-flex justify-content-between">
    <h1 class="h3"><i class="fa fa-xs fa-link text-gray-700"></i> Cupon Management</h1>
	 <div class="col-auto">
        <a href="<?= url('admin/cupon-create') ?>" class="btn btn-primary rounded-pill"><i class="fa fa-plus-circle"></i> Create Cupon</a>
    </div>
	
</div>
<p class="text-muted">set your coupon</p>
<?php display_notifications() ?>
<?php

$hal=$data->packages_result->fetch_all(MYSQLI_ASSOC)
?>
<div class="mt-5 table-responsive table-custom-container">
	<table id="results" class="table table-custom">
		<thead>
        <tr>
            <th>Cupon</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Diskon</th>
            <th></th>
        </tr>
        </thead>
		<tbody>
			
			<?php foreach($hal as $r) { ?>
			<tr>
				<td><?= $r['cupon'] ?> </td>
				<td><?= $r['start_date'] ?> </td>
				<td><?= $r['end_date'] ?> </td>
				<td><?= $r['diskon'] ?> %</td>
				 <td><div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="text-secondary dropdown-toggle dropdown-toggle-simple">
                        <i class="fas fa-ellipsis-v"></i>
                        
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="admin/cupon-edit/<?= $r['id'] ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <a href="#" data-toggle="modal" data-target="#cupon-delete" data-id="<?= $r['id'] ?>" class="dropdown-item"><i class="fa fa-times"></i>Delete</a>
                        </div>
                    </a>
                </div></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>


<div class="modal fade" id="cupon-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-sm fa-trash-alt text-gray-700"></i>
                    Delete Cupon
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= $this->language->global->close ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-muted">Delete cupon</p>

                <div class="mt-4">
                    <a href="" id="pages_category_delete_url" class="btn btn-lg btn-block btn-danger"><?= $this->language->global->delete ?></a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/datatables.min.css') ?>" rel="stylesheet" media="screen">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/datatables.min.js') ?>"></script>


<script>
	$('#results').DataTable();

    /* On modal show load new data */
    $('#cupon-delete').on('show.bs.modal', event => {
        let pages_category_id = $(event.relatedTarget).data('id');
        let url = $('input[name="url"]').val();
        let global_token = $('input[name="global_token"]').val();

        $(event.currentTarget).find('#pages_category_delete_url').attr('href', `${url}admin/cupon/delete/${pages_category_id}&global_token=${global_token}`);
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
