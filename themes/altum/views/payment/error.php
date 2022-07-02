<?php
/* echo '<pre>';
print_r($data->error);
echo '</pre>'; */
?>

<div class="container mt-5 d-flex justify-content-center">
	<div class="card border-0 w-100">
		<div class="card-body p-1">
			<div class="alert alert-danger" role="alert">
		  <?= $data->error->status_message ?>
		</div>
			<script>
				  window.setTimeout(function(){
					window.location.href = '<?= SITE_URL ?>'
				}, 30000);    

			
			</script>	
		</div>
	</div>
</div>