<?php

namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\Middlewares\Csrf;
use Altum\Middlewares\Authentication;
class AdminCuponEdit extends Controller {
	
	
	public function index() {
       Authentication::guard('admin');
	    $cupon_id = isset($this->params[0]) ? $this->params[0] : false;
		
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
				
				$stmt = Database::$database->prepare("UPDATE `cupon` SET `cupon` = ? ,`start_date` = ? ,`end_date` = ? , `diskon` = ? WHERE `id` = ?");
                     
				
				
				$stmt->bind_param('sssss', $_POST['cupon'], $_POST['start_date'], $_POST['end_date'], $_POST['diskon'],$cupon_id);
				$stmt->execute();
                $stmt->close();

                /* Set a nice success message */
                $_SESSION['success'][] = $this->language->global->success_message->basic;
                redirect('admin/cupon');
			}
			
	   
		}
		
		 $cupon_id = (int) $cupon_id;
		 //echo "SELECT * FROM cupon WHERE id='".$cupon_id."'";
		 $data=$this->database->query("SELECT * FROM cupon WHERE id=".$cupon_id);
		 $cupon=$data->fetch_object();
		 //print_r($cupon); 
		if(!$cupon) {
			redirect('admin/cupon');
		}
		
		 $data = [
            'id'    	=> $cupon_id,
            'cupon'   	=> $cupon,
        ];
	  // print_r($data);
        /* Main View */
        $view = new \Altum\Views\View('admin/cupon-edit/index', (array) $this);
        $this->add_view_content('content', $view->run($data));

    }
	
	
	
}