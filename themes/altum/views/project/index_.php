<?php defined('ALTUMCODE') || die() ?>

<input type="hidden" id="base_controller_url" name="base_controller_url" value="<?= url('project/' . $data->project->project_id) ?>" />

<header class="header">
    <div class="container">

        <nav aria-label="breadcrumb">
            <small>
                <ol class="custom-breadcrumbs">
                    <li><a href="<?= url('dashboard') ?>"><?= $this->language->dashboard->breadcrumb ?></a> <i class="fa fa-angle-right"></i></li>
                    <li class="active" aria-current="page"><?= $this->language->project->breadcrumb ?></li>
                </ol>
            </small>
        </nav>

        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div class="d-flex align-items-center">
                <h1 class="h3 mr-3"><?= sprintf($this->language->project->header->header, $data->project->name) ?></h1>

                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="text-secondary dropdown-toggle dropdown-toggle-simple">
                        <i class="fas fa-ellipsis-v"></i>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item" data-delete-project="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="<?= $data->project->project_id ?>"><i class="fa fa-times"></i> <?= $this->language->global->delete ?></a>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-auto p-0"></div>
        </div>

        <p class="text-muted"><?= $this->language->project->header->subheader ?></p>

    </div>
</header>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="container">

    <?php display_notifications() ?>

    <?php if($data->logs_chart): ?>
    <div class="chart-container">
        <canvas id="clicks_chart"></canvas>
    </div>
    <?php endif ?>

    <div class="margin-top-3 d-flex justify-content-between">
        <h2 class="h4"><?= $this->language->project->links->header ?></h2>

        <div class="col-auto p-0">
            <div class="dropdown">
                <button type="button" data-toggle="dropdown" class="btn btn-primary rounded-pill dropdown-toggle dropdown-toggle-simple">
                    <i class="fas fa-plus-circle"></i> <?= $this->language->project->links->create ?></button>

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
    </div>

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
                    <span data-toggle="tooltip" title="<?= $this->language->project->links->clicks ?>"><i class="fa fa-chart-bar custom-row-statistic-icon"></i> <span class="custom-row-statistic-number"><?= nr($row->clicks) ?></span></span>
                </a>
            </div>

            <div class="col d-none d-md-block">
                <span class="text-muted" data-toggle="tooltip" title="<?= $this->language->project->links->date ?>"><?= \Altum\Date::get($row->date, 2) ?></span>
            </div>

            <div class="col-1 col-md-auto">
                <div class="custom-control custom-switch" data-toggle="tooltip" title="<?= $this->language->project->links->is_enabled_tooltip ?>">
                    <input
                            type="checkbox"
                            class="custom-control-input"
                            id="link_is_enabled_<?= $row->link_id ?>"
                            data-row-id="<?= $row->link_id ?>"
                            onchange="ajax_call_helper(event, 'link-ajax', 'is_enabled_toggle')"
                        <?= $row->is_enabled ? 'checked="true"' : null ?>
                    >
                    <label class="custom-control-label clickable" for="link_is_enabled_<?= $row->link_id ?>"></label>
                </div>
            </div>
			
            <div class="col-1 col-md-auto">
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="text-secondary dropdown-toggle dropdown-toggle-simple">
                        <i class="fas fa-ellipsis-v"></i>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= url('link/' . $row->link_id) ?>" class="dropdown-item"><i class="fa fa-pencil-alt"></i> <?= $this->language->global->edit ?></a>
                            <a href="<?= url('link/' . $row->link_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-chart-bar"></i> <?= $this->language->link->statistics->link ?></a>
                            <a href="#" data-id="<?= $row->link_id ?>" data-url="<?= $row->url ?>" class="dropdown-item qrcodegenerator"><i class="fa fa-barcode"></i> QR Code</a>
                            <a href="#" class="dropdown-item" data-delete="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="<?= $row->link_id ?>"><i class="fa fa-times"></i> <?= $this->language->global->delete ?></a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach ?>

    <?php else: ?>

        <div class="alert alert-info" role="alert">
            <?= $this->language->project->links->no_links ?>
        </div>

    <?php endif ?>

</section>

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
	
	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
