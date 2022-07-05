<?php defined('ALTUMCODE') || die() ?>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">  
        <div class="breadcrumb-title pe-3"><?= sprintf($this->language->dashboard->header->header, $this->settings->title) ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-home"></i></a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <?php require THEME_PATH . 'views/partials/ads_header.php' ?>
    <!--
    <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">
        <?php $total_project = $this->database->query("SELECT COUNT(`project_id`) AS `total_project` FROM `projects` WHERE `user_id` = {$this->user->user_id}")->fetch_object();?>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Projects</p>
                            <h4 class=""><?= $total_project->total_project ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p><?= $this->language->dashboard->header->links ?></p>
                            <h4 class=""><?= nr($data->links_total) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p><?= $this->language->dashboard->header->clicks ?></p>
                            <h4 class=""><?= nr($data->links_clicks_total) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    -->
    <!--end row-->

<div class="mt-3 d-flex justify-content-between">
    <div class="col">
        <h6><?= $this->language->dashboard->projects->header ?></h6>
        <p class="text-muted"><?= $this->language->dashboard->projects->subheader ?></p>
    </div>
    <div class="col-auto p-0">
        <!--
        <?php if($this->user->package_settings->projects_limit != -1 && $data->projects_result->num_rows >= $this->user->package_settings->projects_limit): ?>
            <button type="button" data-confirm="<?= $this->language->project->error_message->projects_limit ?>"  class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->dashboard->projects->create ?></button>
        <?php else: ?>
            <button type="button" data-toggle="modal" data-target="#create_project" class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->dashboard->projects->create ?></button>
        <?php endif ?>
        -->

        <div class="dropdown">
            <button type="button" data-toggle="dropdown" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-simple">
                <i class="lni lni-circle-plus"></i> <?= $this->language->project->links->create ?>
            </button>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#create_biolink">
                    <i class="fa fa-circle fa-sm" style="color: <?= $this->language->link->biolink->color ?>"></i>

                    <?= $this->language->link->biolink->name ?>
                </a>

                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#create_link">
                    <i class="fa fa-circle fa-sm" style="color: <?= $this->language->link->link->color ?>"></i>

                    <?= $this->language->link->link->name ?>
                </a>
            </div>
        </div>


    </div>
</div>
<hr/>

<section class="pages">
    <div class="row">
        <div class="col-md-3">
            <div class="card radius-10 card-page">
                <div class="card-body pb-3">
                    <div class="d-flex justify-content-center align-content-center flex-wrap">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">Link Name</h6>
                        </div>
                        <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu" style="">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Statistik</a></li>
                                <li><a class="dropdown-item" href="#">QR Code</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="mypages mb-5">
                            <iframe loading="'lazy'"  scrolling="no" src="https://diglink.id/awp?preview&link_id=4466" frameborder="0" class="iframe"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card radius-10 card-page">
                <div class="card-body pb-3">
                    <div class="d-flex justify-content-center align-content-center flex-wrap">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">Link Name</h6>
                        </div>
                        <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu" style="">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Statistik</a></li>
                                <li><a class="dropdown-item" href="#">QR Code</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="mypages mb-5">
                            <iframe loading="'lazy'"  scrolling="no" src="https://diglink.id/awp?preview&link_id=4466" frameborder="0" class="iframe"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card radius-10 card-page">
                <div class="card-body pb-3">
                    <div class="d-flex justify-content-center align-content-center flex-wrap">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">Link Name</h6>
                        </div>
                        <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu" style="">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Statistik</a></li>
                                <li><a class="dropdown-item" href="#">QR Code</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="mypages mb-5">
                            <iframe loading="'lazy'"  scrolling="no" src="https://diglink.id/awp?preview&link_id=4466" frameborder="0" class="iframe"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card radius-10 card-page">
                <div class="card-body pb-3">
                    <div class="d-flex justify-content-center align-content-center flex-wrap">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">Link Name</h6>
                        </div>
                        <div class="fs-5 ms-auto dropdown">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu" style="">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Statistik</a></li>
                                <li><a class="dropdown-item" href="#">QR Code</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="mypages mb-5">
                            <iframe loading="'lazy'"  scrolling="no" src="https://diglink.id/awp?preview&link_id=4466" frameborder="0" class="iframe"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</section>



<div class="card d-none">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">




            </div>
        </div>


        <!--
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?= $this->language->dashboard->projects->name ?></th>
                        <th>Statistics</th>
                        <th><?= $this->language->dashboard->projects->date ?></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($data->projects_result->num_rows): ?>
                        <?php while($row = $data->projects_result->fetch_object()): ?>
                            <?php

                            /* Get the total clicks on the project */
                            $row->clicks = $this->database->query("SELECT SUM(`clicks`) AS `total` FROM `links` WHERE `project_id` = {$row->project_id}")->fetch_object()->total;

                            ?>
                            <tr>
                                <td class="clickable" data-href="<?= url('project/' . $row->project_id) ?>"><?= $row->name ?></td>
                                <td class="clickable" data-href="<?= url('project/' . $row->project_id) ?>"><span data-toggle="tooltip" title="<?= $this->language->project->links->clicks ?>"><i class="lni lni-bar-chart custom-row-statistic-icon"></i> <span class="custom-row-statistic-number"><?= nr($row->clicks) ?></span></span></td>
                                <td class="text-muted clickable" data-href="<?= url('project/' . $row->project_id) ?>"><span><?= \Altum\Date::get($row->date, 2) ?></span></td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="<?= url('project/' . $row->project_id) ?>" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Views" aria-label="Views"><i class="lni lni-eye"></i></a>
                                        <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete" data-delete="<?= $this->language->global->info_message->confirm_delete ?>" data-row-id="<?= $row->project_id ?>"><i class="lni lni-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    <?php else: ?>
                        <td colspan="4"><?= $this->language->dashboard->projects->no_projects ?></td>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><?= $this->language->dashboard->projects->name ?></th>
                        <th>Statistics</th>
                        <th><?= $this->language->dashboard->projects->date ?></th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
         -->
    </div>
</div>

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

