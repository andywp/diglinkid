<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;
use Altum\Title;
use Altum\Middlewares\Csrf;
use Altum\Response;
use Illuminate\Database\Capsule\Manager as DB;
use Carbon\Carbon;

class Ticket extends Controller {
	public $ticket;

	public function index() {
		Authentication::guard();
		$view = new \Altum\Views\View('ticket/index', (array) $this);
		//print_r( $this->user->user_id);exit();
		/*load data ticket client */
		$rawData=DB::table('ticket')->where('user_id', $this->user->user_id)->orderBy('last_replay','DESC')->get();
		$data = [
			  'user'    => $this->user,
			  'data'	=> $rawData
		];
        $this->add_view_content('content', $view->run($data));
	}


	public function open(){
		Authentication::guard();
		$view = new \Altum\Views\View('ticket/open', (array) $this);
		$data = [
			'user'    => $this->user
	  	];

		$this->add_view_content('content', $view->run($data));
	}

	public function submit(){
		$error=true;
		$alert='';
		$id=0;
		Authentication::guard();
		if(!Csrf::check()){
			$alert='invalid token';
		}elseif($_POST['message'] ==''){
			$alert='TIket message is required';
		}else{
			$_POST['subject']=Database::clean_string($_POST['subject']);
			$_POST['dep']=Database::clean_string($_POST['dep']);
			$_POST['priority']=Database::clean_string($_POST['priority']);
			$time=Carbon::now();

			try {
			$tiketID=DB::table('ticket')->insertGetId(
							[
								'user_id'  	=> $this->user->user_id,
								'name'		=> $this->user->password,
								'email'		=> $this->user->email,
								'subject'	=> $_POST['subject'],
								'department'	=> $_POST['dep'],
								'priority'	=> $_POST['priority'],
								'message'	=> $_POST['message'],
								'status'	=> 'Open',
								'date_create' => $time,
								'last_replay' => $time
							]
					);
			} catch (Illuminate\Database\QueryException $e) {
				//dd($e);
			}
			if($tiketID){
				$error=false;
				$alert='Success submit ticket';
				$id=$tiketID;
			}else{
				$alert='Error submit ticket';
			}
		}
		$return=[
			'error' => $error,
			'alert' => $alert,
			'id'	=> $id
		];
		echo json_encode($return);
		exit();
	}


	public function viewticket(){
		$this->t_id =  isset($this->params[0]) ? $this->params[0] : false;
		Authentication::guard();
		

		$ticket=DB::table('ticket')->where('id',$this->t_id)->first();
		$replay=DB::table('ticket_reply')->where('ticket_id',$this->t_id )->orderBy('replay_id')->get();
		$data = ['data' => $ticket];
		$view = new \Altum\Views\View('ticket/replay_ticket_modal', (array) $this);
		\Altum\Event::add_content($view->run($data), 'modals');	
		
		$data = [
			'user'    	=> $this->user,
			'ticket'	=> $ticket,
			'replay'	=> $replay
	  	];

		

		$view = new \Altum\Views\View('ticket/viewticket', (array) $this);
		$this->add_view_content('content', $view->run($data));
		
	}


	public function reply(){
		$error=true;
		$alert='';
		$id=0;

		//print_r($_POST);exit();
		//print_r($this->user);
		Authentication::guard();
		if(!Csrf::check()){
			$alert='invalid token. please relaod';
		}elseif($_POST['message'] ==''){
			$alert='TIket message is required';
		}else{
			$ticket_id = (int) $_POST['tid'];
			$user_id = $this->user->user_id;
			$user_name = $this->user->name;
			$type = 'user';
			$replay_message = $_POST['message'];
			$date_create = Carbon::now();

			DB::table('ticket_reply')->insert([
				'ticket_id' => $ticket_id,
				'user_id' 	=> $user_id,
				'user_name' => $user_name,
				'type'		=> $type,
				'replay_message' => $replay_message,
				'date_create' => $date_create
			]);

			DB::table('ticket')->where('id',$ticket_id)->update(['last_replay' => $date_create, 'status' => 'Customer-Replay', 'open' => 0 ]);
			$error=false;
			$alert='Success replay ticket';
			$id=$ticket_id;
		}

		$return=[
			'error' => $error,
			'alert' => $alert,
			'id'	=> $id
		];
		echo json_encode($return);
		exit();
	}


	public function close(){
		Authentication::guard();
		//print_r($_POST);

		$id =(int) $_POST['id'];
		DB::table('ticket')->where('id',$id)->update(['status' => 'Closed']);
		$return=[
			'error' => false,
			'alert' => '',
		];

		exit(json_encode($return));
	}

	public function isopen(){
		$id =(int) $_POST['id'];
		DB::table('ticket')->where('id',$id)->update(['open' => 0]);
		$return=[
			'error' => false,
			'alert' => '',
		];

		exit(json_encode($return));
	}


	
	public function submit_old(){
		
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