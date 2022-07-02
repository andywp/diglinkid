<?php
global $config;

//echo $config['urlgopay'].$data->payment->transaction_id.'/status';
/* echo '<pre>';
print_r($data->payment);
echo '</pre>'; 
 */
$va = unserialize(base64_decode($data->payment->return_api));
/* echo '<pre>';
print_r($va);
echo '</pre>';  */
 
$virtualCode='';
if($data->payment->processor == 'bca' || $data->payment->processor == 'bni'  ){
	$virtualCode=$va ->va_numbers[0]->va_number;

	
}
if($data->payment->processor == 'mandiri' ){
	$bill_key=$va ->bill_key;
	$biller_code=$va ->biller_code;
	
	$virtualCode='<b>'.$biller_code.'    '.$bill_key.'</b>';
	
}
if($data->payment->processor == 'permata' ){
	$virtualCode='<b>'.$va->permata_va_number.'</b>';
	
}






?>
<?php defined('ALTUMCODE') || die() ?>
<style>
	.gopay-qr img {
		width: 400px;
	}
	@media only screen and (max-width: 768px) {
		.gopay-qr img {
			width: 200px;
		}
	}
</style>

<script>
	var datatrans='<?= base64_encode($config['urlgopay'].$data->payment->transaction_id.'/status') ?>';

</script>



<div class="container mt-5 d-flex justify-content-center">
	<div class="card border-0 w-100">
		<div class="card-body p-1">
			<div class="msg-alert"></div>
			<?php if($data->payment->status =='settlement'){ ?>
			<script>
				  window.setTimeout(function(){
					window.location.href = '<?= SITE_URL ?>invoice/<?= $data->payment->id ?>'
				}, 2000);    

			
			</script>
			
			
			<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span>Transaction settlement <?= $data->payment->date  ?></div>
			<?php } ?>
			<h3 class="mb-5">Metode Pembayaran Virtual Account <?= strtoupper($data->payment->processor)  ?></h3>
			<div class="">
				<div class="alert alert-primary text-center mb-3" role="alert">
				 <h4> Your Virtual Account: <?= $virtualCode  ?></h4>
				</div>
				<table class="table invoice-table">
					<thead>
						<tr>
							<th>Item</th>
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Package <?= $data->payment->packages ?> , <?= $data->payment->plan ?></td>
							<td class="text-right"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td class="d-flex flex-column">
								<span class="font-weight-bold"><?= $this->language->invoice->table->total ?></span>
								<small><?= $data->payment->status ?> Metode Pembayaran <?= strtoupper($data->payment->processor) ?>  Virtual Account </small>
							</td>
							<td class="text-right font-weight-bold"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="mb-5 mt-5 text-center d-block"  >
				<?php if($data->payment->status !='settlementa'){ ?>
				
				<button data-id="<?= base64_encode($config['urlgopay'].$data->payment->transaction_id.'/status') ?>" id="cekPembayaran"  class="btn btn-info">Cek Pembayaran</button>
				<?php }else{ ?>
					<a href="<?= SITE_URL.'invoice/'.$data->payment->id ?>" class="btn btn-info d-none-lg d-none-xl d-none-lg d-none-md">invoice</a>
				
				<?php } ?>
			</div>
	</div>
</div>