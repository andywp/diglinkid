<?php defined('ALTUMCODE') || die() ?>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
        <div class="breadcrumb-title pe-3"><?= sprintf($this->language->project->header->header, $data->project->name) ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>"><i class="lni lni-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= url('project') ?>">My Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= sprintf($this->language->project->header->header, $data->project->name) ?></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a href="#" class="dropdown-item" data-delete-project="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="<?= $data->project->project_id ?>"><i class="lni lni-close"></i> <?= $this->language->global->delete ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php display_notifications() ?>
    <div class="row">
        <div class="col-xl-12">
            <h6 class="mb-0">Statistics</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <?php if($data->logs_chart): ?>
                    <div class="chart-container">
                        <canvas id="clicks_chart"></canvas>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="mt-3 d-flex justify-content-between">
            <div class="col">
                <h6 class="mb-0"><?= $this->language->project->links->header ?></h6>
                <p class="text-muted"><?= $this->language->project->header->subheader ?></p>
            </div>
            <div class="col-auto p-0">
                <div class="dropdown">
                    <button type="button" data-toggle="dropdown" class="btn btn-primary rounded-pill dropdown-toggle dropdown-toggle-simple">
                        <i class="lni lni-circle-plus"></i> <?= $this->language->project->links->create ?></button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#create_biolink">
                            <i class="fa fa-circle fa-sm" style="color: <?= $this->language->link->biolink->color ?>"></i>

                            <?= $this->language->link->biolink->name ?>
                        </a>

                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#create_link">
                            <i class="fa fa-circle fa-sm" style="color: <?= $this->language->link->link->color ?>"></i>

                            <?= $this->language->link->link->name ?>
                        </a>
                    </div>
                </div>
            </div>
    </div><!--end row-->

    <hr/>
    <div class="card">
        <div class="card-body">
            <?php if(count($data->links_logs)): ?>

                <?php foreach($data->links_logs as $row): ?>

                    <div class="d-flex custom-row align-items-center my-3 <?= $row->is_enabled ? null : 'custom-row-inactive' ?>">

                        <div class="col-1 p-0">

                            <span class="fa-stack fa-1x" data-toggle="tooltip" title="<?= $this->language->link->{$row->type}->name ?>">
                            <i class="fas fa-circle fa-stack-2x" style="color: <?= $this->language->link->{$row->type}->color ?>"></i>
                            <i class="fas <?= $this->language->link->{$row->type}->icon ?> fa-stack-1x fa-inverse"></i>
                            </span>

                        </div>

                        <div class="col-7 col-md-5">
                            <div class="d-flex flex-column">
                                <strong><a href="<?= url('link/' . $row->link_id) ?>"><?= $row->url ?></a></strong>
                                
                                <span class="d-flex align-items-center">
                                    <?php if(!empty($row->location_url)): ?>
                                        <img src="https://www.google.com/s2/favicons?domain=<?= $row->location_url ?>" class="img-fluid mr-2" />
                                        <a href="<?= $row->location_url ?>" class="text-muted"><?= $row->location_url ?></a>
                                    <?php else: ?>
                                        <img src="https://www.google.com/s2/favicons?domain=<?= $row->full_url ?>" class="img-fluid mr-2" />
                                        <a href="<?= $row->full_url ?>" class="text-muted"><?= $row->full_url ?></a>
                                    <?php endif ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-1">
                            <a href="#" data-id="<?= $row->link_id ?>" data-url="<?= $row->url ?>" class=" qrcodegenerator"><img src="<?= UPLOADS_URL_PATH ?>iconQRcode.svg" width="30px" height="30px" class="img-fluid mr-2"></a>
                        </div>
                        <div class="col d-none d-md-block">
                            <a href="<?= url('link/' . $row->link_id . '/statistics') ?>">
                                <span data-toggle="tooltip" title="<?= $this->language->project->links->clicks ?>"><i class="lni lni-bar-chart custom-row-statistic-icon"></i> <span class="custom-row-statistic-number"><?= nr($row->clicks) ?></span></span>
                            </a>
                        </div>

                        <div class="col d-none d-md-block">
                            <span class="text-muted" data-toggle="tooltip" title="<?= $this->language->project->links->date ?>"><?= \Altum\Date::get($row->date, 2) ?></span>
                        </div>

                        <div class="col-1 col-md-auto">
                            <div class="custom-control custom-switch form-check form-switch" data-toggle="tooltip" title="<?= $this->language->project->links->is_enabled_tooltip ?>">
                                <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="link_is_enabled_<?= $row->link_id ?>"
                                        data-row-id="<?= $row->link_id ?>"
                                        onchange="ajax_call_helper(event, 'link-ajax', 'is_enabled_toggle')"
                                    <?= $row->is_enabled ? 'checked="true"' : null ?>
                                >
                                <label class="custom-control-label clickable" for="link_is_enabled_<?= $row->link_id ?>"></label>
                            </div>
                        </div>
                        
                        <div class="col col-md-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm">Settings</button>
                                <button type="button" class="btn btn-primary btn-sm split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                    <a href="#" data-id="<?= $row->link_id ?>" class="dropdown-item editlink"><i class="lni lni-pencil"></i> <?= $this->language->global->edit ?></a>
                                    <a href="<?= url('link/' . $row->link_id . '/statistics') ?>" class="dropdown-item"><i class="lni lni-bar-chart"></i> <?= $this->language->link->statistics->link ?></a>
                                    <a href="#" data-id="<?= $row->link_id ?>" data-url="<?= $row->url ?>" class="dropdown-item qrcodegenerator"><i class="fa fa-barcode"></i> QR Code</a>
                                    <a href="#" class="dropdown-item" data-delete="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="<?= $row->link_id ?>"><i class="lni lni-close"></i> <?= $this->language->global->delete ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            <?php else: ?>

                <div class="alert alert-info" role="alert">
                    <?= $this->language->project->links->no_links ?>
                </div>

            <?php endif ?>
        </div>
    </div>

    <?php require THEME_PATH . 'views/partials/ads_header.php' ?>


<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/Chart.bundle.min.js') ?>"></script>
<script>
    /* Charts */
    Chart.defaults.global.elements.line.borderWidth = 4;
    Chart.defaults.global.elements.point.radius = 3;
    Chart.defaults.global.elements.point.borderWidth = 7;

    let clicks_chart = document.getElementById('clicks_chart').getContext('2d');

    let gradient = clicks_chart.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(56, 178, 172, 0.6)');
    gradient.addColorStop(1, 'rgba(56, 178, 172, 0.05)');

    let gradient_white = clicks_chart.createLinearGradient(0, 0, 0, 250);
    gradient_white.addColorStop(0, 'rgba(255, 255, 255, 0.6)');
    gradient_white.addColorStop(1, 'rgba(255, 255, 255, 0.05)');

    new Chart(clicks_chart, {
        type: 'line',
        data: {
            labels: <?= $data->logs_chart['labels'] ?>,
            datasets: [{
                label: <?= json_encode($this->language->link->statistics->impression) ?>,
                data: <?= $data->logs_chart['impression'] ?? '[]' ?>,
                backgroundColor: gradient,
                borderColor: '#38B2AC',
                fill: true
            },
                {
                    label: <?= json_encode($this->language->link->statistics->unique) ?>,
                    data: <?= $data->logs_chart['unique'] ?? '[]' ?>,
                    backgroundColor: gradient_white,
                    borderColor: '#ebebeb',
                    fill: true
                }]
        },
        options: {
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: (tooltipItem, data) => {
                        let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                        return `${nr(value)} ${data.datasets[tooltipItem.datasetIndex].label}`;
                    }
                }
            },
            title: {
                display: false
            },
            legend: {
                display: true
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        userCallback: (value, index, values) => {
                            if (Math.floor(value) === value) {
                                return nr(value);
                            }
                        }
                    },
                    min: 0
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });

    /* Delete handler for project */
    $('[data-delete-project]').on('click', event => {
        let message = $(event.currentTarget).attr('data-delete');

        if(!confirm(message)) return false;

        /* Continue with the deletion */
        ajax_call_helper(event, 'project-ajax', 'delete', () => {

            redirect('dashboard');

        });

    });

    /* Delete handler */
    $('[data-delete]').on('click', event => {
        let message = $(event.currentTarget).attr('data-delete');

        if(!confirm(message)) return false;

        /* Continue with the deletion */
        ajax_call_helper(event, 'link-ajax', 'delete', () => {

            /* On success delete the actual row from the DOM */
            $(event.currentTarget).closest('.custom-row').remove();

        });

    });
	
	$( ".qrcodegenerator" ).click(function() {
		var id=$(this).data('id');
		var url=$(this).data('url');
		$.ajax({
			type: 'POST',
			url: './project/ajaxqrcode/',
			data: {id:id,url:url},
			dataType: 'json',
			success: function(data){
				if(!data.error){
					var html='<div class=""><div class="img"><img src="'+data.url+'" class="rounded mx-auto d-block"></div><div class="text-center"><a href="'+data.url+'" download class="btn btn-danger ">Download</a> </div></div>';
					$('#qecodemodal .modal-body').html(html);
					$('#qecodemodal').modal('show');
				}
			}
		});
		
		return false;
	});

    $( ".editlink" ).click(function() {
		var id=$(this).data('id');
		$.ajax({
			type: 'POST',
			url: './project/ajaxLink/',
			data: {id:id},
			dataType: 'json',
			success: function(data){
				if(!data.error){
                    if(!data.biolink) {
                        // var html1='<input type="hidden" id="base_controller_url" name="base_controller_url" value="<?= url('link/')?>" '+data.link_id+'" /><p class="mb-0">Your link is <strong><?= url('link/')?>'+data.link_id+'</strong><button type="button" class="btn btn-link" data-toggle="tooltip" title="<?= $this->language->global->clipboard_copy ?>" aria-label="<?= $this->language->global->clipboard_copy ?>" data-clipboard-text="<?= url('link/')?>'+data.link_id+'"><i class="fa fa-sm fa-copy"></i></button></p>';
                        // $('#titlelink').html(html1);
                        // $('#editlink').modal('show');
                        window.location.href = "<?= url('link/') ?>"+ id;
                    } else {
                        window.location.href = "<?= url('link/') ?>"+ id;
                    }
				} else {
                    alert("Link Error");
                }
			}
		});
		
		return false;
	});
	
	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
