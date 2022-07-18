<?php ob_start() ?>
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<div class="modal fade" id="replayTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog  modal-xl ">
        <form method="POST" action="" class="needs-validation" id="tiket" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reply Ticket #<?= $data->data->id?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Message</label>
                        <textarea id="editor" class="form-control" name="message" rows="5" required="required"></textarea>
                        <div class="invalid-feedback">
                            Please input Message
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tid" value="<?= $data->data->id ?>">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Replay</button>
                </div>
            </div>
        </form>
  </div>
</div>
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
        var xajaxFile = "<?= url('ticket/reply') ?>";
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