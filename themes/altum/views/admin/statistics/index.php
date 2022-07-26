<?php defined('ALTUMCODE') || die(); ?>

<?php ob_start() ?>
<!--<link href="<?= url(ASSETS_URL_PATH . 'css/datepicker.min.css') ?>" rel="stylesheet" media="screen">-->
<link href="<?= url(ASSETS_URL_PATH . 'libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>" rel="stylesheet" media="screen">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<!--<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/datepicker.min.js') ?>"></script> -->
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/Chart.bundle.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'libraries/moment/moment.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

<div class="d-flex flex-column flex-lg-row justify-content-between mb-5">
    <div>
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h3 text-diglink"><i class="fa fa-xs fa-chart-line text-diglink-700"></i> <?= sprintf($this->language->admin_statistics->header) ?>  <?= $data->date->start_date  ?> s/d <?= $data->date->end_date  ?></h1>
        </div>
        <p class="text-diglink"><?= $this->language->admin_statistics->subheader ?></p>
    </div>

    <div class="col-auto p-0">
        <form class="form" id="datepicker_form">
			<div class="form-group text-center">
            
			</div>
			<div class="form-group">
				<label>
              
              Filter
            </label>
			 <div class="input-group">
				<input type="text" class="form-control startdate datetimepicker-input"  data-toggle="datetimepicker" data-target=".startdate" autocomplete="off"/>
				<div class="input-group-append">
					<span class="input-group-text">s/d</span>
				</div>
				<input type="text" class="form-control enddate datetimepicker-input"  data-toggle="datetimepicker" data-target=".enddate" autocomplete="off"/>
			</div>
			</div>
			
        </form>
    </div>
</div>

<?php display_notifications() ?>

<?php ob_start() ?>
<script>
    /* Datepicker */
    /* $.fn.datepicker.language['altum'] = <?= json_encode(require APP_PATH . 'includes/datepicker_translations.php') ?>;
    let datepicker = $('#datepicker_input').datepicker({
        language: 'altum',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
        timepicker: false,
        toggleSelected: false,
        minDate: false,
        maxDate: new Date($('#datepicker_input').data('max')),

        onSelect: (formatted_date, date) => {

            if(date.length > 1) {
                let [ start_date, end_date ] = formatted_date.split(',');

                if(typeof end_date == 'undefined') {
                    end_date = start_date
                }

                
                redirect(`admin/statistics/${start_date}/${end_date}`);
            }
        }
    }); */
	
	$('.startdate').datetimepicker({
		/* defaultDate : '<?= $data->date->start_date  ?>', */
		format: "YYYY-MM-DD",
		/* useCurrent: false */
	});
	//$('.startdate').val('<?= $data->date->start_date  ?>');
	$('.startdate').on("change.datetimepicker", function (e) {
		$('.enddate').val("");
        $('.enddate').datetimepicker('minDate', e.date);
    });

	$('.enddate').datetimepicker({
		/* defaultDate : '<?= $data->date->end_date  ?>', */
		format: "YYYY-MM-DD",
		useCurrent: false,
		/* 'minDate' : $('.startdate').val(): */
	});
	
	$('.enddate').on("change.datetimepicker", function (e) {
		var start_date=$('.startdate').val();
		var end_date=$('.enddate').val();
		 redirect('admin/statistics/'+start_date+'/'+end_date);
	});
	
	
	
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


<?php if($this->settings->payment->is_enabled): ?>
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h2 class="h4 text-diglink"><i class="fa fa-dollar-sign fa-xs text-diglink"></i> <?= $this->language->admin_statistics->sales->header ?></h2>

            <?php $sales_data = $this->database->query("SELECT SUM(`amount`) AS `earnings`, `currency`, COUNT(`id`) AS `count` FROM `payments` WHERE `date` BETWEEN '{$data->date->start_date_query}' AND DATE_ADD('{$data->date->end_date_query}', INTERVAL 1 DAY) GROUP BY `currency` ") ?>
            <?php if(!$sales_data->num_rows): ?>
                <p class="text-diglink"><?= $this->language->admin_statistics->sales->no_sales ?></p>
            <?php else: ?>

                <?php
                $logs_chart = [];
                $result = $this->database->query("SELECT COUNT(*) AS `total_sales`, DATE_FORMAT(`date`, '%Y-%m-%d') AS `formatted_date`, TRUNCATE(SUM(`amount`), 2) AS `total_earned` FROM `payments` WHERE `date` BETWEEN '{$data->date->start_date_query}' AND DATE_ADD('{$data->date->end_date_query}', INTERVAL 1 DAY) GROUP BY `formatted_date`");
                while($row = $result->fetch_object()) {

                    $logs_chart[$row->formatted_date] = [
                        'total_earned' => $row->total_earned,
                        'total_sales' => $row->total_sales
                    ];

                }

                $logs_chart = get_chart_data($logs_chart);
                ?>


                <?php while($sales = $sales_data->fetch_object()): ?>
                    <h6 class="text-diglink">
                        <?= sprintf($this->language->admin_statistics->sales->subheader, '<span class="text-info">' . $sales->count . '</span>', '<span class="text-success">' . number_format($sales->earnings, 2) . '</span>', $sales->currency) ?>
                    </h6>
                <?php endwhile ?>

                <div class="chart-container">
                    <canvas id="payments"></canvas>
                </div>

            <?php endif ?>
        </div>
    </div>

    <?php ob_start() ?>
    <script>
        /* Display chart */
        new Chart(document.getElementById('payments').getContext('2d'), {
            type: 'line',
            data: {
                labels: <?= $logs_chart['labels'] ?? '[]' ?>,
                datasets: [{
                    label: <?= json_encode($this->language->admin_statistics->sales->chart_total_sales) ?>,
                    data: <?= $logs_chart['total_sales'] ?? '[]' ?>,
                    backgroundColor: '#237f52',
                    borderColor: '#237f52',
                    fill: false
                },
                {
                    label: <?= json_encode($this->language->admin_statistics->sales->chart_total_earned) ?>,
                    data: <?= $logs_chart['total_earned'] ?? '[]' ?>,
                    backgroundColor: '#37D28D',
                    borderColor: '#37D28D',
                    fill: false
                }]
            },
            options: {
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                title: {
                    text: '',
                    display: true
                },
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
                            },
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
<?php endif ?>

<?php
$logs_chart = [];
$result = $this->database->query("    
    SELECT 
        formatted_date, 
        SUM(users) AS `users`, 
        SUM(projects) AS `projects`,
        SUM(links) AS `links`
    FROM (
        SELECT DATE_FORMAT(`date`, '%Y-%m-%d') AS `formatted_date`, COUNT(*) AS `users`, 0 AS `projects`, 0 AS `links`
        FROM `users`
        WHERE `date` BETWEEN '{$data->date->start_date_query}' AND DATE_ADD('{$data->date->end_date_query}', INTERVAL 1 DAY)
        GROUP BY `formatted_date`
        
        UNION ALL
        
        SELECT DATE_FORMAT(`date`, '%Y-%m-%d') AS `formatted_date`, 0 AS `users`, COUNT(*) AS `projects`, 0 AS `links`
        FROM `projects`
        WHERE `date` BETWEEN '{$data->date->start_date_query}' AND DATE_ADD('{$data->date->end_date_query}', INTERVAL 1 DAY)
        GROUP BY `formatted_date`
        
        UNION ALL
        
        SELECT DATE_FORMAT(`date`, '%Y-%m-%d') AS `formatted_date`, 0 AS `users`, 0 AS `projects`, COUNT(*) AS `links`
        FROM `links`
        WHERE `date` BETWEEN '{$data->date->start_date_query}' AND DATE_ADD('{$data->date->end_date_query}', INTERVAL 1 DAY)
        GROUP BY `formatted_date`
    ) AS `altumcode`
    
    GROUP BY `formatted_date`;
");
while($row = $result->fetch_object()) {

    $logs_chart[$row->formatted_date] = [
        'users' => $row->users,
        'projects' => $row->projects,
        'links' => $row->links
    ];

}

$logs_chart = get_chart_data($logs_chart);
?>

<div class="card border-0 shadow-sm mb-5">
    <div class="card-body">
        <h2 class="h4 text-diglink"><i class="fa fa-seedling fa-xs text-diglink"></i> <?= $this->language->admin_statistics->growth->header ?></h2>
        <p class="text-diglink"><?= $this->language->admin_statistics->growth->subheader ?></p>

        <div class="chart-container">
            <canvas id="growth"></canvas>
        </div>

    </div>
</div>

<?php ob_start() ?>
<script>
    /* Display chart */
    new Chart(document.getElementById('growth').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?= $logs_chart['labels'] ?>,
            datasets: [{
                label: <?= json_encode($this->language->admin_statistics->growth->chart_users) ?>,
                data: <?= $logs_chart['users'] ?? '[]' ?>,
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                fill: false
            },
            {
                label: <?= json_encode($this->language->admin_statistics->growth->chart_projects) ?>,
                data: <?= $logs_chart['projects'] ?? '[]' ?>,
                backgroundColor:'#9684F7',
                borderColor:'#9684F7',
                fill: false
            },
            {
                label: <?= json_encode($this->language->admin_statistics->growth->chart_links) ?>,
                data: <?= $logs_chart['links'] ?? '[]' ?>,
                backgroundColor: '#f75581',
                borderColor: '#f75581',
                fill: false
            }]
        },
        options: {
            tooltips: {
                mode: 'index',
                intersect: false
            },
            title: {
                text: '',
                display: true
            },
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
                        },
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>




<hr class="my-5" />

<div class="card">
    <div class="card-body">
        <div class="mb-5">
            <h2 class="h4"><?= $this->language->admin_statistics->top_packages->header ?></h2>
            <p class="text-diglink"><?= $this->language->admin_statistics->top_packages->subheader ?></p>

            <div class="mt-5 table-responsive table-custom-container">
                <table class="table table-custom">
                    <thead class="thead-black">
                    <tr>
                        <th><?= $this->language->admin_statistics->top_packages->package_id ?></th>
                        <th><?= $this->language->admin_statistics->top_packages->total ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $this->database->query("SELECT COUNT(*) AS `total`, `package_id` FROM `users` GROUP BY `package_id`");
                    while($row = $result->fetch_object()):
                        ?>
                        <tr>
                            <td><?= (new \Altum\Models\Package(['settings' => $this->settings]))->get_package_by_id($row->package_id)->name ?></td>
                            <td><?= $row->total ?></td>
                        </tr>

                    <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
