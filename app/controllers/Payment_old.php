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

class Payment extends Controller { 

	public function index() {
		Authentication::guard();
		$user=$this->user;
		$urlCallBack='';
		
		
		$data=$this->database->query("SELECT * FROM packages where package_id='".intval($_POST['pageID'])."'");
		$product=$data->fetch_object();
	
		
		$amount=($_POST['payment_plan']=='monthly')?$product->monthly_price:$product->annual_price;
		
		
		$addQuery="		
						user_id=".$this->user->user_id.", 
						subscription_id='".$this->user->payment_subscription_id."',
						email='".$this->user->email."',
						name='".$this->user->name."',
						amount='".$amount."',
						currency='IDR',
						date='".date('Y-m-d h:i:sa')."',
						type='".$_POST['payment_type']."',
						plan='".$_POST['payment_plan']."',
						package_id='".$_POST['pageID']."'
						
						
					";
		
		global $config;
		
		$nama=explode(' ',$user->name);
		$namaDepan=$nama[0]; 
		$namaBelakang=str_replace($namaDepan,'',$user->name);
		
		
		switch($_POST['payment_method']){
            case 'gopay':
			 	$data=Database::$database->query("insert into  payments set 
															   processor='gopay', 
															".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				$param=array(
								'payment_type' => 'gopay',
								'transaction_details' => array(
															'order_id' => $id_transaksi,
															'gross_amount'=> $amount,
															),
								'item_details' => [array(
															'id' => $_POST['pageID'],
															'price' => $amount,
															'quantity' => 1,
															'name'	=> 'Package '.$product->name
															
															)],
								'customer_details' => array(
																'email' => $user->email,
																'first_name' => $namaDepan,
																'last_name'	 => $namaBelakang,
																'phone'		=> ''
															)
							); 
				//curl to mitrans	
/* 			 echo '<pre>';
				print_r($param);
				echo '</pre>';	
exit();	 */			
				/* echo '<pre>';
				print_r($config);
				echo '</pre>'; */

				$mitrans=$this->curl($config['url'],$param);
				/* echo '<pre>';
				print_r($mitrans);
				echo '</pre>'; 
				exit();  */ 
				$_SESSION['status']=$mitrans;
				if($mitrans->status_code == '201'){
					$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."', transaction_id='".$mitrans->transaction_id."' where id='".$id_transaksi."' ");
					redirect('payment/gopay/'.$id_transaksi);
					
					/* $payments=$this->database->query("SELECT a.*, b.name as packages FROM  payments as a, packages as b 
														where 
															a.package_id=b.package_id
														and														
															a.id='".$id_transaksi."' 
														and
															a.user_id ='".$this->user->user_id."' "); */
					
					
					
				}else{
					$_SESSION['dd']=$mitrans;
					redirect('payment/error/');
				}
				
				
				/* echo '<pre>';
				print_r($mitrans);
				echo '</pre>'; */
				
				
				
			
			
			break;
			case 'bca':
				/* echo '<pre>';
				print_r($user);
				echo '</pre>';
				exit(); */
				
				
				$data=Database::$database->query("insert into  payments set 
																   processor='bca', 
																".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				$param=array(
									'payment_type' => 'bank_transfer',
									'transaction_details' => array(
																'order_id' => $id_transaksi,
																'gross_amount'=> $amount,
																),
									'customer_details' => array(
																'email' => $user->email,
																'first_name' => $namaDepan,
																'last_name'	 => $namaBelakang,
																'phone'		=> ''
															),
									'item_details' => [array(
															'id' => $_POST['pageID'],
															'price' => $amount,
															'quantity' => 1,
															'name'	=> 'Package '.$product->name
															
															)],
									
									'bank_transfer'	=> array(
															'bank' => 'bca'
														)
									
								);			
				$mitrans=$this->curl($config['url'],$param);
				/* echo '<pre>';
				print_r($mitrans);
				echo '</pre>';
				exit();  */ 
				if($mitrans->status_code == '201'){
					$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."' , transaction_id='".$mitrans->transaction_id."' where id='".$id_transaksi."' ");
					redirect('payment/va/'.$id_transaksi);
					
				}else{
					$_SESSION['dd']=$mitrans;
					redirect('payment/error/');
				}

			break;
			case 'mandiri':
				$data=Database::$database->query("insert into  payments set 
																   processor='mandiri', 
																".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				$param=array(
									'payment_type' => 'echannel',
									'transaction_details' => array(
																'order_id' => $id_transaksi,
																'gross_amount'=> $amount,
																),
									'item_details' => [array(
														'id' => $_POST['pageID'],
														'price' => $amount,
														'quantity' => 1,
														'name'	=> 'Package '.$product->name
														
														)],
									'echannel' => array(
														"bill_info1" => "Payment For:",
														"bill_info2" => "diglink",
														"bill_info3" => "Name :",
														"bill_info4" => $user->name,
														"bill_info5" => "Paket",
														"bill_info6" => $product->name,
													)
														
								);	

				/* echo '<pre>';
				print_r($param);
				echo '</pre>'; 
				exit(); */
				$mitrans=$this->curl($config['url'],$param);
				/*   echo '<pre>';
				print_r($mitrans);
				echo '</pre>';
				exit(); */  
				if($mitrans->status_code == '201'){
					$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."' , transaction_id='".$mitrans->transaction_id."' where id='".$id_transaksi."' ");
					redirect('payment/va/'.$id_transaksi);
					
				}else{
					$_SESSION['dd']=$mitrans;
					redirect('payment/error/');
				}
			
			break;
			case 'bni':
				$data=Database::$database->query("insert into  payments set 
																   processor='bni', 
																".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				$param=array(
									'payment_type' => 'bank_transfer',
									'transaction_details' => array(
																'order_id' => $id_transaksi,
																'gross_amount'=> $amount,
																),
									'customer_details' 	=> array(
																'email' => $user->email,
																'first_name' => $namaDepan,
																'last_name'	 => $namaBelakang,
																'phone'		=> ''
																),
									'item_details' => [array(
															'id' => $_POST['pageID'],
															'price' => $amount,
															'quantity' => 1,
															'name'	=> 'Package '.$product->name
															
															)],
									'bank_transfer'	=> array(
															'bank' => 'bni'
														)
								);			
								
				/*  echo '<pre>';
				print_r($param);
				echo '</pre>'; 
				exit();  */
				$mitrans=$this->curl($config['url'],$param);
				/* echo '<pre>';
				print_r($mitrans);
				echo '</pre>'; 
				exit();  */ 
				if($mitrans->status_code == '201'){
					$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."' , transaction_id='".$mitrans->transaction_id."' where id='".$id_transaksi."' ");
					redirect('payment/va/'.$id_transaksi);
					
				}else{
					$_SESSION['dd']=$mitrans;
					redirect('payment/error/');
				}
			break;
			case 'permata':
			
				$data=Database::$database->query("insert into  payments set 
																   processor='permata', 
																".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				$param=array(
									'payment_type' => 'bank_transfer',
									'transaction_details' => array(
																'order_id' => $id_transaksi,
																'gross_amount'=> $amount,
																),
									'customer_details' 	=> array(
																'email' => $user->email,
																'first_name' => $namaDepan,
																'last_name'	 => $namaBelakang,
																'phone'		=> ''
																),
									'item_details' => [array(
															'id' => $_POST['pageID'],
															'price' => $amount,
															'quantity' => 1,
															'name'	=> 'Package '.$product->name
															
															)],
									
														
								);			
			  /* echo '<pre>';			
			echo 	 json_encode($param);
				echo '</pre>';  
							exit();	 */ 
				$mitrans=$this->curl($config['url'],$param);
				/*  echo '<pre>';
				print_r($mitrans);
				echo '</pre>';
				exit(); */  
				if($mitrans->status_code == '201'){
					$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."' , transaction_id='".$mitrans->transaction_id."' where id='".$id_transaksi."' ");
					redirect('payment/va/'.$id_transaksi);
					
				}else{
					$_SESSION['dd']=$mitrans;
					redirect('payment/error/');
				}
			break;
			//creditcard
			case 'creditcard':
				$data=Database::$database->query("insert into  payments set 
															   processor='creditcard', 
															".$addQuery);
				$id_transaksi=Database::$database->insert_id;
			
				redirect('payment/creditcard/'.$id_transaksi);
			
			
			
			
			break;
			default:
            break;
        }
		
		
		$view = new \Altum\Views\View('payment/index', (array) $this);
		$data = [
			  'payment'    => $payments,
		];
        $this->add_view_content('content', $view->run($data));
	}
	
	
	public function gopay(){
		Authentication::guard();
		$this->paymentsID = isset($this->params[0]) ? $this->params[0] : false;
		if(!$this->paymentsID){
			redirect('account-package');
		}
		
		
		$data=$this->database->query("SELECT a.*, b.name as packages FROM  payments as a, packages as b 
														where 
															a.package_id=b.package_id
														and														
															a.id='".intval($this->paymentsID)."' 
														and
															a.user_id ='".$this->user->user_id."' ");
		$payments=$data->fetch_object();
		if(!$payments){
			redirect('account-payments');
			exit();
		}
		
		
		$view = new \Altum\Views\View('payment/gopay', (array) $this);
		$data = [
            'payment'    => $payments,
			'jenis'		=>  'gopay' 
        ];
        $this->add_view_content('content', $view->run($data));
	}
	
	public function va(){
		Authentication::guard();
		$this->paymentsID = isset($this->params[0]) ? $this->params[0] : false;
		if(!$this->paymentsID){
			redirect('account-package');
		}
		$data=$this->database->query("SELECT a.*, b.name as packages FROM  payments as a, packages as b 
														where 
															a.package_id=b.package_id
														and														
															a.id='".intval($this->paymentsID)."' 
														and
															a.user_id ='".$this->user->user_id."' ");
		$payments=$data->fetch_object();
		if(!$payments){
			redirect('account-payments');
			exit();
		}
		
		
		$view = new \Altum\Views\View('payment/va', (array) $this);
		$data = [
            'payment'    => $payments,
			'jenis'		=>  'va' 
        ];
        $this->add_view_content('content', $view->run($data));
	}
	
	
	public function creditcard(){
		Authentication::guard();
		$this->paymentsID = isset($this->params[0]) ? $this->params[0] : false;
		if(!$this->paymentsID){
			redirect('account-package');
		}
		$data=$this->database->query("SELECT a.*, b.name as packages FROM  payments as a, packages as b 
														where 
															a.package_id=b.package_id
														and														
															a.id='".intval($this->paymentsID)."' 
														and
															a.user_id ='".$this->user->user_id."' ");
		$payments=$data->fetch_object();
		if(!$payments){
			redirect('account-package');
			exit();
		}
		
		$view = new \Altum\Views\View('payment/creditcard', (array) $this);
		$data = [
			  'data'    => $payments,
		];
        $this->add_view_content('content', $view->run($data));
		
		
		
	}
	
	
	
	
	public function error(){
		
		$view = new \Altum\Views\View('payment/error', (array) $this);
		$data = [
			  'error'    => $_SESSION['dd'],
		];
        $this->add_view_content('content', $view->run($data));
		
	}
	
	
	function curl($url,$arrayParam){
		global $config;
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'Accept: application/json',
													'Content-Type: application/json',
													'Authorization: Basic  '.base64_encode($config['server_key'])
													));
		curl_setopt($ch,CURLOPT_POST, count($arrayParam));
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($arrayParam));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//execute post
		$result = curl_exec($ch);
		$err = curl_error($ch);
		//close connection
		curl_close($ch);
		 $result=json_decode($result);
		 if ($err) {
			  die( "cURL Error #:" . $err );
			}
		return $result;
	}
	
	function httpGet($url)
		{
			global $config;
			$ch = curl_init();  
		
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//  curl_setopt($ch,CURLOPT_HEADER, false); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Accept: application/json',
				'Content-Type: application/json',
				'Authorization: Basic  '.base64_encode($config['server_key'])
				));
			$output=curl_exec($ch);
			$err = curl_error($ch);
			$output=json_decode($output);
			if ($err) {
			  die( "cURL Error #:" . $err );
			}
			curl_close($ch);
			return $output;
		}
	
	public function cekpay(){
		$error=true;
		$alert='';
		$id='';
		

		if(isset($_POST['val'])){
			//print_r($_POST);
			$url=base64_decode($_POST['val']);
			$cek=$this->httpGet($url,array());
			//var_dump($cek);
			/* echo '<pre>';
			print_r($cek);
			echo '</pre>'; */
			if(preg_match("/Success/i", $cek->status_message)) {
				//print_r($this->settings->email_notifications->emails);
				
				$addQuery='';
				if($cek->transaction_status=='settlement'){
					$addQuery.=" , date_paid='".$cek->settlement_time."' ";
					$alert='Transaction '.$cek->transaction_status.' '.$cek->settlement_time;
					$error=false;
					$query="SELECT processor FROM payments where id='".$cek->order_id."'  ";
					$data=$this->database->query($query);
					$procecor=$data->fetch_object();
					//print_r($procecor);
					send_mail($this->settings,explode(',',@$this->settings->email_notifications->emails), 'Transaction #'.$cek->order_id.' settlement Via '.$procecor->processor, sprintf(@$this->language->global->email_notifications->new_payment_body, $cek->gross_amount, $cek->currency), $test = true);
					
				}else{
					$alert='Transaction '.$cek->transaction_status;
				}
				$id=$cek->order_id;
				$payments=$this->database->query('update payments set status=\''.$cek->transaction_status.'\' '.$addQuery.' where id=\''.$cek->order_id.'\' ');
				
				

			  } else {
				$alert='Transaction not found';
			  }  

			  $param=array(
						'alert' => $alert,
						'error' => $error,
						'id'	=> $id
			  		);


			echo json_encode($param);

		}



		exit();
	}
	
	
	public function cron_cek_gopay(){
		
		global $config;
		/* $date = strtotime(date('Y-m-d')); */
		$date = date('m-d-Y',strtotime(date('Y-m-d'). "-1 days"));
	 	$query="SELECT * FROM payments where  date(date) BETWEEN '".$date."' AND '".date('Y-m-d')."' and status !='settlement' ";
		$data=$this->database->query($query);
		$product=$data->fetch_all(MYSQLI_ASSOC);
		/* echo '<pre>';
			print_r($product);
			echo '</pre>'; */
		$addQuery='';
		foreach($product as $r){
			if($r['transaction_id'] !=''){
			//echo $config['url'].$r['transaction_id'].'/status';
			//https://api.sandbox.veritrans.co.id/v2/827769cf-173a-40b0-840d-8854a92e25fb/status
			$cek=$this->httpGet($config['urlgopay'].$r['transaction_id'].'/status');
			/* echo '<pre>';
			print_r($cek);
			echo '</pre>'; */  
				if(@$cek->transaction_status=='settlement'){
					$addQuery.=" , date_paid='".$cek->settlement_time."' ";
					$alert='Transaction '.$cek->transaction_status.' '.$cek->settlement_time;
					$error=false;
					send_mail( $this->settings,explode(',', $this->settings->email_notifications->emails)/* 'andy.wijang@gmail.com' */, 'Transaction #'.$cek->order_id.' settlement Via '.strtoupper($r['processor']), sprintf($this->language->global->email_notifications->new_payment_body, $cek->gross_amount, $cek->currency), $test = true);
					
				}
				$id=$r['id'];
				$payments=$this->database->query('update payments set status=\''.$cek->transaction_status.'\' '.$addQuery.' where id=\''.$cek->order_id.'\' ');
			}
		}
		
		exit();
	}
	
	
	
/* 	public function mail_send($array,$via,$id,$admin=true ){
		
		
		$data=$this->database->query("SELECT * FROM payments where id='".intval($id)."'");
		$product=$data->fetch_object();			
					
		if($admin){
			$content='
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td></td>
							</tr>
						</table>
			
					';
			//send_mail($settings, $to, $title, $content, $test = false)
			send_mail($this->settings,explode(',', $this->settings->email_notifications->emails), 'Transaction #'.$cek->order_id.' settlement Via GOPay', $content, $test = false);
				
		}
		
	}  */
	
	
	public function chackout(){
		
		//print_r($_POST);
		
		$data=$this->database->query("SELECT a.*, b.name as packages FROM  payments as a, packages as b 
														where 
															a.package_id=b.package_id
														and														
															a.id='".intval($_POST['transaksi'])."' 
														and
															a.user_id ='".$this->user->user_id."' ");
		$payments=$data->fetch_object();
		//print_r($payments);
		
		
		$nama=explode(' ',$payments->name);
		$namaDepan=$nama[0]; 
		$namaBelakang=str_replace($namaDepan,'',$payments->name);
		
		$param=array(
					'payment_type' 				=> 'credit_card',
					'transaction_details'		=> array(
															'order_id' 		=> $_POST['transaksi'],
															'gross_amount'	=> $_POST['amount']
														),
					'credit_card'				=> array(
															'token_id' 			=> $_POST['token'],
															'authentication'	=> true
													),
					'item_details'				 => [array(
															'id' => $payments->package_id,
															'price' => $_POST['amount'],
															'quantity' => 1,
															'name'	=> 'Package '.$payments->packages,
															'brand'	=> 'Package '.$payments->packages,
															'category'	=> 'Package '.$payments->packages,
															'merchant_name'	=> 'Diglink ',
															
															)],
					'customer_details'			=> array(
														'first_name' 	=> $namaDepan,
														'last_name'		=> $namaBelakang,
														'phone'			=> '',
													)
				);
		
			global $config;
			$mitrans=$this->curl($config['url'],$param);
			//print_r($mitrans);
			
			if($mitrans->status_code=='201'){
				$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."' , transaction_id='".$mitrans->transaction_id."' where id='".$_POST['transaksi']."' ");
				
					$alert=$mitrans->status_message;
					$error=false;
					$url=$mitrans->redirect_url;
					//redirect('payment/va/'.$id_transaksi);
				
				
			}else{
				$alert=$mitrans->status_message;
				$error=true;
				$url='';
				
				
			}
			
			 $param=array(
						'alert' => $alert,
						'error' => $error,
						'url'	=> $url
			  		);


			echo json_encode($param);
			
			
		exit();
	}
	
	
	
	
	public function notification(){
		
	/* 	$cekData=unserialize(base64_decode('czoyOiJbXSI7'));
		echo '<pre>';
		print_r($cekData);
		
		exit(); */
		 $data=Database::$database->query("insert into  notif set notif='".base64_encode( serialize( json_decode($_POST)))."' "); 
		exit();
	}



	

}
