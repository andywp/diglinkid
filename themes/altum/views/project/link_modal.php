<?php defined('ALTUMCODE') || die() ?>
<div class="modal fade" id="editlink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">  
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Link</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="titlelink"></div>
          <form name="update_link" action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <input type="hidden" name="request_type" value="update" />
            <input type="hidden" name="type" value="link" />
            <input type="hidden" name="link_id" value="<?= $data->link->link_id ?>" />

            <div class="notification-container"></div>

            <div class="form-group">
                <label><i class="fa fa-signature"></i> <?= $this->language->link->settings->location_url ?></label>
                <input type="text" class="form-control" name="location_url" value="<?= $data->link->location_url ?>" required="required" placeholder="<?= $this->language->link->settings->location_url_placeholder ?>" />
            </div>

            <div class="form-group">
                <label><i class="fa fa-link"></i> <?= $this->language->link->settings->url ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <?php if(count($data->domains)): ?>
                            <select name="domain_id" class="appearance-none select-custom-altum form-control input-group-text">
                                <option value="" <?= $data->link->domain ? 'selected="selected"' : null ?>><?= url() ?></option>
                                <?php foreach($data->domains as $row): ?>
                                    <option value="<?= $row->domain_id ?>" <?= $data->link->domain && $row->domain_id == $data->link->domain->domain_id ? 'selected="selected"' : null ?>><?= $row->url ?></option>
                                <?php endforeach ?>
                            </select>
                        <?php else: ?>
                            <span class="input-group-text"><?= url() ?></span>
                        <?php endif ?>
                    </div>
                    <input type="text" class="form-control" name="url" placeholder="<?= $this->language->link->settings->url_placeholder ?>" value="<?= $data->link->url ?>" />
                </div>
                <small class="text-muted"><?= $this->language->link->settings->url_help ?></small>
            </div>

            <div class="custom-control custom-switch">
                <input id="schedule" name="schedule" type="checkbox" class="custom-control-input" <?= !empty($data->link->start_date) && !empty($data->link->end_date) ? 'checked="checked"' : null ?> <?= !$this->user->package_settings->scheduling ? 'disabled="disabled"': null ?>>
                <label class="custom-control-label" for="schedule"><?= $this->language->link->settings->schedule ?></label>
                <small class="form-text text-muted"><?= $this->language->link->settings->schedule_help ?></small>
            </div>

            <div id="schedule_container" class="row mt-3 <?= !$this->user->package_settings->scheduling ? 'container-disabled': null ?>" style="display: none;">
                <div class="col">
                    <div class="form-group">
                        <label><i class="fa fa-clock"></i> <?= $this->language->link->settings->start_date ?></label>
                        <input
                                type="text"
                                class="form-control"
                                name="start_date"
                                value="<?= $data->link->start_date ?>"
                                placeholder="<?= $this->language->link->settings->start_date ?>"
                                autocomplete="off"
                        >
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label><i class="fa fa-clock"></i> <?= $this->language->link->settings->end_date ?></label>
                        <input
                                type="text"
                                class="form-control"
                                name="end_date"
                                value="<?= $data->link->end_date ?>"
                                placeholder="<?= $this->language->link->settings->end_date ?>"
                                autocomplete="off"
                        >
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->global->update ?></button>
            </div>
        </form>

       </div>
    </div>
  </div>
</div>