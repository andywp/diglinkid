<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<pre>
    <?php print_r($data->tiket) ?>
</pre>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">View Ticket</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>"><i class="lni lni-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url('ticket') ?>">Support Ticket</a></li>
                <!--<li class="breadcrumb-item active" aria-current="page"><?= sprintf($this->language->link->header->header, url('ticket')) ?></li> -->
            </ol>
        </nav>
    </div>
    <!-- div class="ms-auto">
			<a href="<?= url('ticket/open') ?>" class="btn btn-outline-primary">Open Ticket</a>
	</div> -->
</div>
<div class="mt-3 d-flex justify-content-between">
    <div class="col">
        <h6><?= $data->tiket->subject ?> | #<?= $data->tiket->id ?></h6>
        <p class="text-muted">Ticket #<?= $data->tiket->id ?></p>
    </div>
</div>
<hr/>

<section class="view-ticket">
    <div class="row">
        <div class="col-md-3">
            <div class="card border">
                <div class="card-body p-0">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-white text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Ticket Information
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            <div class="title ">Requestor</div>
                                            <div class="ticket-requestor-name "><?= $data->tiket->name ?></div>
                                            <div class="badge bg-success">Owner</div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="title ">Department</div>
                                            <div class="ticket-requestor-name "><?= $data->tiket->department ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="title ">Submitted</div>
                                            <div class="ticket-requestor-name "><?= $data->tiket->date_create ?></div>
                                        </li>
                                        <?php if($data->tiket->last_replay != '0000-00-00 00:00:00'): ?>
                                        <li class="list-group-item">
                                            <div class="title ">Last Updated</div>
                                            <div class="ticket-requestor-name ">1 year ago</div>
                                        </li>
                                        <?php endif; ?>
                                        <li class="list-group-item">
                                            <div class="title ">Status/Priority</div>
                                            <div class="ticket-requestor-name "><span class="badge bg-success">Close</span> Medium</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card border">
                <div class="card-body  p-0">
                    <div class="ticket-reply markdown-content staff border-bottom p-2">
                        <div class="posted-by p-3 ">
                            Posted by <span class="posted-by-name fw-bold">admin diglink</span> On <span class="posted-on">05/09/2020 (01:51)</span> <span class="badge bg-info float-md-end">Operator</span>
                        </div>
                        <div class="message p-3">
                            <p>Halo andi wijang,</p>
                            <p>Layanan domain dan hosting Anda telah berhasil kami perpanjang. <br>
                                Silakan cek inbox email Anda untuk informasi selengkapnya.</p>
                            <p>Silakan hubungi kami jika membutuhkan bantuan lainnya.<br>
                                Terimakasih atas kepercayaan anda kepada DomaiNesia.</p>
                            <p>Salam,<br>
                                Aswandhi A.<br>
                                DomaiNesia<br>
                                Twitter: @domainesia | Facebook: DomaiNesia | Instagram : @domainesia</p>
                            <p>Suka dengan layanan DomaiNesia? Beri tahu orang lain dengan mengulas DomaiNesia di Google <a href="https://dnva.me/ulasdigoogle" class="autoLinked" target="_blank" rel="noreferrer noopener">https://dnva.me/ulasdigoogle</a> dan Facebook <a href="https://dnva.me/ulasdifacebook" class="autoLinked" target="_blank" rel="noreferrer noopener">https://dnva.me/ulasdifacebook</a>, terima kasih!</p>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="ticket-reply markdown-content p-2">
                        <div class="posted-by p-3">
                            Posted by <span class="posted-by-name fw-bold">admin diglink</span> On <span class="posted-on">05/09/2020 (01:51)</span> <span class="badge bg-info float-md-end">Operator</span>
                        </div>
                        <div class="message p-3">
                            <p>Halo andi wijang,</p>
                            <p>Layanan domain dan hosting Anda telah berhasil kami perpanjang. <br>
                                Silakan cek inbox email Anda untuk informasi selengkapnya.</p>
                            <p>Silakan hubungi kami jika membutuhkan bantuan lainnya.<br>
                                Terimakasih atas kepercayaan anda kepada DomaiNesia.</p>
                            <p>Salam,<br>
                                Aswandhi A.<br>
                                DomaiNesia<br>
                                Twitter: @domainesia | Facebook: DomaiNesia | Instagram : @domainesia</p>
                            <p>Suka dengan layanan DomaiNesia? Beri tahu orang lain dengan mengulas DomaiNesia di Google <a href="https://dnva.me/ulasdigoogle" class="autoLinked" target="_blank" rel="noreferrer noopener">https://dnva.me/ulasdigoogle</a> dan Facebook <a href="https://dnva.me/ulasdifacebook" class="autoLinked" target="_blank" rel="noreferrer noopener">https://dnva.me/ulasdifacebook</a>, terima kasih!</p>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>