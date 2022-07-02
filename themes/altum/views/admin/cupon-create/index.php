<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="<?= url(ASSETS_URL_PATH . 'js/bootstrap-input-spinner.js') ?>"></script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
<div class="d-flex justify-content-between">
    <h1 class="h3"><i class="fa fa-xs fa-book text-gray-700"></i> Cupon Create</h1>
</div>
<div class="card border-0 shadow-sm my-5 mb-5">
	<div class="card-body mb-5">
	<?php  display_notifications()  ?>
		<form action="" method="post" role="form" autocomplete="off">
			<input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
			<div class="form-group">
				<label>Cupon</label>
				<input type="text" id="upper" name="cupon" class="form-control form-control-lg" value="" required="required" autocomplete="off">
			</div>
			<div class="form-group">
				<label>Validity period</label>
				<div class="input-group input-daterange row">
					<div class="col">
						<input type="text" id="startDate" class="form-control" name="start_date" value="<?= date('Y-m-d') ?>" autocomplete="off" required>
					</div>
					<div class="col">
						<input type="text" id="endDate" class="form-control " name="end_date" value="<?= date('Y-m-d') ?>" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Diskon %</label>
				<input type="number" min="0" max="100" onkeypress="return intOnly(event)" name="diskon" max="2" class="form-control form-control-lg" value="" required="required" autocomplete="off">
			</div>
			<div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary">Save Cupon</button>
            </div>
			
		</form>
	</div>
</div>

<?php display_notifications() ?>

<?php ob_start() ?>
<script>
$( document ).ready(function() {
	  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
			format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function () {
                return $('#endDate').val();
            }
        });
        $('#endDate').datepicker({
			format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#startDate').val();
            }
        });
		 $('#upper').keyup(function() {
			this.value = this.value.toUpperCase();
		});
		/* $('input[type=text]').val (function () {
			return this.value.toUpperCase();
		}) */
		$("input[type='number']").inputSpinner();
		
});

function intOnly(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;
  return true;
}

</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>