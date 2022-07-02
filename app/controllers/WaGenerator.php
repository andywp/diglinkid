<?php

namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\db\db;
use Altum\Date;
use Altum\Middlewares\Authentication;
use Altum\Middlewares\Csrf;
use Altum\Models\Package;
use Altum\Models\User;
use Exception;

class WaGenerator extends Controller { 

	public function index() {
		Authentication::guard();
		$view = new \Altum\Views\View('wa-generator/index', (array) $this);
		$data = [];
        $this->add_view_content('content', $view->run($data));
		//exit();
	}

	public function create(){
		$error=true;
		$alert='';
		$url='';
		$_POST['pesan'] = Database::clean_string($_POST['pesan']);
		//$_POST['phone'] = $_POST['phone'];
		$url=SITE_URL.'w/';
		
		if($_POST['phone'] == ''){
			$alert='No telpon tidak boleh kosong';
		}else{
			/*cek code */
			$unix='';
			$random=$this->randomPassword(6,100,);
			$i=0;
			foreach($random as $k=>$v){
				$data=$this->database->query("SELECT id FROM wa where url='".$v."'");
				$cek=$data->fetch_object();
				//var_dump($cek);
				if(!$cek){
					$unix=$v;
					break;
				}
				
				$i++;
			}
			$url.=$unix;
			// $this->user->name;
			$telepon=$_POST['code'].$_POST['phone'];
			$stmt = Database::$database->prepare("INSERT INTO `wa` (`phone`, `pesan`, `url`, `ip`, `user`) VALUES (?, ?, ?, ?,?)");
			@$stmt->bind_param('sssss',$telepon,$_POST['pesan'], $unix,$this->getClientIP(),$this->user->name);
			$stmt->execute();
			$stmt->close();
			
			$error=false;
			$alert='Tautan berhasil dibuat';
			$url=$url;
			
			
			
			
			
		}
		
		echo json_encode(array(
							'error' => $error,
							'alert'	=> $alert,
							'url'	=> $url
						));
		exit();
	}


	private function randomPassword($length,$count='1', $characters='lower_case,upper_case,numbers') {
   
		$symbols = array();
		$passwords = array();
		$used_symbols = '';
		$pass = '';
		// an array of different character types    
		$symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
		$symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$symbols["numbers"] = '1234567890';
		//$symbols["special_symbols"] = '!?~@#-+<>[]{}';
	 
		$characters = explode(",",$characters); 
		foreach ($characters as $key=>$value) {
			$used_symbols .= $symbols[$value]; 
		}
		$symbols_length = strlen($used_symbols) - 1; 
		 
		for ($p = 0; $p < $count; $p++) {
			$pass = '';
			for ($i = 0; $i < $length; $i++) {
				$n = rand(0, $symbols_length); 
				$pass .= $used_symbols[$n]; 
			}
			$passwords[] = $pass;
		}
		 
		if($count == 1){ 
			return $passwords[0];
		}else{
			return $passwords;
		}
	}
	
	private function getClientIP(){

		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
		else
		$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}
	
	
}