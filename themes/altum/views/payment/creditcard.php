
<?php
/* echo '<pre>';
print_r($data);
echo '</pre>'; */
?>

<script> var datatrans=''; </script>



<div class="container mt-5 d-flex justify-content-center bg-white">
	<div class="col-md-10">
		<div class="card border-0 w-100">
			<div class="card-body p-5">
				<h3 class="mb-5 mt-5">Credit Card</h3>
				<form id="creditcard" class="d-block pt-5 pb-5" method="post">
					<div class="msg-alert"></div>
					<div class="from-group">
						<label>Card number</label>
						<input type="tel" name="cardnumber" value="" id="cardnumber" placeholder="4811 1111 1111 1114" class="form-control" required>
					</div>
					<div class="row">
						<div class="col-7">
							<div class="from-group">
								</span><label>Expiry date</label>
								<input type="tel" placeholder="MM / YY" id="expiredate"  class="form-control" required>
							</div>
						</div>
						<div class="col-5">
							<div class="from-group">
								</span><label>CVV</label>
								<input type="tel" maxlength="6" inputmode="numeric" placeholder="123" id="cvv" class="form-control" value="" style="font-family: cvvpass;" required>
							</div>
						</div>
					
					</div>
					<div class="form-grub pt-5 pb-5">
							<input type="hidden" id="transaksi" value="<?= $data->data->id ?>" required>
							<input type="hidden" id="amount" value="<?= $data->data->amount ?>" required>
						 <button type="submit" class="btn btn-primary ">Pay Now</button>
					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

