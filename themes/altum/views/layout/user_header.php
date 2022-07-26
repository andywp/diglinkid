        <?php defined('ALTUMCODE') || die() ?>
        <header class="top-header">            
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3">
                    <i class="bi bi-list"></i>
                </div>
                    <a href="<?= url('package/upgrade') ?>"><span class="badge badge-success text-dark"><?= sprintf($this->language->account->package->header, $this->user->package_id) ?> </span></a>
                <?php if($this->user->package_id != 'free'): ?>
                    <small><?= sprintf($this->language->account->package->subheader, '<strong>' . \Altum\Date::get($this->user->package_expiration_date, 2) . '</strong>') ?></small>
                <?php endif ?>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <div class="user-setting d-flex align-items-center">
                                    <img src="<?= get_gravatar($this->user->email) ?>" class="user-img" alt="">
                                    <div class="ms-3">
                                            <h6 class="mb-0 dropdown-user-name"><?= $this->user->name ?> <i class="fas fa-angle-down"></i></h6>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">  
                                <li>
                                    <a class="dropdown-item" href="#">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= get_gravatar($this->user->email) ?>" alt="" class="rounded-circle" width="54" height="54">
                                        <div class="ms-3">
                                            <h6 class="mb-0 dropdown-user-name"><?= $this->user->name ?></h6>
                                        </div>
                                    </div>
                                    </a>
                                </li>
                                <?php if($this->user->type): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('admin') ?>">
                                        <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-speedometer"></i></div>
                                        <div class="ms-3"><span>Dashboard Admin</span></div>
                                        </div>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('account') ?>">
                                        <div class="d-flex align-items-center">
                                        <div class=""><i class="lni lni-user"></i></div>
                                        <div class="ms-3"><span><?= $this->language->account->menu ?></span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('account-package') ?>">
                                        <div class="d-flex align-items-center">
                                        <div class=""><i class="lni lni-dollar"></i></div>
                                        <div class="ms-3"><span><?= $this->language->account_package->menu ?></span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('account-logs') ?>">
                                        <div class="d-flex align-items-center">
                                        <div class=""><i class="lni lni-book"></i></div>
                                        <div class="ms-3"><span><?= $this->language->account_logs->menu ?></span></div>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('logout') ?>">
                                        <div class="d-flex align-items-center">
                                        <div class=""><i class="lni lni-lock"></i></div>
                                        <div class="ms-3"><span><?= $this->language->global->menu->logout ?></span></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>  
                    </ul>
                </div>
            </nav>
        </header>