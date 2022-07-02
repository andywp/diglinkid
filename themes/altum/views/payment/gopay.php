<?php
/* echo '<pre>';
print_r($data->payment);
echo '</pre>'; */

$gopay = unserialize(base64_decode($data->payment->return_api));
/*  echo '<pre>';
print_r($gopay);
echo '</pre>';  */

if($data->payment->status == 'settlement'){
	
	
	
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
	var datatrans='<?= base64_encode($gopay->actions[2]->url) ?>';

</script>


<div class="container mt-5 d-flex justify-content-center">
	<div class="card border-0 w-100">
		<div class="card-body p-1">
			<h3 class="mb-3">Metode Pembayaran Gopay</h3>
			<div class="">
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
								<small><?= $data->payment->status ?> Metode Pembayaran <?= $data->payment->processor ?> </small>
							</td>
							<td class="text-right font-weight-bold"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<?php if($data->payment->status !='settlement'){ ?>
			<div id="barcode" class="mb-5 ">
				<div class="text-center gopay-qr">
					<p>kode QR</p>
					<a href="<?= $gopay->actions[1]->url ?>">
						<img src="<?= $gopay->actions[0]->url ?>" class="rounded mx-auto d-block" alt="">
					</a>
				</div>
			</div>
			<?php } ?>
			<div class="msg-alert"></div>
			<?php if($data->payment->status =='settlement'){ ?>
			<script>
				  window.setTimeout(function(){
					window.location.href = '<?= SITE_URL ?>invoice/<?= $data->payment->id ?>'
				}, 2000);    

			
			</script>
			
			
			<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span>Transaction settlement <?= $data->payment->date  ?></div>
			<?php } ?>
			
			
			<div class="mb-5 text-center d-block"  >
				<?php if($data->payment->status !='settlementa'){ ?>
				<a target="blank" href="<?= $gopay->actions[1]->url ?>" class="btn btn-info d-none-lg d-none-xl d-none-lg d-none-md">Open Gojek</a>
				<button data-id="<?= base64_encode($gopay->actions[2]->url) ?>" id="cekPembayaran"  class="btn btn-info">Cek Pembayaran</button>
				<?php }else{ ?>
					<a href="<?= SITE_URL.'invoice/'.$data->payment->id ?>" class="btn btn-info d-none-lg d-none-xl d-none-lg d-none-md">invoice</a>
				
				<?php } ?>
			</div>
			
			<div class="cara=bayar mb-3">
				<h3 class="mb-3">Cara Bayar</h3>
				<div class="row">
					<div class="col-12 col-lg-6">
						<img src="<?= url(UPLOADS_URL_PATH . '/gopay_qr_pay.png') ?>" class="img-fluid mb-3" alt="Responsive image">
					</div>
					<div class="col-12 col-lg-6">
						<ol>
							<li>Buka aplikasi <strong>Gojek</strong> pada SmartPhone anda</li>
							<li>Klik <strong>Pay</strong> lalu scan kode QR</li>
							<li>Cek kembali rincian pembayaran anda dan klik <strong>PAY</strong></li>
							<li>Masukan <strong>PIN</strong> anda</li>
							<li>Transaksi anda telah selesai</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="cex-btn">

			</div>
		</div>
	</div>
</div>