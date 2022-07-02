<?php defined('ALTUMCODE') || die() ?>


<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?= SITE_URL . ASSETS_URL_PATH ?>images/logo-adm.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Diglink</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="<?= \Altum\Routing\Router::$controller == 'AdminIndex' ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminIndex' ? 'active' : null ?>" href="<?= url('admin/') ?>">
                <div class="parent-icon">
                    <i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_index->menu ?></div>
            </a>
        </li>
        <li class="<?= in_array(\Altum\Routing\Router::$controller, ['AdminUsers', 'AdminUserUpdate', 'AdminUserCreate', 'AdminUserView']) ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminUsers' ? 'active' : null ?>" href="<?= url('admin/users') ?>">
                <div class="parent-icon"><i class="bi bi-person-fill"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_users->menu ?></div>
            </a>
        </li>
        <li class="<?= in_array(\Altum\Routing\Router::$controller, ['AdminLinks']) ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminLinks' ? 'active' : null ?>" href="<?= url('admin/links') ?>">
                <div class="parent-icon"><i class="bi bi-link-45deg"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_links->menu ?></div>
            </a>
        </li>
        <li class="<?= in_array(\Altum\Routing\Router::$controller, ['AdminDomains', 'AdminDomainCreate', 'AdminDomainUpdate']) ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminDomains' ? 'active' : null ?>" href="<?= url('admin/domains') ?>">
                <div class="parent-icon"><i class="bi bi-globe"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_domains->menu ?></div>
            </a>
        </li>
        <li class="<?= in_array(\Altum\Routing\Router::$controller, ['AdminPages', 'AdminPageCreate', 'AdminPageUpdate']) ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminPages' ? 'active' : null ?>" href="<?= url('admin/pages') ?>">
                <div class="parent-icon"><i class="bi bi-file-earmark"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_pages->menu ?></div>
            </a>
        </li>
        <li class="<?= in_array(\Altum\Routing\Router::$controller, ['AdminPackages', 'AdminPackageCreate', 'AdminPackageUpdate']) ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminPackages' ? 'active' : null ?>" href="<?= url('admin/packages') ?>">
                <div class="parent-icon"><i class="bi bi-box-seam"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_packages->menu ?></div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'AdminPayments' ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminPayments' ? 'active' : null ?>" href="<?= url('admin/payments') ?>">
                <div class="parent-icon"><i class="bi bi-currency-dollar"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_payments->menu ?></div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'AdminStatistics' ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminStatistics' ? 'active' : null ?>" href="<?= url('admin/statistics') ?>">
                <div class="parent-icon"><i class="bi bi-graph-up"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_statistics->menu ?></div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'AdminSettings' ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminSettings' ? 'active' : null ?>" href="<?= url('admin/settings') ?>">
                <div class="parent-icon"><i class="bi bi-tools"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_settings->menu ?></div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'AdminCupon' ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminCupon' ? 'active' : null ?>" href="<?= url('admin/cupon') ?>">
                <div class="parent-icon"><i class="bi bi-ticket-fill"></i>
                </div>
                <div class="menu-title">Coupon</div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'AdminTicket' ? 'active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'AdminTicket' ? 'active' : null ?>" href="<?= url('admin/ticket') ?>">
                <div class="parent-icon"><i class="bi bi-ticket-fill"></i>
                </div>
                <div class="menu-title">Ticket</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>