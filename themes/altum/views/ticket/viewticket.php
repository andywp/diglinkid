<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>

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
        <h6><?= $data->ticket->subject ?> - <?= $data->ticket->id ?></h6>
        <p class="text-muted">Ticket #<?= $data->ticket->id ?></p>
    </div>
</div>
<hr />
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
                                            <div class="ticket-requestor-name "><?= $data->ticket->name ?></div>
                                            <div class="badge bg-success">Owner</div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="title ">Department</div>
                                            <div class="ticket-requestor-name "><?= $data->ticket->department ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="title ">Submitted</div>
                                            <div class="ticket-requestor-name "><?= $data->ticket->date_create ?></div>
                                        </li>
                                        <?php if( $data->ticket->last_replay !=  '0000-00-00 00:00:00' ): ?>
                                        <li class="list-group-item">
                                            <div class="title ">Last Updated</div>
                                            <div class="ticket-requestor-name "><?= $data->ticket->last_replay ?></div>
                                        </li>
                                        <?php endif; ?>
                                        <li class="list-group-item">
                                            <div class="title ">Status/Priority</div>
                                            <div class="ticket-requestor-name "><span class="badge bg-success"><?= $data->ticket->status ?></span> <?= $data->ticket->priority ?></div>
                                        </li>
                                        <li class="list-group-item">
                                            <button type="button" class="btn btn-success btn-sm w-100 mb-2" data-bs-toggle="modal" data-bs-target="#replayTicket" data-bs-target="#staticBackdrop" <?= ($data->ticket->status == 'Closed' )?'disabled':'' ?> ><i class="fas fa-edit"></i> Replay</button>
                                            <button type="button" id="closeTicket" data-id="<?= $data->ticket->id ?>" class="btn btn-danger btn-sm w-100" ><i class="fas fa-times"></i> Close</button>
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
                    <div class="ticket-reply markdown-content  border-bottom p-2">
                        <div class="posted-by p-3 ">
                            Posted by <span class="posted-by-name fw-bold"><?= $data->ticket->name ?></span> On <span class="posted-on"><?= $data->ticket->date_create ?></span> <span class="badge bg-success float-md-end">Owner</span>
                        </div>
                        <div class="message p-3">
                            <?= $data->ticket->message ?>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
                 
                <?php foreach($data->replay as $r): ?>
                    <div class="card-body p-0">
                        <div id="replay<?= $r->replay_id ?>" class="ticket-reply markdown-content p-2 <?=  ($r->type == 'admin')?'staff':'client';  ?>">
                            <div class="posted-by p-3">
                                Posted by <span class="posted-by-name fw-bold"><?= $r->user_name ?></span> On <span class="posted-on"><?= $r->date_create ?></span> <?= ($r->type != 'admin')?'<span class="badge bg-success float-md-end">Owner</span>':'<span class="badge bg-info float-md-end">Operator</span>' ?> 
                            </div>
                            <div class="message p-3">
                                <?= $r->replay_message ?>

                                <div class="clearfix">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</section>
<?php ob_start() ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $( "#closeTicket").on( "click", function() {
        let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "do you want to close this ticket",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                //console.log(result.isConfirmed,'result.isConfirmed')
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= url('ticket/close') ?>',
                        data: {id:id},
                        dataType: 'json',
                        success: function(data){
                            success_noti('Ticket closed successfully');
                            if(!data.error){
                                window.setTimeout(function(){
                                    location.reload();
                                }, 3000);
                            }
                            else{
                                error_noti(data.alert);
                            }
                            
                        }
                    });
                }
            })
       
    });


</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>