<?php ob_start() ?>

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<div class="card border ">
    <div class="card-body">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h2 class="h4 mr-3"><?= $this->language->link->statistics->header ?></h2>

            <div>
                <form class="form-inline" id="datepicker_form">
                    <label>
                        <div id="datepicker_selector" class="text-muted clickable">
                            <span class="mr-1">
                                <?php if($data->date->start_date == $data->date->end_date): ?>
                                    <?= \Altum\Date::get($data->date->start_date, 2) ?>
                                <?php else: ?>
                                    <?= \Altum\Date::get($data->date->start_date, 2) . ' - ' . \Altum\Date::get($data->date->end_date, 2) ?>
                                <?php endif ?>
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </div>

                        <input
                                type="text"
                                id="datepicker_input"
                                data-range="true"
                                data-min="<?= (new \DateTime($data->link->date))->format('Y-m-d') ?>"
                                name="date_range"
                                value="<?= $data->date->input_date_range ? $data->date->input_date_range : '' ?>"
                                placeholder=""
                                autocomplete="off"
                                class="custom-control-input"
                        >

                    </label>
                </form>
            </div>
        </div>


    </div>
</div>





<?php if(!count($data->logs)): ?>

    <div class="alert alert-info" role="alert"><?= $this->language->link->statistics->no_logs ?></div>

<?php elseif(!$this->user->package_settings->statistics): ?>

        <div class="alert alert-info" role="alert"><?= $this->language->link->statistics->missing_statistics_package ?></div>

<?php else: ?>

    <!--

    <div class="row my-5">
        <div class="col-12 col-md mr-md-4 custom-row">
            <h3 class="h5"><?= $this->language->link->statistics->referer ?></h3>
            <p class="text-muted mb-3"><?= $this->language->link->statistics->referer_help ?></p>

            <?php foreach($data->logs_data['referer'] as $key => $value): ?>
            <div class="row">
                <div class="col">

                    <?php if($key == 'false'): ?>
                        <span><?= $this->language->link->statistics->referer_direct ?></span>
                    <?php else: ?>
                        <img src="https://www.google.com/s2/favicons?domain=<?= $key ?>" class="img-fluid mr-1" />
                        <a href="<?= $key ?>" title="<?= $key ?>"><?= string_truncate($key, 48) ?></a>
                    <?php endif ?>

                </div>

                <div class="col-auto">
                    <span class="badge badge-pill badge-primary"><?= nr($value) ?></span>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <div class="col-12 col-md ml-md-4 custom-row">
            <h3 class="h5"><?= $this->language->link->statistics->location ?></h3>
            <p class="text-muted mb-3"><?= $this->language->link->statistics->location_help ?></p>

            <?php foreach($data->logs_data['location'] as $key => $value): ?>
                <div class="row">
                    <div class="col">
                        <?php if($key != 'false'): ?>
                            <img src="https://www.countryflags.io/<?= $key ?>/flat/16.png" class="img-fluid mr-1" />
                            <?= get_country_from_country_code($key) ?>
                        <?php else: ?>
                            N/A
                        <?php endif ?>
                    </div>

                    <div class="col-auto">
                        <span class="badge badge-pill badge-primary"><?= nr($value) ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md mr-md-4 custom-row">
            <h3 class="h5"><?= $this->language->link->statistics->browser ?></h3>
            <p class="text-muted mb-3"><?= $this->language->link->statistics->browser_help ?></p>

            <div class="chart-container">
                <canvas id="browser_chart"></canvas>
            </div>

            <?php foreach($data->logs_data['browser'] as $key => $value): ?>
                <div class="row">
                    <div class="col">
                        <?= $key == 'false' ? 'N/A' : $key ?>
                    </div>

                    <div class="col-auto">
                        <span class="badge badge-pill badge-primary"><?= nr($value) ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="col-12 col-md ml-md-4 custom-row">
            <h3 class="h5"><?= $this->language->link->statistics->os ?></h3>
            <p class="text-muted mb-3"><?= $this->language->link->statistics->os_help ?></p>

            <div class="chart-container">
                <canvas id="os_chart"></canvas>
            </div>

            <?php foreach($data->logs_data['os'] as $key => $value): ?>
                <div class="row">
                    <div class="col">
                        <?= $key == 'false' ? 'N/A' : $key ?>
                    </div>

                    <div class="col-auto">
                        <span class="badge badge-pill badge-primary"><?= nr($value) ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    -->

    <div class="row">
    <div class="col-12 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="clicks_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <!-- OS -->
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h6 class="mb-0">Operating Systems</h6>
                </div>
                <div id="chart6"></div>
            </div>
        </div>
        <!-- /OS -->

        <!-- referal -->
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h6 class="mb-0">Browsers</h6>
                </div>
                <div id="chart7"></div>
            </div>
        </div>
       
    </div>   
    <div class="col-md-6">
         <!-- /Referal -->
         <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h6 class="mb-0">Referers</h6>
                </div>
                <div id="chart8"></div>
            </div>
        </div>
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h6 class="mb-0">Visitor Map</h6>
                </div>
                <div class="mb-3">
                    <div id="regions_div" style="height: 200px;" ></div>
                </div>
                <div class="traffic-widget">
                    <?php foreach($data->maps['data'] as $k=>$v): ?>
                    <div class="progress-wrapper mb-1">
                        <p class="mb-0"><img class="me-2" src="<?= url(ASSETS_URL_PATH . 'img/flags/'.strtolower($k).'.gif') ?>" height="10px" width="20px"> <?= $v['name'] ?> <span class="float-end"><?= $v['count'] ?></span></p>
                    </div>
                    <?php endforeach; ?>
                   
                </div>
            </div>
        </div>
    </div> 
</div>

<?php endif ?>

<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/Chart.bundle.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/datepicker.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/apexcharts-bundle/js/apexcharts.min.js') ?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    /* Datepicker */
    $.fn.datepicker.language['altum'] = <?= json_encode(require APP_PATH . 'includes/datepicker_translations.php') ?>;
    let datepicker = $('#datepicker_input').datepicker({
        language: 'altum',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
        timepicker: false,
        toggleSelected: false,
        minDate: new Date($('#datepicker_input').data('min')),
        maxDate: new Date(),

        onSelect: (formatted_date, date) => {

            if(date.length > 1) {
                let [ start_date, end_date ] = formatted_date.split(',');

                if(typeof end_date == 'undefined') {
                    end_date = start_date
                }

                /* Redirect */
                redirect(`${$('#base_controller_url').val()}/statistics/${start_date}/${end_date}`, true);
            }
        }
    });

    /* Charts */
    <?php if(count($data->logs)): ?>
    /* Charts */
    Chart.defaults.global.elements.line.borderWidth = 4;
    Chart.defaults.global.elements.point.radius = 3;
    Chart.defaults.global.elements.point.borderWidth = 7;

    let clicks_chart = document.getElementById('clicks_chart').getContext('2d');

    let gradient = clicks_chart.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(51, 102, 255, 0.6)');
    gradient.addColorStop(1, 'rgba(51, 102, 255, 0.05)');

    let gradient_white = clicks_chart.createLinearGradient(0, 0, 0, 250);
    gradient_white.addColorStop(0, 'rgba(255, 102, 51, 0.6)');
    gradient_white.addColorStop(1, 'rgba(255, 102, 51, 0.05)');

    new Chart(clicks_chart, {
        type: 'line',
        data: {
            labels: <?= $data->logs_chart['labels'] ?>,
            datasets: [{
                label: <?= json_encode($this->language->link->statistics->impression) ?>,
                data: <?= $data->logs_chart['impression'] ?? '[]' ?>,
                backgroundColor: gradient,
                borderColor: '#3461ff',
                fill: true
            },
            {
                label: <?= json_encode($this->language->link->statistics->unique) ?>,
                data: <?= $data->logs_chart['unique'] ?? '[]' ?>,
                backgroundColor: gradient_white,
                borderColor: '#ff6632',
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
                display: true,
                text: <?= json_encode($this->language->link->statistics->clicks_chart) ?>
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

    
    



    /* new statistik */
   /*  var options = {
    series: [{
        name: "Revenue",
		data: [240, 460, 171, 657, 160, 471, 340, 230, 458, 98]
    },{
        name: "wkwk",
		data: [140, 660, 171, 657, 160, 471, 340, 230, 458, 98]
    }],
    chart: {
         type: "area",
       // width: 130,
	    stacked: true,
        height: 280,
        toolbar: {
            show: !1
        },
        zoom: {
            enabled: !1
        },
        dropShadow: {
            enabled: 0,
            top: 3,
            left: 14,
            blur: 4,
            opacity: .12,
            color: "#3461ff"
        },
        sparkline: {
            enabled: !1
        }
    },
    markers: {
        size: 0,
        colors: ["#3461ff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
            size: 7
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "25%",
            //endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: [2.5],
		//colors: ["#3461ff"],
        curve: "smooth"
    },
	fill: {
		type: 'gradient',
		gradient: {
		  shade: 'light',
		  type: 'vertical',
		  shadeIntensity: 0.5,
		  gradientToColors: ['#3361ff'],
		  inverseColors: false,
		  opacityFrom: 0.7,
		  opacityTo: 0.1,
		 // stops: [0, 100]
		}
	},
	colors: ["#3361ff"],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    },
	responsive: [
		{
		  breakpoint: 1000,
		  options: {
			chart: {
				type: "area",
			   // width: 130,
				stacked: true,
			}
		  }
		}
	  ],
	legend: {
		show: false
	  },
    tooltip: {
        theme: "dark"        
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart5"), options);
  chart.render(); */


  /*raveral */
  var options = {
        height: 180,
        width: 180,
        legend: {
          fontSize: "12px"
        },
		series: <?= $data->os['data'] ?>,
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'pie',
		},
		colors: <?= $data->os['backgroundColor'] ?>,
		labels:<?= $data->os['labels'] ?>,
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 360
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#chart6"), options);
	chart.render();



  /*Browser */
    var options = {
        height: 180,
        width: "100%",
        legend: {
          fontSize: "12px"
        },
		series: <?= $data->browser['data'] ?>,
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'pie',
		},
		colors: <?= $data->browser['backgroundColor'] ?>,
		labels:<?= $data->browser['labels'] ?>,
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 360
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#chart7"), options);
	chart.render();


    /*Referers chart */
    var options = {
		series: <?= $data->referal['data'] ?>,
		chart: {
			foreColor: '#9ba7b2',
			height: 330,
			type: 'pie',
		},
		colors: <?= $data->referal['backgroundColor'] ?>,
		labels:<?= $data->referal['labels'] ?>,
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 360
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#chart8"), options);
	chart.render();

   
    /*vistor map */
    google.load("visualization", "1", {packages:["geochart"]});
    google.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable(<?= $data->maps['json'] ?>);

    var options = {
        datalessRegionColor: '#2B2E83',
        colorAxis: {colors: ['#000']},
        
    };

    var chart = new google.visualization.GeoChart(document.getElementById("regions_div"));

    chart.draw(data, options);
    }
		
    <?php endif ?>
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
