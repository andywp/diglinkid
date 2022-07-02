<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;
use Altum\Title;
use Altum\Middlewares\Csrf;
use Altum\Response;
class Ticket extends Controller {
	public function index() {
		Authentication::guard();
		$view = new \Altum\Views\View('ticket/index', (array) $this);
		$data = [
			  'user'    => $this->user,
		];
        $this->add_view_content('content', $view->run($data));
	}
	
	public function saved(){
		Authentication::guard();
		$error=true;
		$alert='';
		$url='';
		if(!Csrf::check()) {
			$alert='invalid token';
		}elseif($this->validate_phone_number($_POST['whatsapp'] == true)){
			$alert='Invalid Whatsapp number';
		}else{
			$_POST['subject']=Database::clean_string($_POST['subject']);
			$_POST['dep']=Database::clean_string($_POST['dep']);
			$_POST['priority']=Database::clean_string($_POST['priority']);
			$_POST['message']=Database::clean_string($_POST['message']);
			
			$stmt = Database::$database->prepare("INSERT INTO `ticket` (`user_id`, `name`, `whatsapp_number`, `subject`, `department`, `priority`,`message`,`date_create`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			@$stmt->bind_param('ssssssss', $this->user->user_id,  $this->user->name, $_POST['whatsapp'], $_POST['subject'], $_POST['dep'], $_POST['priority'],$_POST['message'],date("Y-m-d H:i:s"));
			$stmt->execute();
			$stmt->close();
			
			$error=false;
			$alert='ticket saved successfully';
			
			if($_POST['dep'] == 'Support'){
				//$nomorwa=6283144527880;
				$nomorwa=6281315987299;
			}else{
				//$nomorwa=6281321513111;
				$nomorwa=6281229626345;
			}
			//*Nama*%20%3A%0AAlamat%20%3A%0AKodepos%20%3A%0ANomor%20Telepon%20%3A%0APekerjaan%20%3A%
			$msg='*Nama*%20:'.urlencode($this->user->name.' ').'%0A';
			$msg.='*Subject*%20:'.urlencode($_POST['subject'].' ').'%0A';
			$msg.='*Department*%20:'.urlencode($_POST['dep'].' ').'%0A';
			$msg.='*Priority*%20:'.urlencode($_POST['priority'].' ').'%0A';
			$msg.='*Message*%20:'.urlencode($_POST['message'].' ').'%0A';
			
			$url='https://wa.me/'.$nomorwa.'?text='.$msg;
			
			
			
		}
		
		
		
		$respon=array(
					'error' 	=> $error,
					'alert'		=> $alert,
					'url'		=>	$url
				);
		
		echo json_encode($respon);
		exit();
	}
	
	private function validate_phone_number($phone)
		{
			 // Allow +, - and . in phone number
			 $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
			 // Remove "-" from number
			 $phone_to_check = str_replace("-", "", $filtered_phone_number);
			 // Check the lenght of number
			 // This can be customized if you want phone number from a specific country
			 if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
				return false;
			 } else {
			   return true;
			 }
		}
	
	
}