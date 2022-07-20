<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'dist/bs-pagination.min.css') ?>" rel="stylesheet">
<style>
    #btnsearch .fa-times{
        display: block;
    }
    #btnsearch .fa-search{
        display: none;
    }
    #btnsearch.collapsed .fa-times{
        display: none !important;
    }
    #btnsearch.collapsed .fa-search{
        display: block;
    }
    #btnsearch{
        color: #e72e2e;
        border-color: #e72e2e;
    }
    #btnsearch:hover ,  #btnsearch:focus{
        color: #fff;
        background-color: #e72e2e;
        border-color: #e72e2e;
    }
    #btnsearch.collapsed{
        color: #32bfff;
        border-color: #32bfff;
    }
    #btnsearch.collapsed:hover , #btnsearch.collapsed:focus {
        color: #000 !important;
        background-color: #32bfff !important;
        border-color: #32bfff !important;
        box-shadow: 0 0 0 0.25rem rgb(13 202 240 / 50%) !important;
    }

</style>
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>


    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
        <div class="breadcrumb-title pe-3"><?= sprintf($this->language->dashboard->header->header, $this->settings->title) ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-home"></i></a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <?php require THEME_PATH . 'views/partials/ads_header.php' ?>

    <div clasa="accordion" id="accordionExample">
        <div class="mt-3 d-flex justify-content-between ">
            <div class="col">
                <h6><?= $this->language->dashboard->projects->header ?></h6>
                <p class="text-muted"><?= $this->language->dashboard->projects->subheader ?></p>
            </div>
            <div class="col-auto p-0 d-none">
                <button id="btnsearch" class="btn btn-outline-info mx-2 btn-lg collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fas fa-search"></i> <i class="fas fa-times"></i></button>
            </div>
            <div class="col-auto p-0">
                <!--
                <?php if($this->user->package_settings->projects_limit != -1 && $data->projects_result->num_rows >= $this->user->package_settings->projects_limit): ?>
                    <button type="button" data-confirm="<?= $this->language->project->error_message->projects_limit ?>"  class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->dashboard->projects->create ?></button>
                <?php else: ?>
                    <button type="button" data-bs-toggle="dropdown"="modal" data-target="#create_project" class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->dashboard->projects->create ?></button>
                <?php endif ?>
                -->
               
                <div class="dropdown">
                    <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-simple">
                        <i class="lni lni-circle-plus"></i> <?= $this->language->project->links->create ?>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#create_biolink">
                            <i class="fa fa-circle fa-sm" style="color: <?= $this->language->link->biolink->color ?>"></i>

                            <?= $this->language->link->biolink->name ?>
                        </a>

                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#create_link">
                            <i class="fa fa-circle fa-sm" style="color: <?= $this->language->link->link->color ?>"></i>

                            <?= $this->language->link->link->name ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse d-none" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="card">
                <div class="card-body">
                    <form id="formfilter" class="row" autocomplete="off">
                        <div class="col-sm-10">
                             <input type="text" class="form-control" name="key" id="keyform"  placeholder="search diglink" autocomplete="off">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary w-100">search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<hr/>

<section class="pages">
   
    <div id="renderlink" class="row">
    
    </div>
    <div class="d-flex justify-content-center">
        <ul id="pagination" class="pagination"></ul>
    </div>


</section>



</div>

<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'dist/pagination.min.js') ?>"></script>
<script>
    /*
    total: 100, //  jumlah data
    current: 2, // nomor halaman saat ini
    length: 10, // Jumlah data per halaman
    size: 2, // Menampilkan jumlah tombol


    */
    /* let total= <?= intval($data->total) ?>;
    let current = 1;
    let length = 12;
    let size= 8; */
                        
    //pagination
    const url = (param='') =>{
        return '<?= url() ?>'+param;
    }
    $('#formfilter').on('submit',function(){
        let key = $('#keyform').val();
        loadpage(key);
        return false;
    });

    const loadpage =(key='') => {
            $('#pagination').pagination({
                total:  <?= intval($data->total) ?>, 
                current: 0,
                length: 12, 
                size: 8,
                ajax: function(options, refresh, $target){
                    const renderlink=$('#renderlink');

                    renderlink.html('loading...');
                    $.ajax({
                        url: '<?= url('dashboard/getlink') ?>',
                        type: 'POST',
                        data:{
                            current: options.current,
                            length: options.length,
                            key : key
                        },
                        dataType: 'json'
                    }).done(function(res){
                        //console.log(res.data);
                        let html='';
                        $.each(res.data, function( index, value ) {
                            //console.log(value,'value');

                            let is_enabled = value.is_enabled ? 'checked="true"' : null;
                            html+=`
                                <div class="col-md-3">
                                    <div class="card radius-10 card-page border">
                                        <div class="card-body pb-3 ">
                                            <div class="d-flex justify-content-center align-content-center flex-wrap">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-2">`+value.url+`</h6>
                                                </div>
                                                <div class="fs-5 ms-auto dropdown">
                                                        <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"  data-toggle="tooltip" title="Biolink Option"><i class="bi bi-three-dots"></i>
                                                    </div>
                                                    <ul class="dropdown-menu" style="">
                                                        <li><a href="<?= url('link/') ?>`+value.link_id+`" class="dropdown-item"><i class="fa fa-pencil-alt"></i> <?= $this->language->global->edit ?></a></li>
                                                        <li><a href="<?= url('link/') ?>`+value.link_id+`/statistics" class="dropdown-item"><i class="fa fa-chart-bar"></i> <?= $this->language->link->statistics->link ?></a></li>
                                                        <li><a href="#" data-id="`+value.link_id+`" data-url="`+value.url+`" class="dropdown-item qrcodegenerator"><i class="fa fa-barcode"></i> QR Code</a></li>
                                                        <li><a href="#" class="dropdown-item" data-delete="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="`+value.link_id+`"><i class="fa fa-times"></i> <?= $this->language->global->delete ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="diglink-container overflow-hidden position-relative">
                                                <div class="d-flex justify-content-center ">
                                                    <div class="mb-2">
                                                        <div class="biolink-sm-preview-container position-relative">
                                                            <div class="biolink-preview-sm">
                                                                <div class="biolink-preview-iframe-container-sm">
                                                                    <iframe loading="'lazy'"  scrolling="no" src="`+url(value.url+`?preview&link_id=`+value.link_id)+`" frameborder="0" class="iframe"></iframe>
                                                                </div>
                                                                <!-- option -->
                                                                <div class="diglink-ops">
                                                                    <div class="w-100 h-100 box-option-diglink p-1 d-flex">
                                                                        
                                                                        <div class="justify-content-center align-self-center px-3">
                                                                            <a href="`+url(`link/`+value.link_id)+`" class="btn btn-sm btn-outline-primary w-100 mb-3"> <i class="fa fa-pencil-alt"></i> <?= $this->language->global->edit ?></a>
                                                                            <a href="`+url(`link/`+value.link_id+`/statistics`)+`" class="btn btn-sm btn-outline-primary w-100 mb-3"> <i class="fa fa-chart-bar"></i> <?= $this->language->link->statistics->link ?></a>
                                                                            <a href="#" data-id="`+value.link_id+`" class="btn btn-sm btn-outline-primary w-100 mb-3 qrcodegenerator"> <i class="fa fa-barcode"></i> QR Code</a>
                                                                            <a href="#"  data-delete="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="`+value.link_id+`" class="btn btn-sm btn-outline-primary w-100 mb-3"> <i class="fa fa-times"></i> <?= $this->language->global->delete ?></a>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <!-- option> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="diglink-panel pt-2">
                                                    <div class="row">
                                                        <div class="col">
                                                            
                                                            <div class="custom-control custom-switch form-check form-switch" data-toggle="tooltip" title="<?= $this->language->project->links->is_enabled_tooltip ?>">
                                                                <input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        id="link_is_enabled_`+value.link_id+`"
                                                                        data-row-id="`+value.link_id+`"
                                                                        onchange="ajax_call_helper(event, 'link-ajax', 'is_enabled_toggle')"
                                                                        `+is_enabled+`
                                                                >
                                                                <label class="custom-control-label clickable" for="link_is_enabled_"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex justify-content-end">
                                                                <a href="`+url(`link/`+value.link_id+`/statistics`)+`">
                                                                    <span data-toggle="tooltip" title="<?= $this->language->project->links->clicks ?>"><i class="lni lni-bar-chart custom-row-statistic-icon"></i> <span class="custom-row-statistic-number">`+value.clicks+`</span></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            `;
                        });

                        renderlink.html(html);
                        refresh({
                            total: res.total,
                            length: res.length 
                        });
                    }).fail(function(error){
                        console.log(error,'error');

                    });
                }
            });

    }


    loadpage();                   

    $('#renderlink').on('click','[data-delete]', event => {
        let message = $(event.currentTarget).attr('data-delete');
        console.log('work');
        if(!confirm(message)) return false;

        /* Continue with the deletion */
        ajax_call_helper(event, 'project-ajax', 'delete', () => {

            /* On success delete the actual row from the DOM */
            $(event.currentTarget).closest('tr').remove();

        });

        event.preventDefault();
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

