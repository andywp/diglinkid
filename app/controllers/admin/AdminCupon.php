<?php

namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\Middlewares\Csrf;
use Altum\Middlewares\Authentication;
class AdminCupon extends Controller {
	
	
	public function index() {
       Authentication::guard('admin');
		$packages_result = Database::$database->query("SELECT * FROM `cupon` ORDER BY `id` ASC");

        /* Main View */
        $data = [
            'packages_result' => $packages_result
        ];
	   
        /* Main View */
        $view = new \Altum\Views\View('admin/cupon/index', (array) $this);
        $this->add_view_content('content', $view->run($data));

    }
	
	public function delete() {

        Authentication::guard();

        $page_id = (isset($this->params[0])) ? $this->params[0] : false;

        if(!Csrf::check('global_token')) {
            $_SESSION['error'][] = $this->language->global->error_message->invalid_csrf_token;
        }

        if(empty($_SESSION['error'])) {

            /* Delete the page */
            Database::$database->query("DELETE FROM `cupon` WHERE `id` = {$page_id}");

            /* Success message */
            $_SESSION['success'][] = 'Success Delete Cupon ';

            redirect('admin/cupon');

        }

        die();
    }
	
	
}