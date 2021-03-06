<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between">
    <h1 class="h3 text-diglink"><i class="fa fa-xs fa-user text-diglink-700"></i> <?= $this->language->admin_user_create->header ?></h1>
</div>

<?php display_notifications() ?>

<div class="card border-0 shadow-sm mt-5">
    <div class="card-body">

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />

            <div class="form-group mb-4">
                <label><?= $this->language->admin_user_create->form->name ?></label>
                <input type="text" name="name" class="form-control" value="<?= $data->values['name'] ?>" placeholder="<?= $this->language->admin_user_create->form->name_placeholder ?>" required="required" />
            </div>

            <div class="form-group mb-4">
                <label><?= $this->language->admin_user_create->form->email ?></label>
                <input type="text" name="email" class="form-control" value="<?= $data->values['email'] ?>" placeholder="<?= $this->language->admin_user_create->form->email_placeholder ?>" required="required" />
            </div>

            <div class="form-group mb-4">
                <label><?= $this->language->admin_user_create->form->password ?></label>
                <input type="password" name="password" class="form-control" value="<?= $data->values['password'] ?>" placeholder="<?= $this->language->admin_user_create->form->password_placeholder ?>" required="required" />
            </div>

            <div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->global->create ?></button>
            </div>
        </form>

    </div>
</div>

