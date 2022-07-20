<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>


<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
	<div class="breadcrumb-title pe-3">Support Ticket</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="<?= url('dashboard') ?>"><i class="lni lni-home"></i></a></li>
				<!--<li class="breadcrumb-item"><a href="<?= url('ticket') ?>">Support Ticket</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= sprintf($this->language->link->header->header, url('ticket')) ?></li> -->
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
			<a href="<?= url('ticket/open') ?>" class="btn btn-outline-primary">Open Ticket</a>
	</div>
</div>

<hr/>


<section class="ticket">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-list" class="table table-striped table-bordered table-list">
					<thead>
						<tr>
							<th>Department</th>
							<th>Subject</th>
							<th>Status</th>
							<th>Last Update</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data->data as $r): ?>
							<tr data-id="<?= $r->id ?>" id="tiketid<?= $r->id ?>"  class="ticketRow <?= ($r->open != 1)?'is_new':'' ?>" >
								<td><?= $r->department ?></td>
								<td><?= $r->subject ?></td>
								<td><?= $r->status ?></td>
								<td><?= $r->last_replay ?></td>
							</tr>

						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>



<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>

<script>
	$( document ).ready(function() {
		$('#table-list').DataTable();

		$( ".ticketRow").on( "click", function() {
			let id=$(this).data('id');
			console.log('id',id);
			$.ajax({
				type: 'POST',
				url: '<?= url('ticket/isopen') ?>',
				data: {id:id},
				dataType: 'json',
				success: function(data){
				}
			});

			$('#tiketid'+id).removeClass('is_new');

			window.location='<?= url('ticket/viewticket/') ?>'+id;
		});


	});	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


