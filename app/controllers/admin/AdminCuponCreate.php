<?php

namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\Middlewares\Csrf;
use Altum\Middlewares\Authentication;
class AdminCuponCreate extends Controller {
	
	
	public function index() {
       Authentication::guard('admin');
		if(!empty($_POST)) {
			
			$_POST['cupon'] = Database::clean_string($_POST['cupon']);
			$required_fields = ['cupon', 'star','name','diskon'];
            /* Check for the required fields */
            foreach($_POST as $key => $value) {
                if(empty($value) && in_array($key, $required_fields)) {
                    $_SESSION['error'][] = $this->language->global->error_message->empty_fields;
                    break 1;
                }
            }
			if(!Csrf::check()) {
                $_SESSION['error'][] = $this->language->global->error_message->invalid_csrf_token;
            }
			
			if(empty($_SESSION['error'])) {
				
				$stmt = Database::$database->prepare("INSERT INTO `cupon` (`cupon`, `start_date`, `end_date`, `diskon`) VALUES (?, ?, ?, ?)");
				$stmt->bind_param('ssss', $_POST['cupon'], $_POST['start_date'], $_POST['end_date'], $_POST['diskon']);
				$stmt->execute();
                $stmt->close();

                /* Set a nice success message */
                $_SESSION['success'][] = $this->language->global->success_message->basic;
                redirect('admin/cupon');
			}
			
	   
		}
	   
        /* Main View */
        $view = new \Altum\Views\View('admin/cupon-create/index', (array) $this);
        $this->add_view_content('content', $view->run());

    }
	
	
	
}