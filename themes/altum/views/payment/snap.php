
<?php
/* echo '<pre>';
	print_r($data->payment);
echo '</pre>'; */
 
$nama=explode(' ',$data->payment->name);
$namaDepan=$nama[0]; 
$namaBelakang=str_replace($namaDepan,'',$data->payment->name);
$potongan=''; 
 
 
 ?>

 <div class="container mt-5 d-flex justify-content-center">
	<div class="card border-0 w-100">
		<div class="card-body p-1">
			<h3 class="mb-3">Check out</h3>
			<div class="">
				<div class="msg-alert"></div>
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
						<?php if(!empty($data->payment->discount) && !empty($data->payment->voucher) ){ 
							$potongan=' Discount '.$data->payment->discount.'% Voucher '.$data->payment->voucher;
							$discount=($data->payment->discount / 100 ) * $data->payment->amount;
							$data->payment->amount = $data->payment->amount - $discount;
						?>
						<tr>
							<td>Discount Voucher <b><?= $data->payment->voucher ?> </b> <?= $data->payment->discount ?>%  </td>
							<td class="text-right"><?= $discount . ' ' . $data->payment->currency ?></td>
						</tr>
						
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td class="d-flex flex-column">
								<span class="font-weight-bold"><?= $this->language->invoice->table->total ?></span>
							</td>
							<td class="text-right font-weight-bold"><?= $data->payment->amount . ' ' . $data->payment->currency ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class=" d-flex justify-content-center mb-5 mt-t">
				<button  id="paynow"  class="btn btn-info mr-5">Bayar Sekarang</button>

			</div>
			
			
		</div>
	</div>
</div>
<script>
	var requestBody = 
    {
      "transaction_details": {
			"gross_amount": <?= $data->payment->amount ?>,
			"order_id": "<?= $data->payment->id.'-'.time() ?>"
      },
	   "item_details": [{
			"id": "<?= $data->payment->package_id ?>",
			"price": <?= $data->payment->amount ?>,
			"quantity": 1,
			"name": "<?= $data->payment->packages.$potongan ?>",
			"brand": "Diglink",
			"category": "Diglink",
			"merchant_name": "Diglink"
	  }],
		"customer_details": {
			"first_name": "<?= $namaDepan ?>",
			"last_name": "<?= $namaBelakang ?>",
			"email": "<?= $data->payment->email ?>",
			"phone": "",
		},
		"custom_field1": "Payment For:",
		"custom_field2": "Diglink",
		"custom_field3": "Name :",
		"custom_field4": "<?= $data->payment->name ?>",
		"callbacks": {
			"finish": "<?= SITE_URL ?>payment/finish"
		  },
	  
	  
    };
	
	//console.log(requestBody);


</script>