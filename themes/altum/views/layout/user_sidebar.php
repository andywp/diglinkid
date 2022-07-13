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
        <li class="<?= \Altum\Routing\Router::$controller == 'Dashboard' ||  \Altum\Routing\Router::$controller == 'Link' ? 'active mm-active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'Dashboard' ? 'active' : null ?>" href="<?= url('dashboard') ?>">
                <div class="parent-icon">
                    <i class="lni lni-home"></i>
                </div>
                <div class="menu-title"><?= $this->language->admin_index->menu ?></div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'diglink' || \Altum\Routing\Router::$controller == 'diglink' ? 'active mm-active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'diglink' || \Altum\Routing\Router::$controller == 'diglink' ? 'active' : null ?>" href="<?= url('diglink') ?>">
                <div class="parent-icon">
                    <i class="lni lni-link"></i>
                </div>
                <div class="menu-title">My diglink</div>
            </a>
        </li>
        <!--
        <li class="<?= \Altum\Routing\Router::$controller == 'Project' || \Altum\Routing\Router::$controller == 'Link' ? 'active mm-active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'Project' || \Altum\Routing\Router::$controller == 'Link' ? 'active' : null ?>" href="<?= url('project') ?>">
                <div class="parent-icon">
                    <i class="lni lni-link"></i>
                </div>
                <div class="menu-title">My Projects</div>
            </a>
        </li>
        -->
        <li class="<?= \Altum\Routing\Router::$controller == 'Wa' ? 'active mm-active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'Wa' ? 'active' : null ?>" href="<?= url('wa-generator') ?>">
                <div class="parent-icon">
                    <i class="lni lni-whatsapp"></i>
                </div>
                <div class="menu-title">WhatsApp Shortlink</div>
            </a>
        </li>
        <li class="<?= \Altum\Routing\Router::$controller == 'Ticket' ? 'active mm-active' : null ?>">
            <a class="nav-link d-flex flex-row <?= \Altum\Routing\Router::$controller == 'Ticket' ? 'active' : null ?>" href="<?= url('ticket') ?>">
                <div class="parent-icon">
                    <i class="lni lni-ticket"></i>
                </div>
                <div class="menu-title">Support Ticket</div>
            </a>
        </li>
        <li>
            <a class="nav-link d-flex flex-row" href="<?= url('logout') ?>">
                <div class="parent-icon">
                    <i class="lni lni-lock"></i>
                </div>
                <div class="menu-title"><?= $this->language->global->menu->logout ?></div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>