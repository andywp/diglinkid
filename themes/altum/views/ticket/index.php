<?php defined('ALTUMCODE') || die() ?>

<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">
	<div class="container pt-18 pb-16"style="z-index: 5; position:relative">
		<nav aria-label="breadcrumb">
			<small>
				<ol class="custom-breadcrumbs">
					<li><a href="<?= url('dashboard') ?>"><?= $this->language->dashboard->breadcrumb ?></a> <i class="fa fa-angle-right"></i></li>
					<li class="active" aria-current="page">Ticket</li>
				</ol>
			</small>
		</nav>
		<div class="d-flex justify-content-between">
			<h1 class="h3 text-center text-white">Ticket</h1>
		</div>
		<?php display_notifications() ?>
		<div class="notification-container msg-alert"></div>
		<form method="POST" action="" id="tiket" >
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="nama" value="<?= $this->user->name ?>"  disabled="disabled">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Whatsapp number</label>
						<input type="text" class="form-control" name="whatsapp" required="required">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Subject</label>
						<input type="text" class="form-control" name="subject" value="" required="required">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Department</label>
						<select class="form-control" name="dep" required="required" style="padding: 0rem 1rem">
						<option value="Support" >Support</option>
						<option value="Billing" >Billing</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Priority</label>
						<select class="form-control" name="priority" required="required" style="padding: 0rem 1rem">
						<option value="High" >High</option>
						<option value="Medium" selected>Medium</option>
						<option value="Low" >Low</option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Message</label>
						<textarea class="form-control" name="message" rows="5" required="required"></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="d-flex justify-content-center">
						<input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>



<?php ob_start() ?>
<script>
	$( document ).ready(function() {
		$("#tiket").submit(function(){
			var xajaxFile = "/ticket/saved";
			$('.msg-alert').html('');
			$.ajax({
				type: 'POST',
				url: xajaxFile,
				data: $("#tiket").serialize(),
				dataType: 'json',
				success: function(data){
					if(!data.error){
						$(":input","#tiket")
						.not(":button, :submit, :reset, :hidden")
						.val("")
						.removeAttr("checked")
						.removeAttr("selected");
						$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
						
						window.location.href = data.url;
						
					}
					else{
						$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
					}
					
				}
			});
			return false;
		});
		
	});	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


