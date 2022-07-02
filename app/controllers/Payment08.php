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
		/** voucher ***/
			@date_default_timezone_set('Asia/Jakarta');
			$date=date('Y-m-d');
			$now=strtotime($date);
			if(!empty($_POST['code'])){
			$data=$this->database->query("SELECT * FROM cupon where start_date <= '".$date."' and end_date >= '".$date."' and cupon='".trim(@$_POST['code'])."'  ");
				$cupon=$data->fetch_object();
				$voucher=$cupon->cupon;
				$discount=$cupon->diskon;
				
			}else{
				$voucher='';
				$discount='';
			}
		
		/**---- **/
		
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
						package_id='".$_POST['pageID']."',
						voucher='".@$voucher."',
						discount='".@$discount."'
						
						
					";
		
		global $config;
		
		$nama=explode(' ',$user->name);
		$namaDepan=$nama[0]; 
		$namaBelakang=str_replace($namaDepan,'',$user->name);
		$data=Database::$database->query("insert into  payments set 
															   processor='', 
															".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				redirect('payment/snap/'.$id_transaksi);
				exit();
		switch($_POST['payment_method']){
           /*  case 'gopay':
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
			

				$mitrans=$this->curl($config['url'],$param);
			
				
				$_SESSION['status']=$mitrans;
				if($mitrans->status_code == '201'){
					$data=Database::$database->query("update payments set status='".$mitrans->transaction_status."', return_api='".base64_encode(serialize($mitrans))."', transaction_id='".$mitrans->transaction_id."' where id='".$id_transaksi."' ");
					redirect('payment/gopay/'.$id_transaksi);
			
					
					
					
				}else{
					$_SESSION['dd']=$mitrans;
					redirect('payment/error/');
				}
				
			
			break;
			case 'bca':
				
				
				
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

				
				$mitrans=$this->curl($config['url'],$param);
				 
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
								
				
				$mitrans=$this->curl($config['url'],$param);
				
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
			
				$mitrans=$this->curl($config['url'],$param);
		
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
			
			
			
			
			break; */
			default:
				/** snap **/
				/* echo '<pre>';
				
				print_r($_POST);
				echo '</pre>';
				exit(); */
				$data=Database::$database->query("insert into  payments set 
															   processor='', 
															".$addQuery);
				$id_transaksi=Database::$database->insert_id;
				redirect('payment/snap/'.$id_transaksi);
				exit();
			
           // break;
        }
		
		
		$view = new \Altum\Views\View('payment/index', (array) $this);
		$data = [
			  'payment'    => $payments,
		];
        $this->add_view_content('content', $view->run($data));
	}
	
	
	
	public function snap(){
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
		
		
		$view = new \Altum\Views\View('payment/snap', (array) $this);
		$data = [
            'payment'    => $payments,
			'jenis'		=>  'gopay' 
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
		$date = date('Y-m-d',strtotime(date('Y-m-d'). "-1 days"));
	  	$query="SELECT * FROM payments where  date(date) BETWEEN '".$date."' AND '".date('Y-m-d')."' and status !='settlement' and status !='capture' and status !='expire' ";
	 	
	
		$data=$this->database->query($query);
		$product=$data->fetch_all(MYSQLI_ASSOC);
		
		$addQuery='';
		$package_expiration_date='';
		foreach($product as $r){
			if($r['transaction_id'] !=''){
			$cek=$this->httpGet($config['urlgopay'].$r['transaction_id'].'/status');
				/*  echo '<pre>';
				print_r($cek);
				echo '</pre>'; 
				exit(); */
				if(@$cek->transaction_status =='settlement'){
					$data=$this->database->query("SELECT * FROM packages WHERE package_id =".$r['package_id']);
					$xx=$data->fetch_object();
			
					if($r['plan'] == 'monthly'){
						$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
					}
					if($r['plan'] == 'annual'){
						$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
					}
			
					$this->database->query("update users set package_id='".$xx->name."',package_settings=".json_encode($xx->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$r['user_id']);

					$addQuery.=" , date_paid='".date('Y-m-d H:i:s')."' ";
					//@$alert='Transaction '.$cek->transaction_status.' '.date('Y-m-d H:i:s');
					$error=false;
					 send_mail( $this->settings,explode(',', @$this->settings->email_notifications->emails), 'Transaction #'.$cek->order_id.' settlement Via '.strtoupper($r['processor']), sprintf($this->language->global->email_notifications->new_payment_body, $cek->gross_amount, $cek->currency), $test = true); 
					
				}
				
				if(@$cek->transaction_status =='capture'){
					$data=$this->database->query("SELECT * FROM packages WHERE package_id =".$r['package_id']);
					$xx=$data->fetch_object();
			
					if($r['plan'] == 'monthly'){
						$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
					}
					if($r['plan'] == 'annual'){
						$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
					}
			
					$this->database->query("update users set package_id='".$xx->name."',package_settings=".json_encode($xx->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$r['user_id']);

					$addQuery.=" , date_paid='".date('Y-m-d H:i:s')."' ";
					//@$alert='Transaction '.$cek->transaction_status.' '.date('Y-m-d H:i:s');
					$error=false;
					 send_mail( $this->settings,explode(',', @$this->settings->email_notifications->emails), 'Transaction #'.$cek->order_id.' settlement Via '.strtoupper($r['processor']), sprintf($this->language->global->email_notifications->new_payment_body, $cek->gross_amount, $cek->currency), $test = true); 
					
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
	
	public function checkout(){
		global $config;
		//echo print_r($config);
		
		$transaction = file_get_contents('php://input');

		// Change "app.sandbox.midtrans.com" to "app.midtrans.com" when you are deploying to production environment 

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_URL =>	$config['snap'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $transaction,
		  CURLOPT_HTTPHEADER => array(
			"accept: application/json",
			"Authorization: Basic ".base64_encode($config['server_key']), 
			"cache-control: no-cache",
			"content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
		
		
		
		exit();
	}
	
	public function notification(){
		
		$this->cron_cek_gopay();
		exit();
	}
	
	
	

	public function finish(){
		global $config;
		$data=$this->httpGet($config['urlgopay'].$_GET['order_id'].'/status');
		
		$dataQWR=$this->database->query("SELECT user_id,package_id,plan FROM payments WHERE id =".$_GET['order_id']);
		$payments=$dataQWR->fetch_object();
	 	$package_id=$payments->package_id;
	 	$plan=$payments->plan;
	 	$user_id=$payments->user_id;
		
		
		$dataQWR=$this->database->query("SELECT package_id,name,settings FROM packages WHERE package_id =".$package_id);
		$paket=$dataQWR->fetch_object(); 
/* 		 echo '<pre>';
		print_r($paket);
		echo '</pre>'; 
		 echo '<pre>';
		print_r($data);
		echo '</pre>';  */
		$addquery="";
		$package_expiration_date='';
		if($data->payment_type =='credit_card'){

			if($data->transaction_status == 'capture'){
				if($plan == 'monthly'){
					$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
				}
				if($plan == 'annual'){
					$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
				}
				Database::$database->query("update users set package_id='".$paket->name."',package_settings=".json_encode($paket->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$user_id);
			}
			
			$data=Database::$database->query("update payments set processor='Credit Card', status='".@$data->transaction_status."', transaction_id='".$data->transaction_id."' , date_paid='".$data->transaction_time."'  where id='".$_GET['order_id']."' ");
			
			
		}elseif($data->payment_type=='gopay'){
			
			if($data->transaction_status =='settlement'){
				if($plan == 'monthly'){
					$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
				}
				if($plan == 'annual'){
					$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
				}
				Database::$database->query("update users set package_id='".$paket->name."',package_settings=".json_encode($paket->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$user_id);
				
				$addquery.=", date_paid='".$data->settlement_time."'  ";
				
			}
			
			Database::$database->query("update payments set processor='".$data->payment_type."', status='".@$data->transaction_status."', transaction_id='".$data->transaction_id."' ".$addquery." where id='".$_GET['order_id']."' ");
			
		}else{
			if($data->transaction_status =='settlement'){
				if($plan == 'monthly'){
					$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
				}
				if($plan == 'annual'){
					$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
				}
				Database::$database->query("update users set package_id='".$paket->name."',package_settings=".json_encode($paket->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$user_id);
				
				$addquery.=", date_paid='".$data->settlement_time."'  ";
				
			}
			
			
			
			$data=Database::$database->query("update payments set processor='".$data->payment_type."', status='".@$data->transaction_status."', transaction_id='".$data->transaction_id."', date_paid='".@$data->settlement_time."' where id='".$_GET['order_id']."' ");
			
		}
		//$this->cron_cek_gopay();
		//exit();
		redirect('invoice/'.$_GET['order_id']);
		//echo 'hasdjhadhasdj';
		exit();
	}

	

}
