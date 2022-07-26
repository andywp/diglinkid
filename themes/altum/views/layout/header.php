    <header class="wrapper bg-soft-primary">
      <nav class="navbar navbar-expand-lg classic transparent position-absolute navbar-dark">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="<?= SITE_URL; ?>">
              <img class="logo-dark" src="<?= url(ASSETS_URL_PATH . 'images/logo.png') ?>" style="height:50px"/>
              <img class="logo-light" src="<?= url(ASSETS_URL_PATH . 'images/logo_white.png') ?>" style="height:50px;"/>
            </a>
          </div>
          <div class="navbar-collapse offcanvas-nav">
            <div class="offcanvas-header d-lg-none d-xl-none">
              <a href="<?= SITE_URL; ?>"><img src="<?= url(ASSETS_URL_PATH . 'images/logo_white.png') ?>" style="height:50px"/></a>
              <button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
            </div>
            <?php if(@$_SESSION['user_id'] != '' || @$_SESSION['user_id'] != null) {?>
            <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="dashboard">Dashboard</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link scroll" href="wa-generator">WhatsApp Shortlink</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link scroll" href="ticket">Support Ticket</a>
              </li>
            </ul>
            <?php } else { ?>
            <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="<?= SITE_URL; ?>">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link scroll" href="#features">Features</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link scroll" href="#price">Price</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link scroll" href="#help">Help</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link scroll" href="#contact">Contact</a>
              </li>
            </ul>
            <?php } ?>
            <!-- /.navbar-nav -->
          </div>
          <!-- /.navbar-collapse -->
          <div class="navbar-other ms-lg-4">
            <ul class="navbar-nav flex-row align-items-center ms-auto" data-sm-skip="true">
              <?php if(@$_SESSION['user_id'] != '' || @$_SESSION['user_id'] != null) {?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#!" aria-haspopup="true" aria-expanded="false">
                        <img src="<?= get_gravatar($this->user->email) ?>" class="navbar-avatar mr-1" />
                        <?= $this->user->name ?> <span class="caret"></span> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= url('account') ?>"><i class="fa fa-fw fa-sm fa-wrench mr-1"></i> <?= $this->language->account->menu ?></a>
                        <a class="dropdown-item" href="<?= url('account-package') ?>"><i class="fa fa-fw fa-sm fa-box-open mr-1"></i> <?= $this->language->account_package->menu ?></a>
                        <a class="dropdown-item" href="<?= url('account-payments') ?>"><i class="fa fa-fw fa-sm fa-dollar-sign mr-1"></i> <?= $this->language->account_payments->menu ?></a>
                        <a class="dropdown-item" href="<?= url('account-logs') ?>"><i class="fa fa-fw fa-sm fa-scroll mr-1"></i> <?= $this->language->account_logs->menu ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= url('logout') ?>"><i class="fa fa-fw fa-sm fa-sign-out-alt mr-1"></i> <?= $this->language->global->menu->logout ?></a>
                    </div>
                </li>
              <?php } else { ?>
                <li class="nav-item d-none d-md-block">
                  <a href="register" class="btn btn-sm bg-primary rounded-pill text-white">Start for Free</a>
                </li>
              <?php } ?>
              <li class="nav-item d-lg-none">
                <div class="navbar-hamburger"><button class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button></div>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>
          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav>
      <!-- /.navbar -->
    </header>
    <!-- /header -->