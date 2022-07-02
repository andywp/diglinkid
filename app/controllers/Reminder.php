<?php
namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\Date;
use Altum\Routing\Router;
class Reminder extends Controller {

    public function index() {
		ob_end_clean();
	
		
		
		$package_expiration_date = date('Y-m-d',strtotime(date('Y-m-d'). "+7 days"));
		//$data=$this->database->query("SELECT * FROM users where date(package_expiration_date) ='".$package_expiration_date."' ");
		$data=$this->database->query("SELECT user_id,name,email,package_id,package_expiration_date FROM users where  date(package_expiration_date) ='".$package_expiration_date."'  "); 
		//$data=$this->database->query("SELECT user_id,name,email,package_id,package_expiration_date FROM users where  user_id =3  ");
		
		
		
		$users=$data->fetch_all(MYSQLI_ASSOC);
		/* echo '<pre>';
		print_r($users);
		echo '</pre>';  */
		/* exit();  */
		foreach($users as $r){
			$packages=$this->database->query("SELECT package_id,monthly_price,annual_price FROM packages where  name  LIKE '".$r['package_id']."%'  ");
			$packages=$packages->fetch_object();
			$packagesID=$packages->package_id;
			
			$payment=$this->database->query("SELECT * FROM payments WHERE user_id ='".$r['user_id']."' and package_id=".$packagesID." ORDER BY `id` DESC Limit 1");
			$paymentData=$payment->fetch_object();
			/* echo '<pre>';
			print_r($paymentData);
			echo '</pre>'; */ 
				
			$amount=($paymentData->plan == 'monthly')?$packages->monthly_price : $packages->annual_price;
			$addQuery="		
						user_id=".$r['user_id'].", 
						subscription_id='',
						email='".$r['email']."',
						name='".$r['name']."',
						amount='".$amount."',
						currency='IDR',
						date='".date('Y-m-d h:i:sa')."',
						type='".$paymentData->type."',
						plan='".$paymentData->plan."',
						package_id='".$packagesID."',
						note='1'
						"; 
			$data=Database::$database->query("insert into  payments set 
															   processor='', 
															".$addQuery);
			$id_transaksi=Database::$database->insert_id;
			$urlPAy=SITE_URL.'payment/snaprenew/'.base64_encode($id_transaksi);
			
			$content='';
			$content.='<p style="color: #2b2e82; font-size: 15px; font-weight: bold;" ><b>Haloo '.$r['name'].'</b></p>';
			$content.='<br>';
			$content.='<p>Paket Diglink anda akan kadaluarsa dalam 7 hari kedepan.</p>';
			$content.='<br>';
			$content.='<p>Paket <b>'.$r['package_id'].' - ('.$package_expiration_date.')</b> (7 Days) </p>';
			$content.='<br>';
			$content.='<p>Silahkan melakukan perpanjangan paket '.$r['package_id'].' sebelum tanggal kadaluarsa. Apabila anda tidak melakukan perpanjangan maka sebagain fitur akan kami nonaktifkan atau kembali ke paket free</p>';
			$content.='<br>';
			$content.='Terimakasih atas kepercayaan Anda.';
			$content.='<br>';
			$content.='<br>';
			$content.='<p style="    text-align: center;font-weight: bold; margin-bottom: 20px;" >Klik disini untuk melakukan pembayaran</p>';
			$content.='<p style="    text-align: center;" ><a target="_blank" href="'.$urlPAy.'" style="padding: 15px 30px;
								background: #38b2ac;
								border: #38b2ac;
								color: #fff;
								border-radius: .25rem;
								vertical-align: middle;
								display: inline-block;
								line-height: 1.5;
								box-shadow: 0 0 .8rem 0 rgba(136, 152, 170, .15) !important;
								transition: all .3s ease-in-out;text-decoration: none;">Bayar Sekarang</a>';
			
			$content.='<br>';
			$content.='<br>';
			$content.='<p  style="color: #2b2e82; font-size: 15px; font-weight: bold;" ><b>Salam</b></p>';
			$content.='<p  style="color: #2b2e82; font-size: 15px; font-weight: bold;" >Tim Diglink</p>';
			send_mail($this->settings,$r['email'],'[no-replay] Notifikasi Perpanjangan '.$r['package_id'],$content);
				
		}
		//echo $content;
	   exit();
    }
	
	
	
	public function expiration(){
		
		 $now = date('Y-m-d');
		
		/* echo "SELECT name,package_id,package_expiration_date FROM users where  date(package_expiration_date) ='".$package_expiration_date."'  "; */
		$data=$this->database->query("SELECT user_id,name,email,package_id,package_expiration_date FROM users where  date(package_expiration_date) ='".$now."'  ");
		//$data=$this->database->query("SELECT user_id,name,email,package_id,package_expiration_date FROM users where  user_id =3 ");
		$users=$data->fetch_all(MYSQLI_ASSOC);
	
		foreach($users as $r){
			$packages=$this->database->query("SELECT package_id,monthly_price,annual_price FROM packages where  name  LIKE '".$r['package_id']."%'  ");
			$packages=$packages->fetch_object();
			 $packagesID=$packages->package_id;
			echo "SELECT * FROM payments WHERE user_id ='".$r['user_id']."' and package_id=".$packagesID." ORDER BY `id` DESC Limit 1";
			$payment=$this->database->query("SELECT * FROM payments WHERE user_id ='".$r['user_id']."' and package_id=".$packagesID." ORDER BY `id` DESC Limit 1");
			$paymentData=$payment->fetch_object();
			//$paymentData->id
			$id_transaksi=$paymentData->id;
			$urlPAy=SITE_URL.'payment/snaprenew/'.base64_encode($id_transaksi);
			
			$mail='';
			$mail.='<p style="color: #2b2e82; font-size: 15px; font-weight: bold;" ><b>Haloo '.@$r['name'].'</b></p>';
			$mail.='<br>';
			$mail.='<p>Saat ini Paket Diglink sudah tidak aktif.</p>';
			$mail.='<br>';
			$mail.='<p>Paket <b>'.@$r['package_id'].' - ('.$now.')</b> expiration </p>';
			$mail.='<br>';
			$mail.='<p>Silahkan melakukan pembayaran untuk mengaktifkan kembali  paket '.@$r['package_id'].' anda </p>';
			$mail.='<br>';
			$mail.='Terimakasih atas kepercayaan Anda.';
			$mail.='<br>';
			$mail.='<p style="    text-align: center;font-weight: bold; margin-bottom: 20px;" >Klik disini untuk melakukan pembayaran</p>';
			$mail.='<p style="    text-align: center;" ><a target="_blank" href="'.$urlPAy.'" style="padding: 15px 30px;
								background: #38b2ac;
								border: #38b2ac;
								color: #fff;
								border-radius: .25rem;
								vertical-align: middle;
								display: inline-block;
								line-height: 1.5;
								box-shadow: 0 0 .8rem 0 rgba(136, 152, 170, .15) !important;
								transition: all .3s ease-in-out;text-decoration: none;">Bayar Sekarang</a>';
			
			$mail.='<br>';
			$mail.='<br>';
			$mail.='<p  style="color: #2b2e82; font-size: 15px; font-weight: bold;" ><b>Salam</b></p>';
	 		$mail.='<p  style="color: #2b2e82; font-size: 15px; font-weight: bold;" >Tim Diglink</p>';
			send_mail($this->settings,$r['email'],'[no-replay] Notifikasi expiration Paket '.$r['package_id'],$mail);
					
		}
		
		
		exit();
	}
	
	

}

?>