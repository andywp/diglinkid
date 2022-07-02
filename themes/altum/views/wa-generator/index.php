<?php
@date_default_timezone_set('Asia/Jakarta');
?>
<section id="secID">
	<div class="container-fluid">
		<div  >
			<div class="row">
				<div class="col-sm-12 col-md-6 order-2 order-md-1">
					<div class="chat-wa pl-5 pt-5 pr-5">
						<div>
							<h2 class="h3 mb-5 mt-5">Buat link WhatsApp</h2>
						</div>
						<div class="msg-alert"></div>
						<form action="" method="post" id="generatorWa" class="from " autocomplete="off">
							<div class="form-row ">
								<div class="form-group w-100">
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										  <div class="input-group-text">62</div>
										</div>
										<input id="phone" type="text" name="phone" onkeypress="return intOnly(event)" class="form-control form-control-lg" id="input_phone" placeholder="Phone" autocomplete="off">
									</div>
								</div>
								<div class="form-group w-100">
									 <textarea name="pesan" class="form-control form-control-lg" id="pesan" rows="3" placeholder="Pesan Anda Disini" ></textarea>
								</div>
								<input type="hidden" name="code" id="phone-code" value="62">
								<button type="submit" class="btn btn-primary">Buat Link</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 order-1 order-md-2 d-none d-md-block">
					<div class="row">
						<div class="preview">
							<div class="hp">
								<div class="h-100">
									<div class="contact-bar">
										<div class="back-chat">
											<i class="zmdi zmdi-arrow-left"></i>
										</div>
										<div class="avatar">
											<img src="<?= url(ASSETS_URL_PATH . 'img/default-avatar.png') ?>" alt="Avatar">
										</div>
										<div id="contact" class="contact"><span>+1234567</span></div>
										<div class="actions img"></div>
									</div>
									<div class="obrolan">
										<div class="obrolan-container">
											<div class="message sent">
												<span id="message">Pesan Anda Disini ...</span>
												<span class="metadata"><span class="time"><?= date("h:i A") ?></span>
												<span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"></path></svg></span></span>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="result" style="display:none" >
	<div class="container">
		<div>
			<h2 class="h3 mb-5 mt-5">link WhatsApp Anda</h2>
		</div>
		<div class="card card pt-5 pb-5 pr-2 pl-2">
			<div class="card-body">
				<div class="alert alert-primary" role="alert">
				  Link WhatsApp berhasil dibuat
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="text" id="result-link" class="form-control">
						<div class="input-group-btn">
							<button data-clipboard-target="#result-link" id="btnCopy" class="btn btn-primary" alt="Copy to clipboard">
							Copy Link
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<section>


