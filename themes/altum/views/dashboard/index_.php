<?php defined('ALTUMCODE') || die() ?>
<section class="wrapper bg-soft-primary pt-10 pb-12 pt-md-8 pb-md-17">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
            <h1 class="h3"><?= sprintf($this->language->dashboard->header->header, $this->settings->title) ?></h1>
        </div>
        <div class="row justify-content-between">
            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0  text-white h-100 zoomer">
                    <div class="card-body">
                        <div class="card-title h4 mb-3"><?= $this->user->package_id ?> <i class="fa fa-box-open fa-xs"></i></div>

                        <p class="mb-0"><?= $this->language->dashboard->header->package ?></p>
                        <p class="mb-0"><small><a href="<?= url('package/upgrade') ?>"><?= $this->language->dashboard->header->renew ?></a></small></p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-danger text-white h-100 zoomer">
                    <div class="card-body">
                        <?php if($this->user->package_id == 'free'): ?>
                            <div class="card-title h4 mb-3"><?= $this->language->dashboard->header->package_expiration_date_never ?> <i class="fa fa-calendar fa-xs"></i></div>
                        <?php else: ?>
                            <div class="card-title h4 mb-3"><?= \Altum\Date::get_time_until($this->user->package_expiration_date) ?> <i class="fa fa-calendar fa-xs"></i></div>

                            <p class="mb-0"><?= $this->language->dashboard->header->package_expiration_date ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-info text-white h-100 zoomer">
                    <div class="card-body">
                        <div class="card-title h4 mb-3"><?= nr($data->links_total) ?> <i class="fa fa-link fa-xs"></i></div>
                        <p class="mb-0"><?= $this->language->dashboard->header->links ?></p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-warning text-white h-100 zoomer">
                    <div class="card-body">
                        <div class="card-title h4 mb-3"><?= nr($data->links_clicks_total) ?> <i class="fa fa-chart-line fa-xs"></i></div>

                        <p class="mb-0"><?= $this->language->dashboard->header->clicks ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if(false): ?>
            <div class="row">
                <div class="col-1"><i class="fas fa-hourglass-end"></i></div>
                <div class="col"><?= sprintf($this->language->dashboard->header->package_expiration_date, \Altum\Date::get($this->user->package_expiration_date, true)) ?></div>
            </div>
        <?php endif ?>

    </div>
</section>


<section class="wrapper bg-soft-primary pt-10 pb-12 pt-md-8 pb-md-17">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <a href="https://linkeer.net/links?type=link" class="stretched-link text-primary-600">
                                        <svg class="svg-inline--fa fa-archive fa-w-16 fa-fw fa-lg" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="archive" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M32 432C32 458.5 53.49 480 80 480h352c26.51 0 48-21.49 48-48V160H32V432zM160 236C160 229.4 165.4 224 172 224h168C346.6 224 352 229.4 352 236v8C352 250.6 346.6 256 340 256h-168C165.4 256 160 250.6 160 244V236zM480 32H32C14.31 32 0 46.31 0 64v48C0 120.8 7.188 128 16 128h480C504.8 128 512 120.8 512 112V64C512 46.31 497.7 32 480 32z"></path>
                                        </svg><!-- <i class="fa fa-fw fa-link fa-lg"></i> Font Awesome fontawesome.com -->
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0"><?= $this->language->dashboard->header->package ?> is <?= $this->user->package_id ?></div>
                            <span class="text-black" style="font-weight: bold;"><small><a href="<?= url('package/upgrade') ?>"><?= $this->language->dashboard->header->renew ?></a></small></span>                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <a href="https://linkeer.net/links?type=link" class="stretched-link text-primary-600">
                                        <svg class="svg-inline--fa fa-link fa-w-16 fa-fw fa-lg" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path></svg><!-- <i class="fa fa-fw fa-link fa-lg"></i> Font Awesome fontawesome.com -->
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0">0</div>
                            <span class="text-black" style="font-weight: bold;">Total links</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <svg class="svg-inline--fa fa-chart-bar fa-w-16 fa-fw fa-lg text-primary-600" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="chart-bar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M332.8 320h38.4c6.4 0 12.8-6.4 12.8-12.8V172.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v134.4c0 6.4 6.4 12.8 12.8 12.8zm96 0h38.4c6.4 0 12.8-6.4 12.8-12.8V76.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v230.4c0 6.4 6.4 12.8 12.8 12.8zm-288 0h38.4c6.4 0 12.8-6.4 12.8-12.8v-70.4c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v70.4c0 6.4 6.4 12.8 12.8 12.8zm96 0h38.4c6.4 0 12.8-6.4 12.8-12.8V108.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v198.4c0 6.4 6.4 12.8 12.8 12.8zM496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path></svg><!-- <i class="fa fa-fw fa-chart-bar fa-lg text-primary-600"></i> Font Awesome fontawesome.com -->
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0">0</div>
                            <span class="text-black" style="font-weight: bold;">Links pageviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <a href="https://linkeer.net/links?type=biolink" class="stretched-link text-primary-600">
                                        <svg class="svg-inline--fa fa-hashtag fa-w-14 fa-fw fa-lg" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="hashtag" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M440.667 182.109l7.143-40c1.313-7.355-4.342-14.109-11.813-14.109h-74.81l14.623-81.891C377.123 38.754 371.468 32 363.997 32h-40.632a12 12 0 0 0-11.813 9.891L296.175 128H197.54l14.623-81.891C213.477 38.754 207.822 32 200.35 32h-40.632a12 12 0 0 0-11.813 9.891L132.528 128H53.432a12 12 0 0 0-11.813 9.891l-7.143 40C33.163 185.246 38.818 192 46.289 192h74.81L98.242 320H19.146a12 12 0 0 0-11.813 9.891l-7.143 40C-1.123 377.246 4.532 384 12.003 384h74.81L72.19 465.891C70.877 473.246 76.532 480 84.003 480h40.632a12 12 0 0 0 11.813-9.891L151.826 384h98.634l-14.623 81.891C234.523 473.246 240.178 480 247.65 480h40.632a12 12 0 0 0 11.813-9.891L315.472 384h79.096a12 12 0 0 0 11.813-9.891l7.143-40c1.313-7.355-4.342-14.109-11.813-14.109h-74.81l22.857-128h79.096a12 12 0 0 0 11.813-9.891zM261.889 320h-98.634l22.857-128h98.634l-22.857 128z"></path></svg><!-- <i class="fa fa-fw fa-hashtag fa-lg"></i> Font Awesome fontawesome.com -->
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0">7</div>
                            <span class="text-black" style="font-weight: bold;">Total biolinks</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <svg class="svg-inline--fa fa-chart-bar fa-w-16 fa-fw fa-lg text-primary-600" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="chart-bar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M332.8 320h38.4c6.4 0 12.8-6.4 12.8-12.8V172.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v134.4c0 6.4 6.4 12.8 12.8 12.8zm96 0h38.4c6.4 0 12.8-6.4 12.8-12.8V76.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v230.4c0 6.4 6.4 12.8 12.8 12.8zm-288 0h38.4c6.4 0 12.8-6.4 12.8-12.8v-70.4c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v70.4c0 6.4 6.4 12.8 12.8 12.8zm96 0h38.4c6.4 0 12.8-6.4 12.8-12.8V108.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v198.4c0 6.4 6.4 12.8 12.8 12.8zM496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path></svg><!-- <i class="fa fa-fw fa-chart-bar fa-lg text-primary-600"></i> Font Awesome fontawesome.com -->
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0">2</div>
                            <span class="text-black" style="font-weight: bold;">Biolinks pageviews</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <a href="https://linkeer.net/domains" class="stretched-link text-primary-600">
                                        <svg class="svg-inline--fa fa-globe fa-w-16 fa-fw fa-lg" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="globe" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z"></path></svg><!-- <i class="fa fa-fw fa-globe fa-lg"></i> Font Awesome fontawesome.com -->
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0">0</div>
                            <span class="text-black" style="font-weight: bold;">Total domains</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-4 mb-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex">
                        <div>
                            <div class="card border-0 bg-primary-200 mr-3 position-static">
                                <div class="p-3 d-flex align-items-center justify-content-between">
                                    <a href="https://linkeer.net/projects" class="stretched-link text-primary-600">
                                        <svg class="svg-inline--fa fa-project-diagram fa-w-20 fa-fw fa-lg" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="project-diagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M384 320H256c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32V352c0-17.67-14.33-32-32-32zM192 32c0-17.67-14.33-32-32-32H32C14.33 0 0 14.33 0 32v128c0 17.67 14.33 32 32 32h95.72l73.16 128.04C211.98 300.98 232.4 288 256 288h.28L192 175.51V128h224V64H192V32zM608 0H480c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h128c17.67 0 32-14.33 32-32V32c0-17.67-14.33-32-32-32z"></path></svg><!-- <i class="fa fa-fw fa-project-diagram fa-lg"></i> Font Awesome fontawesome.com -->
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card-title h4 m-0">0</div>
                            <span class="text-black" style="font-weight: bold;">Total projects</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card mt-4">
            <div class="card-body">
                <div class="chart-container"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="clicks_chart" style="display: block; width: 1133px; height: 250px;" class="chartjs-render-monitor" width="1133" height="250"></canvas>
                </div>
            </div>
        </div> -->
    </div>
    
</section>
<!-- <header class="header"> -->
    <!-- <div class="container">

        <div class="d-flex flex-column flex-md-row justify-content-between">
            <h1 class="h3"><?= sprintf($this->language->dashboard->header->header, $this->settings->title) ?></h1>
        </div>

        <div class="row justify-content-between">
            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-primary text-white h-100 zoomer">
                    <div class="card-body">
                        <div class="card-title h4 mb-3"><?= $this->user->package_id ?> <i class="fa fa-box-open fa-xs"></i></div>

                        <p class="mb-0"><?= $this->language->dashboard->header->package ?></p>
                        <p class="mb-0"><small><a href="<?= url('package/upgrade') ?>"><?= $this->language->dashboard->header->renew ?></a></small></p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-danger text-white h-100 zoomer">
                    <div class="card-body">
                        <?php if($this->user->package_id == 'free'): ?>
                            <div class="card-title h4 mb-3"><?= $this->language->dashboard->header->package_expiration_date_never ?> <i class="fa fa-calendar fa-xs"></i></div>
                        <?php else: ?>
                            <div class="card-title h4 mb-3"><?= \Altum\Date::get_time_until($this->user->package_expiration_date) ?> <i class="fa fa-calendar fa-xs"></i></div>

                            <p class="mb-0"><?= $this->language->dashboard->header->package_expiration_date ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-info text-white h-100 zoomer">
                    <div class="card-body">
                        <div class="card-title h4 mb-3"><?= nr($data->links_total) ?> <i class="fa fa-link fa-xs"></i></div>

                        <p class="mb-0"><?= $this->language->dashboard->header->links ?></p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-5 mb-md-0">
                <div class="card border-0 bg-gradient-warning text-white h-100 zoomer">
                    <div class="card-body">
                        <div class="card-title h4 mb-3"><?= nr($data->links_clicks_total) ?> <i class="fa fa-chart-line fa-xs"></i></div>

                        <p class="mb-0"><?= $this->language->dashboard->header->clicks ?></p>
                    </div>
                </div>
            </div>
        </div>


        <?php if(false): ?>
            <div class="row">
                <div class="col-1"><i class="fas fa-hourglass-end"></i></div>
                <div class="col"><?= sprintf($this->language->dashboard->header->package_expiration_date, \Altum\Date::get($this->user->package_expiration_date, true)) ?></div>
            </div>
        <?php endif ?>

    </div>
</header> -->

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="container">

    <?php display_notifications() ?>

    <div class="margin-top-3 d-flex justify-content-between">
        <h2 class="h4"><?= $this->language->dashboard->projects->header ?></h2>

        <div class="col-auto p-0">
            <?php if($this->user->package_settings->projects_limit != -1 && $data->projects_result->num_rows >= $this->user->package_settings->projects_limit): ?>
                <button type="button" data-confirm="<?= $this->language->project->error_message->projects_limit ?>"  class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->dashboard->projects->create ?></button>
            <?php else: ?>
                <button type="button" data-toggle="modal" data-target="#create_project" class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->dashboard->projects->create ?></button>
            <?php endif ?>
        </div>
    </div>

    <?php if($data->projects_result->num_rows): ?>
        <p class="text-muted"><?= $this->language->dashboard->projects->subheader ?></p>

        <div class="table-responsive table-custom-container">
            <table class="table table-custom">
                <thead class="thead-black">
                <tr>
                    <th><?= $this->language->dashboard->projects->name ?></th>
                    <th></th>
                    <th><?= $this->language->dashboard->projects->date ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tbody_campaign">

                <?php while($row = $data->projects_result->fetch_object()): ?>
                    <?php

                    /* Get the total clicks on the project */
                    $row->clicks = $this->database->query("SELECT SUM(`clicks`) AS `total` FROM `links` WHERE `project_id` = {$row->project_id}")->fetch_object()->total;

                    ?>
                    <tr>
                        <td class="clickable" data-href="<?= url('project/' . $row->project_id) ?>"><?= $row->name ?></td>
                        <td class="clickable" data-href="<?= url('project/' . $row->project_id) ?>"><span data-toggle="tooltip" title="<?= $this->language->project->links->clicks ?>"><i class="fa fa-chart-bar custom-row-statistic-icon"></i> <span class="custom-row-statistic-number"><?= nr($row->clicks) ?></span></span></td>
                        <td class="text-muted clickable" data-href="<?= url('project/' . $row->project_id) ?>"><span><?= \Altum\Date::get($row->date, 2) ?></span></td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" class="text-secondary dropdown-toggle dropdown-toggle-simple">
                                    <i class="fas fa-ellipsis-v"></i>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item" data-delete="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="<?= $row->project_id ?>"><i class="fa fa-times"></i> <?= $this->language->global->delete ?></a>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile ?>

                </tbody>
            </table>
        </div>

    <?php else: ?>
        <p class="text-muted"><?= $this->language->dashboard->projects->no_projects ?></p>
    <?php endif ?>

</section>

<?php ob_start() ?>
<script>
    $('[data-delete]').on('click', event => {
        let message = $(event.currentTarget).attr('data-delete');

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
