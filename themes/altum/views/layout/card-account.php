<?php ob_start() ?>
<style>
    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #2b2e839c;
        border-color: #2b2e839c;
    }

</style>

<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<div class="card">
        <div class="card-body p-0">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button bg-white text-dark  fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Account
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="<?= url('account') ?>" class="list-group-item list-group-item-action <?=  (\Altum\Routing\Router::$controller == 'Account') ? 'active' : null ?>" ><i class="fas fa-user"></i> Account</a>
                                <a href="<?= url('account-package') ?>" class="list-group-item list-group-item-action <?=  (\Altum\Routing\Router::$controller == 'AccountPackage') ? 'active' : null ?>" ><i class="fas fa-box-open"></i> Package</a>
                                <a href="<?= url('account-payments') ?>" class="list-group-item list-group-item-action <?=  (\Altum\Routing\Router::$controller == 'AccountPayments' || \Altum\Routing\Router::$controller == 'Invoice' ) ? 'active' : null ?>" ><i class="fas fa-dollar-sign"></i> Payments</a>
                                <a href="<?= url('account-logs') ?>" class="list-group-item list-group-item-action <?=  (\Altum\Routing\Router::$controller == 'AccountLogs') ? 'active' : null ?>" ><i class="fas fa-scroll"></i> logs</a>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>