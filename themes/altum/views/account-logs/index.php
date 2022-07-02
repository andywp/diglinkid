<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 bg-content text-white" data-image-src="./assets/img/photos/bg4.jpg">  
    <div class="container pt-18 pb-16" style="z-index: 5; position:relative">  

        <?= $this->views['account_header'] ?>

            <?php require THEME_PATH . 'views/partials/ads_header.php' ?>

            <?php display_notifications() ?>

            <div class="col mt-5 mb-5 mb-lg-0 text-black">
                <h2 class="h3"><?= $this->language->account_logs->header ?></h2>
                <p><?= $this->language->account_logs->subheader ?></p>

                <?php if($data->logs_result->num_rows): ?>
                    <div class="table-responsive table-custom-container">
                        <table class="table table-custom">
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
</section>

