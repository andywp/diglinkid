<?php defined('ALTUMCODE') || die() ?>

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
</div>

<hr/>


<section class="ticket">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="DataTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Department</th>
							<th>Subject</th>
							<th>Status</th>
							<th>Last Update</th>
						</tr>
					</thead>

				</table>
			</div>
		</div>
	</div>
</section>



<?php ob_start() ?>
<script>
	$( document ).ready(function() {
		$('#DataTable').DataTable();
	});	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


