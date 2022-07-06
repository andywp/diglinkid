<?php defined('ALTUMCODE') || die() ?>
<?php

use Altum\Middlewares\Authentication;

?>
<?php ob_start() ?>
<style>
    /*Testimonial*/
    #testimonial p {
        font-size: 14px;
    }


</style>

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">   
      <div class="container pt-18 pb-16" style="z-index: 5; position:relative">
        <div class="row gx-0 gy-12 align-items-center">
          <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-6 content text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
            <h1 class="display-1 text-white mb-5 mx-md-10 mx-lg-0">DigLink :<br/>
                Powerful Link in Bio<br/>
                for <span class="typer text-primary text-nowrap display-1" data-delay="100" data-words="Creators, Brands, Influencers"></span><span class="cursor text-primary" data-owner="typer"></span></h1> 
            <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
                <?php if(@$_SESSION['user_id'] == '' || @$_SESSION['user_id'] == null) {?>
                    <span><a href="register" class="btn btn-lg bg-soft-primary rounded-pill text-diglink mb-4 me-2 btn-lg">Start for Free</a></span>
                <?php } else { ?>
                    <span><a href="dashboard" class="btn btn-lg bg-soft-primary rounded-pill text-diglink mb-4 me-2 btn-lg">Dashboard</a></span>
                <?php } ?>
            </div>
            <?php if(@$_SESSION['user_id'] == '' || @$_SESSION['user_id'] == null) {?>
            <p data-cues="slideInDown" data-group="page-title" data-delay="600">Already on DigLink? <a href="login" class="text-white hover">Sign In</a></p>
            <?php } ?>
          </div>
          <!--/column -->
          <div class="col-lg-5 offset-lg-1">
            <div class="row">
                <div class="col-3 offset-1 offset-lg-0 col-lg-4 d-flex flex-column" data-cues="zoomIn" data-group="col-start" data-delay="300">
                    <div class="ms-auto mt-auto"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa20.jpg" srcset="./assets/img/photos/sa20@2x.jpg 2x" alt="" /></div>
                    <div class="ms-auto mt-5 mb-10"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa18.jpg" srcset="./assets/img/photos/sa18@2x.jpg 2x" alt="" /></div>
                </div>
                <!-- /column -->
                <div class="col-4 col-lg-5" data-cue="zoomIn">
                    <div><img class="w-100 img-fluid rounded shadow-lg" src="./assets/img/photos/sa16.jpg" srcset="./assets/img/photos/sa16.jpg" alt="" /></div>
                </div>
                <!-- /column -->
                <div class="col-3 d-flex flex-column" data-cues="zoomIn" data-group="col-end" data-delay="300">
                    <div class="mt-auto"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa21.jpg" srcset="./assets/img/photos/sa21@2x.jpg 2x" alt="" /></div>
                    <div class="mt-5"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa19.jpg" srcset="./assets/img/photos/sa19@2x.jpg 2x" alt="" /></div>
                    <div class="mt-5 mb-10"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa17.jpg" srcset="./assets/img/photos/sa17@2x.jpg 2x" alt="" /></div>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-light" id="features">
      <div class="container py-14 py-md-17">
        <div class="row text-center">
          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <h2 class="display-4 mb-10 px-xl-10">The one link to rule them all</h2>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="position-relative mb-14 mb-md-17">
          <div class="shape rounded-circle bg-soft-primary rellax w-16 h-16" data-rellax-speed="1" style="bottom: -0.5rem; right: -2.5rem; z-index: 0;"></div>
          <div class="shape bg-dot primary rellax w-16 h-17" data-rellax-speed="1" style="top: -0.5rem; left: -2.5rem; z-index: 0;"></div>
          <div class="row gx-md-5 gy-5 text-center">
            <div class="col-md-6 col-xl-4 p-5">
                <img src="./assets/img/icons/watercolor.svg" class="svg-inject icon-svg text-diglink" alt="" />
                <h4>Create</h4>
                <p class="mb-2">Easily create & manage all your links in one place: personal website, store, recent video or social post.</p>
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-4 p-5">
            <img src="./assets/img/icons/link.svg" class="svg-inject icon-svg text-diglink" alt="" />
                <h4>Integrate</h4>
                <p class="mb-2">Integrate with ecommerce or lead generation solutions, add donation form or analysis of your social profile.</p>
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-4 p-5">
                <img src="./assets/img/icons/paper-plane.svg" class="svg-inject icon-svg text-diglink" alt="" />
                <h4>Share</h4>
                <p class="mb-2">Share your link anywhere: Instagram, YouTube, TikTok, in messengers or via SMS.</p>
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!-- /.position-relative -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center mb-14">
            <div class="col-lg-6">
                <video class="w-100" autoplay="" loop="" muted="" playsinline="" class="lozad" data-poster="https://cdn-f.heylink.me/static/video/works-anywere.jpeg" poster="https://cdn-f.heylink.me/static/video/works-anywere.jpeg" data-loaded="true">
                    <source data-src="https://cdn-f.heylink.me/static/video/works-anywere.mp4" type="video/mp4" src="https://cdn-f.heylink.me/static/video/works-anywere.mp4">
                    <source data-src="https://cdn-f.heylink.me/static/video/works-anywere.webm" type="video/webm" src="https://cdn-f.heylink.me/static/video/works-anywere.webm">
                </video>
            </div>
            <!--/column -->
            <div class="col-lg-6">
                <h2 class="display-4 mb-7">Works Anywhere</h2>
                <p>Share your link on any social or digital platform: Instagram, YouTube, Facebook or TikTok, in messengers or via SMS.</p>
                <?php if(@$_SESSION['user_id'] == '' || @$_SESSION['user_id'] == null) {?>
                    <span><a href="register" class="btn btn-lg bg-diglink rounded-pill text-white mb-4 me-2 btn-lg">Start for Free</a></span>
                <?php } ?>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center mb-14">
            <div class="col-lg-6">
                <h2 class="display-4 mb-7">Get detailed social analytics</h2>
                <p>Identify, organize and manage your audience on social media.</p>
                <?php if(@$_SESSION['user_id'] == '' || @$_SESSION['user_id'] == null) {?>
                    <span><a href="register" class="btn btn-lg bg-diglink rounded-pill text-white mb-4 me-2 btn-lg">Start for Free</a></span>
                <?php } ?>
            </div>
            <!--/column -->
            <div class="col-lg-6">
                <video class="w-100" autoplay="" loop="" muted="" playsinline="" class="lozad" data-poster="https://cdn-f.heylink.me/static/video/index-analytics-example.jpeg" poster="https://cdn-f.heylink.me/static/video/index-analytics-example.jpeg" data-loaded="true">
                    <source data-src="https://cdn-f.heylink.me/static/video/index-analytics-example.webm" type="video/webm" src="https://cdn-f.heylink.me/static/video/index-analytics-example.webm">
                    <source data-src="https://cdn-f.heylink.me/static/video/index-analytics-example.mp4" type="video/mp4" src="https://cdn-f.heylink.me/static/video/index-analytics-example.mp4">
                </video>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center mb-5">
            <div class="col-lg-6">
                <video class="w-100" autoplay="" loop="" muted="" playsinline="" class="lozad" data-poster="https://cdn-f.heylink.me/static/video/index-links-example.jpeg" poster="https://cdn-f.heylink.me/static/video/index-links-example.jpeg" data-loaded="true">
                    <source data-src="https://cdn-f.heylink.me/static/video/index-links-example.webm" type="video/webm" src="https://cdn-f.heylink.me/static/video/index-links-example.webm">
                    <source data-src="https://cdn-f.heylink.me/static/video/index-links-example.mp4" type="video/mp4" src="https://cdn-f.heylink.me/static/video/index-links-example.mp4">
                </video>
            </div>
            <!--/column -->
            <div class="col-lg-6">
                <h2 class="display-4 mb-7">Manage your links as you wish</h2>
                <p>Optimize your links. HeyLink.me allows you to connect any links and effectively manage your audience.</p>
                <?php if(@$_SESSION['user_id'] == '' || @$_SESSION['user_id'] == null) {?>
                    <span><a href="register" class="btn btn-lg bg-diglink rounded-pill text-white mb-4 me-2 btn-lg">Start for Free</a></span>
                <?php } ?>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content" data-image-src="./assets/img/photos/bg4.jpg">
      <div class="container py-14 py-md-17" style="z-index: 5; position:relative">
        <div class="row text-center">
          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <h2 class="display-4 mb-10 px-xl-10 text-white">Over <span class="display-1">1,000,000</span> users trust Linkr to supercharge their bio links. </h2>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="position-relative mt-5 mb-14">
          <div class="row gx-md-5 gy-5 text-center">
            <div class="col-md-12">
                <div id="parner" class="carousel owl-carousel clients mb-0" data-margin="20" data-loop="true" data-dots="false" data-autoplay="true" data-autoplay-timeout="3000" data-responsive='{"0":{"items": "2"}, "768":{"items": "3"}, "992":{"items": "4"}, "1200":{"items": "4"}, "1400":{"items": "5"}}'>
                    <?php
                        $client=[
                                    'ABAME.png',
                                    'BAA.png',
                                    'bursa-kain.png',
                                    'canddypop.png',
                                    'jayross.png',
                                    'JK.png',
                                    'jnc.png',
                                    'Lawlaka.png',
                                    'maima.png',
                                    'Margonda.png',
                                    'Margonda.png',
                                    'Proudly.png',
                                    'ramen.png',
                                    'Rurik.png',
                                    'senja.png',
                                    'Sira.png',
                                    'SKM.png',
                                    'vintagehouse.png',
                                    'ZI&GLO.png'
                                ];

                        foreach($client as $clients):

                    ?>
                         <div class="item px-5"><img src="<?= url(ASSETS_URL_PATH.'img/partner/'.$clients) ?>" alt="diglink.id" /></div>

                    <?php
                        endforeach;
                    ?>
                
                    <!--
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-1.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-2.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-3.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-4.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-5.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-6.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-7.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-8.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-9.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-10.png" alt="" /></div>
                    <div class="item px-5"><img src="./assets/img/client/diglink-client-11.png" alt="" /></div>
                    -->
                </div>
                <!-- /.owl-carousel -->
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!-- /.position-relative -->

        <div class="col-lg-12">
            <div id="testimonial" class="carousel owl-carousel gap-small" data-margin="0" data-dots="true" data-autoplay="false" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "3"}}'>
                <div class="item">
                <div class="item-inner">
                    <div class="card">
                    <div class="card-body p-3">
                        <blockquote class="icon mb-0">
                        <p>"There are so many options of landingpage, I prefer to use Diglink. Because, Diglink can provide us a system to install Facebook Pixel and Google Analytics which really useful for increasing conversion. It's also very simple to set up and install. And most important thing is, the Diglink team is very helpful and the services is so nice. Great 👍"</p>
                        <div class="blockquote-details">
                            <img class="rounded-circle w-12" src="<?= url(ASSETS_URL_PATH.'img/testimonial/Tommy-Surya-Teja.jpeg') ?>" srcset="<?= url(ASSETS_URL_PATH.'img/testimonial/Tommy-Surya-Teja.jpeg') ?>" alt="Tommy Surya Teja" />
                            <div class="info">
                            <h5 class="mb-1">Tommy Surya Teja</h5>
                            <p class="mb-0">Founder of Zalmon Fabric</p>
                            </div>
                        </div>
                        </blockquote>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.item-inner -->
                </div>
                <!-- /.item -->
                <div class="item">
                <div class="item-inner">
                    <div class="card">
                    <div class="card-body p-3">
                        <blockquote class="icon mb-0">
                        <p>“As a KOL (Key Opinion Leader), using Diglink really makes the marketing easier for my business . I can use Diglink on my TikTok and Instagram. Diglink also supports Facebook Pixel and Google analytics, it's really easy for me to advertise my website to my followers. The Diglink team is always ready to help with any questions or requests we have. Very satisfying.”</p>
                        <div class="blockquote-details">
                            <img class="rounded-circle w-12" src="<?= url(ASSETS_URL_PATH.'img/testimonial/Reynaldi-Francois.jpeg') ?>" srcset=<?= url(ASSETS_URL_PATH.'img/testimonial/Reynaldi-Francois.jpeg') ?> 2x" alt="Reynaldi Francois" />
                            <div class="info">
                            <h5 class="mb-1">Reynaldi Francois</h5>
                            <p class="mb-0">Branding and Marketing Strategist - Co-Founder of Zando</p>
                            </div>
                        </div>
                        </blockquote>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.item-inner -->
                </div>
                <!-- /.item -->

                <div class="item">
                    <div class="item-inner">
                        <div class="card">
                        <div class="card-body p-3">
                            <blockquote class="icon mb-0">
                            <p>“Diglink makes it very easy to integrate social media, marketplace, and whatsapp into one channel. It easier for the audience to find information about our brand or visit our shop and it's all in one in perfect DIGLINK. And the most importantly provide pixels for tracking and can be a landing page with complete analysis. Hopefully in the future there will be more interesting features from Diglink.”</p>
                            <div class="blockquote-details">
                                <img class="rounded-circle w-12" src="<?= url(ASSETS_URL_PATH.'img/testimonial/Muhammad-Nizar.jpeg') ?>" srcset="<?= url(ASSETS_URL_PATH.'img/testimonial/Muhammad-Nizar.jpeg') ?> 2x" alt="Muhammad Nizar" />
                                <div class="info">
                                <h5 class="mb-1">Muhammad Nizar</h5>
                                <p class="mb-0">Owner Pro Aktif Creative Consultant</p>
                                </div>
                            </div>
                            </blockquote>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <!-- /.item-inner -->
                </div>

                <div class="item">
                    <div class="item-inner">
                        <div class="card">
                        <div class="card-body p-3">
                            <blockquote class="icon mb-0">
                            <p>“Diglink makes it very easy to integrate social media, marketplace, and whatsapp into one channel. It easier for the audience to find information about our brand or visit our shop and it's all in one in perfect DIGLINK. And the most importantly provide pixels for tracking and can be a landing page with complete analysis. Hopefully in the future there will be more interesting features from Diglink.”</p>
                            <div class="blockquote-details">
                                <img class="rounded-circle w-12" src="<?= url(ASSETS_URL_PATH.'img/testimonial/Novica-Maulidiasari.jpg') ?>" srcset="<?= url(ASSETS_URL_PATH.'img/testimonial/Novica-Maulidiasari.jpg') ?> 2x" alt="Novica Maulidiasari" />
                                <div class="info">
                                <h5 class="mb-1">Novica Maulidiasari</h5>
                                <p class="mb-0">Owner Rurik</p>
                                </div>
                            </div>
                            </blockquote>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <!-- /.item-inner -->
                </div>
               
               
               
            </div>
            <!-- /.owl-carousel -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light" id="price">
        <div class="container py-14 py-md-17">
            <h2 class="display-3 text-center">Pricing</h2>
            <div class="row gy-6 align-items-center">
                <div class="col-lg-12 pricing-wrapper">
                    <div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
                        <p class="mb-0 pe-3">Bulan</p>
                        <div class="pricing-switchers">
                            <div class="pricing-switcher pricing-switcher-active"></div>
                            <div class="pricing-switcher"></div>
                            <div class="switcher-button bg-primary"></div>
                        </div>
                        <p class="mb-0 ps-3">Tahun <span class="text-red"><b>(Save 50%)</b></span></p>
                    </div>
                    <?php $result = \Altum\Database\Database::$database->query("SELECT * FROM `packages` WHERE `is_enabled` = 1 ORDER BY `monthly_price` ASC"); ?>
                    <div class="row gy-6 mt-5">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="pricing card shadow-lg">
                                <div class="card-body pt-8">
                                    <div class="prices text-dark">
                                        <div class="price price-show">
                                            <span class="price-currency"></span>
                                            <span class="price-value">14 Hari</span> 
                                        </div>
                                        <div class="price price-hide price-hidden">
                                            <span class="price-currency"></span>
                                            <span class="price-value">14 Hari</span> 
                                        </div>
                                    </div>
                                    <!--/.prices -->
                                    <h4 class="card-title mt-2">Trial</h4>
                                    <div class="description-box view-more-parent">
                                        <div class="view-more" onclick="viewMore(this)">+ View More</div>
                                        <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                                            <li>
                                                <i class="uil uil-check"></i>
                                                <span>Starter Features</span>
                                            </li>
                                            <li>
                                                <i class="uil uil-check"></i>
                                                <span>Profesional Features</span>
                                            </li>
                                            <li>
                                                <i class="uil uil-check"></i>
                                                <span>ADS</span>
                                            </li>
                                            <li>
                                                <i class="uil uil-check"></i>
                                                <span>1 Projects</span>
                                            </li>
                                            <li>
                                                <i class="uil uil-check"></i>
                                                <span>1 Diglink Pages</span>
                                            </li>
                                            <li>
                                                <i class="uil uil-check"></i>
                                                <span>5 Links</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php if(@$row->package_id == 'free'): ?>
                                        <button class="btn btn-success rounded-pill w-100 mb-2 text-white"><?= $this->language->package->button->already_free ?></button>
                                    <?php else: ?>
                                        <a href="<?= Authentication::check() ? url('pay/free') : url('register?redirect=pay/free') ?>" class="btn bg-diglink rounded-pill w-100 mb-2 text-white"><?= $this->language->package->button->choose ?></a>
                                    <?php endif ?>
                                </div>
                                <!--/.card-body -->
                            </div>
                        </div>
                        <!--/.pricing -->
                        <?php while($row = $result->fetch_object()): $settings = json_decode($row->settings);?>
                            <div class="col-lg-3 col-md-6 col-sm-12 <?php if($row->name == "Profesional") { ?>popular<?php } ?>">
                                <div class="pricing card shadow-lg <?php if($row->name == "Profesional") { ?>bg-diglink text-white<?php } ?>">
                                    <div class="card-body pt-8" >
                                        <div class="prices <?php if($row->name == "Profesional") { ?>text-white<?php } else { ?>text-dark<?php } ?>">
                                            <div class="price price-show">
                                                <span class="price-currency">Rp</span>
                                                <span class="price-value <?php if($row->name == "Profesional") { ?>text-white<?php } else { ?>text-dark<?php } ?>"><?= substr($row->monthly_price, 0, -3); ?>K</span> 
                                                <span class="price-duration <?php if($row->name == "Profesional") { ?>text-white<?php } else { ?>text-dark<?php } ?>">Bulan</span>
                                            </div>
                                            <div class="price price-hide price-hidden">
                                                <span class="price-currency">Rp</span>
                                                <span class="price-value <?php if($row->name == "Profesional") { ?>text-white<?php } else { ?>text-dark<?php } ?>"><?= substr($row->annual_price, 0, -3); ?>K</span> 
                                                <span class="price-duration <?php if($row->name == "Profesional") { ?>text-white<?php } else { ?>text-dark<?php } ?>">Tahun</span>
                                            </div>
                                        </div>
                                        <!--/.prices -->
                                        <h4 class="card-title mt-2 <?php if($row->name == "Profesional") { ?>text-white<?php } else { ?>text-dark<?php } ?>"><?= $row->name; ?></h4>
                                        
                                        <div class="description-box view-more-parent">
                                            <div class="view-more" onclick="viewMore(this)">+ View More</div>
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                                                <?php $result2 = \Altum\Database\Database::$database->query("SELECT * FROM `package_features` ORDER BY `package_features_id` ASC"); ?>
                                                <?php while($row2 = $result2->fetch_object()):
                                                $id = array($row->package_id);
                                                $package_features_id = json_decode($row2->package_id, true);
                                                $package_features_id =!empty($package_features_id)?$package_features_id:array();
                                                if (in_array($id[0], $package_features_id)){
                                                    echo '<li><i class="uil uil-check"></i><span>'.$row2->name.'</span></li>';
                                                ?>
                                                <?php } ?>
                                                <?php endwhile ?>
                                            </ul>
                                        </div>
                                        <?php if(@$row->package_id == @$this->user->package_id): ?>
                                            <button class="btn btn-success rounded-pill w-100 mb-2 text-white"><?= $this->language->package->button->already_free ?></button>
                                        <?php else: ?>
                                            <a href="<?= Authentication::check() ? url('pay/' . $row->package_id) : url('register?redirect=pay/' . $row->package_id) ?>" class="btn <?php if($row->name == "Profesional") { ?>btn-primary<?php } else { ?>bg-diglink text-white<?php } ?> rounded-pill w-100 mb-2"><?= $this->language->package->button->choose ?></a>
                                        <?php endif ?>
                                        
                                        <!-- <a href="#" class="btn bg-diglink rounded-pill w-100 mb-2 text-white">Choose Plan</a> -->
                                    </div>
                                    <!--/.card-body -->
                                </div>
                                <!--/.pricing -->
                            </div>
                        <?php endwhile ?>
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
    </section>
     <!-- /section -->


     <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content" data-image-src="./assets/img/photos/bg4.jpg" id="help">
        <div class="container py-14 py-md-17" style="z-index: 5; position:relative">
            <h2 class="display-4 mb-3 text-center text-white">FAQ</h2>
            <p class="lead text-center mb-10 px-md-16 px-lg-0 text-white">If you don't see an answer to your question, you can send us an email from our contact form.</p>
            <div class="row">
            <div class="col-lg-6 mb-0">
                <div id="accordion-1" class="accordion-wrapper">
                <div class="card">
                    <div class="card-header" id="accordion-heading-1-1">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-1" aria-expanded="false" aria-controls="accordion-collapse-1-1">Apa itu diglink ?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-1-1" class="collapse" aria-labelledby="accordion-heading-1-1" data-bs-target="#accordion-1">
                    <div class="card-body">
                        <p>Diglink adalah platform untuk membuat link menjadi satu dengan tampilan yang memukau</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header" id="accordion-heading-1-2">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-2" aria-expanded="false" aria-controls="accordion-collapse-1-2">Bagaimana cara pasang pixel di diglink ?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-1-2" class="collapse" aria-labelledby="accordion-heading-1-2" data-bs-target="#accordion-1">
                    <div class="card-body">
                        <p>Masuk ke projek>diglink>setting paling bawah terdapat traking pixel, bisa dari fb & instagram, tiktok, google analitic</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header" id="accordion-heading-1-3">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-3" aria-expanded="false" aria-controls="accordion-collapse-1-3">Bagaimana Metode pembayaran di diglink?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-1-3" class="collapse" aria-labelledby="accordion-heading-1-3" data-bs-target="#accordion-1">
                    <div class="card-body">
                        <p>Metode Pembayaran diglink menggunakan Midtrans dan menerima semua metode pembayaran</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header" id="accordion-heading-1-4">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-4" aria-expanded="false" aria-controls="accordion-collapse-1-4">Bagaimana jika saya lupa password ?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-1-4" class="collapse" aria-labelledby="accordion-heading-1-4" data-bs-target="#accordion-1">
                    <div class="card-body">
                        <p>Anda bisa melakukan forget password dan mendapatkan OTP melalui email atau no handphone</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header" id="accordion-heading-2-1">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-2-1" aria-expanded="false" aria-controls="accordion-collapse-2-1">Apa Manfaat saya menggunakan diglink ?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-2-1" class="collapse" aria-labelledby="accordion-heading-2-1" data-bs-target="#accordion-2">
                    <div class="card-body">
                        <p>Anda bisa menggunakan berbagai link dengan tujuan yang berbeda-beda dengan tanpilan yang berbeda halaman, diglink memungkinkan untuk membuat lebih dari satu halaman link</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                </div>
                <!-- /.accordion-wrapper -->
            </div>
            <!--/column -->
            <div class="col-lg-6">
                <div id="accordion-2" class="accordion-wrapper">
                
                <!-- /.card -->
                <div class="card">
                    <div class="card-header" id="accordion-heading-2-2">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-2-2" aria-expanded="false" aria-controls="accordion-collapse-2-2">Mengapa tautan saya tidak muncul?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-2-2" class="collapse" aria-labelledby="accordion-heading-2-2" data-bs-target="#accordion-2">
                    <div class="card-body">
                        <p>Mungkin ada beberapa alasan mengapa tautan Anda tidak berfungsi. Pertama, Anda harus mengidentifikasi masalah berdasarkan jenis kesalahan yang Anda terima.</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header" id="accordion-heading-2-3">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-2-3" aria-expanded="false" aria-controls="accordion-collapse-2-3">Apakah diglink bisa membuat form whatsapp?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-2-3" class="collapse" aria-labelledby="accordion-heading-2-3" data-bs-target="#accordion-2">
                    <div class="card-body">
                        <p>bisa dengan fitur wa form saat penambahan link</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header" id="accordion-heading-2-4">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-2-4" aria-expanded="false" aria-controls="accordion-collapse-2-4">Bagaimana mengubah URL Diglink Anda</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-2-4" class="collapse" aria-labelledby="accordion-heading-2-4" data-bs-target="#accordion-2">
                    <div class="card-body">
                        <p>Masuk ke diglink kaku ke projek, ubah nama link diglink</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header" id="accordion-heading-2-4">
                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-2-4" aria-expanded="false" aria-controls="accordion-collapse-2-4">Berapa link diglink yang bisa saya buat dalam satu akun ?</button>
                    </div>
                    <!-- /.card-header -->
                    <div id="accordion-collapse-2-4" class="collapse" aria-labelledby="accordion-heading-2-4" data-bs-target="#accordion-2">
                    <div class="card-body">
                        <p>Minimal 1 Link diglink dan maksimal 5 link diglink tergantung paket yang di pilih, untuk kebutuhan link diatas 5, Lebih lanjut bisa hubungi kami melalui Support Tiket</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->

                </div>
                <!-- /.accordion-wrapper -->
            </div>
            <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->



<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/lozad.min.js') ?>"></script>

<script>
    /* Lazy loading */
    const observer = lozad(); observer.observe();
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

