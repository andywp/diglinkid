<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between">
    <h1 class="h3 text-diglink"><i class="fa fa-xs fa-link text-gray-700"></i> Ticket</h1>
</div>
<div class="mt-5">
    <section class="ticket">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="results" class="table table-striped table-bordered table-list">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Department</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<?php ob_start() ?>
<link href="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= url(ASSETS_URL_PATH . 'onedash/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>

<script>
    const data_table =() =>{
        let datatable = $('#results').DataTable({
                            language: <?= json_encode($this->language->datatable) ?>,
                            serverSide: true,
                            processing: true,
                            ajax: {
                                url: '<?= url('admin/ticket/datatable') ?>',
                                type: 'POST'
                            },
                            autoWidth: false,
                            lengthMenu: [
                                [25, 50, 100],
                                [25, 50, 100]
                            ],
                            columns: [{
                                    data: 'subject',
                                    searchable: false,
                                    sortable: false
                                },{
                                    data: 'department',
                                    searchable: false,
                                    sortable: false
                                },
                                {
                                    data: 'status',
                                    searchable: true,
                                    sortable: false
                                }
                            ],
                            responsive: true,
                            drawCallback: () => {
                                $('[data-toggle="tooltip"]').tooltip();
                            }
                        });


    }

    data_table();
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>