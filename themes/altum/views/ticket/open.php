<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Open Ticket</div>
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
        <!-- <h6><?= $this->language->dashboard->projects->header ?></h6>-->
        <p class="text-muted">Create new Support Request</p>
    </div>
</div>
<hr />

<section class="openticket">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="" class="needs-validation" id="tiket" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="nama" value="<?= $this->user->name ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="email" value="<?= $this->user->email  ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label>Subject</label>
                            <input type="text" class="form-control" name="subject" value="" required="required">
                            <div class="invalid-feedback">
                                 Please input Subject
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Department</label>
                            <select class="form-select" name="dep" required="required" style="padding: 0rem 1rem">
                                <option value="Support">Support</option>
                                <option value="Billing">Billing</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Priority</label>
                            <select class="form-select" name="priority" required="required" style="padding: 0rem 1rem">
                                <option value="High">High</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                    </div>
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
                            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                            <a class="btn btn-outline-danger mx-3" href="<?= url('ticket') ?>">Back</a>
                        </div>
                    </div>
                </div>
            </form>

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
        var xajaxFile = "<?= url('ticket/submit') ?>";
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
                    //$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
                    //window.location.href = data.url;
                    success_noti(data.alert);
                    window.setTimeout(function(){
                        window.location.href='<?= url('ticket/viewticket/') ?>'+data.id;
                    }, 1000);
                }
                else{
                    //$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
                    error_noti(data.alert);
                }
                
            }
        });
        return false;
    });


</script>

<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>