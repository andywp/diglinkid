<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
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
                                            <div class="ticket-requestor-name "><a href="<?= url('admin/user-view/'.$data->tiket->user_id) ?>" target="_blank"><?= $data->tiket->name ?></a></div>
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
                                            <div class="ticket-requestor-name "><span class="badge bg-success"><?= $data->tiket->status  ?></span> <?= $data->tiket->priority  ?></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                              
            <div class="card border">
                <div class="card-body p-0">
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-white text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseService" aria-expanded="true" aria-controls="collapseService">
                                    Service Information
                                </button>
                            </h2>
                            <div id="collapseService" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            <div class="title ">Paket</div>
                                            <div class="ticket-requestor-name "><?= $data->service->package_id ?></div>
                                            <!-- <div class="badge bg-success">Owner</div> -->
                                        </li>
                                        <li class="list-group-item">
                                            <div class="title ">expiration</div>
                                            <div class="ticket-requestor-name "><?= $data->service->package_expiration_date ?></div>
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
                            Posted by <span class="posted-by-name fw-bold"><?= $data->tiket->name ?></span> On <span class="posted-on"><?= $data->tiket->date_create ?></span> <span class="badge bg-info float-md-end">Owner</span>
                        </div>
                        <div class="message p-3">
                            <?=  $data->tiket->message ?>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
                                           
                <?php foreach($data->replay as $r): ?>
                    <div id="replayid<?= $r->replay_id ?>" class="card-body p-0">
                        <div class="ticket-reply markdown-content p-2">
                            <div class="posted-by p-3">
                                Posted by <span class="posted-by-name fw-bold"><?= $r->user_name ?></span> On <span class="posted-on"><?= $r->date_create ?></span> <span class="badge bg-info float-md-end"><?= ($r->type == 'admin')?'Admin':'Owner' ?></span>
                            </div>
                            <div class="message p-3">
                                <?= $r->replay_message ?>
                                <div class="clearfix">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  endforeach; ?>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="" class="needs-validation" id="tiket" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Message</label>
                                        <textarea id="editor" class="form-control" name="message" rows="5" required="required"></textarea>
                                        <div class="invalid-feedback">
                                            Please input Message
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-center">
                                        <input type="hidden" name="tid" value="<?= $data->tiket->id ?>">
                                        <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                                        <button type="submit" class="btn btn-outline-primary">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>




                                            <!--
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
                            -->

            </div>


        </div>
    </div>
</section>

<?php ob_start() ?>
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script>
const setting = 
            {         
                  toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],        
                  heading: {             
                          options: [                 
                           { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },                 
                           { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },                 
                           { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }             
                   ]         
              }     
           };



ClassicEditor
     .create( document.querySelector( '#editor'),setting)
     .then( editor => {
        //console.log( editor );
     } )
     .catch( error => {
         console.error( error );
     } );

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    });

  $("#tiket").submit(function(){
        var xajaxFile = "<?= url('admin/ticket/replay') ?>";
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
                    success_noti(data.alert);
                    window.setTimeout(function(){
                        location.reload();
                    }, 3000);
                }
                else{
                    error_noti(data.alert);
                }
                
            }
        });
        return false;
    });

    //success_noti('aaa');
</script>

<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>