<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'css/custom2.css') ?>" rel="stylesheet" media="screen">
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
    <div class="breadcrumb-title pe-3">Account Logs</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-home"></i></a></li>
            </ol>
        </nav>
    </div>
</div>
<?php require THEME_PATH . 'views/partials/ads_header.php' ?>
<section class="pages pt-3">
        <?php display_notifications() ?>
       <div class="row">
            <div class="col-md-3">
                <?php require THEME_PATH . 'views/layout/card-account.php' ?>
            </div>
            <div class="col-md-9">
                
                <div class="card border rounded">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-3" ><?= $this->language->account_logs->header ?></h4>
                            <p><?= $this->language->account_logs->subheader ?></p>
                        </div>
                        <?php if($data->logs_result->num_rows): ?>
                            <div class="table-responsive table-custom-container">
                                <table  id="table-list" class="table table-striped table-bordered table-list">
                                    <thead>
                                    <tr>
                                        <th><?= $this->language->account_logs->logs->type ?></th>
                                        <th><?= $this->language->account_logs->logs->ip ?></th>
                                        <th><?= $this->language->account_logs->logs->date ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $nr = 1; while($row = $data->logs_result->fetch_object()): ?>
                                        <tr>
                                            <td><?= $row->type ?></td>
                                            <td><?= $row->ip ?></td>
                                            <td><?= \Altum\Date::get($row->date, true) ?></td>
                                        </tr>
                                    <?php endwhile ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p><?= $this->language->account_logs->info_message->no_logs ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
       </div>
    </section>

    <?php ob_start() ?>
    <script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>

    <script>
        $( document ).ready(function() {
            $('#table-list').DataTable();

            $( ".ticketRow").on( "click", function() {
                let id=$(this).data('id');
                window.location='<?= url('invoice/') ?>'+id;
            });


        });	
    </script>
    <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

