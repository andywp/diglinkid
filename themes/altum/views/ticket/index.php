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
							<tr onclick="window.location='<?= url('ticket/viewticket/'.$r->id) ?>'" >
								<td><?= $r->department ?></td>
								<td><?= $r->subject ?></td>
								<td><?= $r->status ?></td>
								<td><?= $r->date_create ?></td>
							</tr>

						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>



<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>

<script>
	$( document ).ready(function() {
		$('#table-list').DataTable();
	});	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


