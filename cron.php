<?php
@date_default_timezone_set('Asia/Jakarta');
include 'app/config/config.php';
$db = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD,DATABASE_NAME);
// cek koneksi
if($db->connect_error){
  die("Connection failed: " . $db->connect_error);
}
global $config;



$date = date('Y-m-d',strtotime(date('Y-m-d'). "-1 days"));
//echo "SELECT * FROM payments where  date(date) BETWEEN '".$date."' AND '".date('Y-m-d')."' and status !='settlement' and status !='capture' and status !='expire'";

$product=$db->query("SELECT * FROM payments where  date(date) BETWEEN '".$date."' AND '".date('Y-m-d')."' and status !='settlement' and status !='capture' and status !='expire'")->fetch_all(MYSQLI_ASSOC);
$addQuery='';
//adodb_pr($product);
foreach($product as $r){
	if($r['transaction_id'] !=''){
		$cek=httpGet($config['urlgopay'].$r['transaction_id'].'/status');
		//adodb_pr($cek);
		if(@$cek->transaction_status=='settlement'){
			$data=$db->query("SELECT package_id,name,settings FROM packages WHERE package_id =".$r['package_id']);
			$xx=$data->fetch_object();
			//adodb_pr($xx);
			if($r['plan'] == 'monthly'){
				$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
			}
			if($r['plan'] == 'annual'){
				$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
			}
			$db->query("update users set package_id='".$xx->name."',package_settings=".json_encode($xx->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$r['user_id']);
			
			$addQuery.=" , date_paid='".date('Y-m-d H:i:s')."' ";
		}
		
		//adodb_pr($cek);
		if($cek->transaction_status == 'capture' ){
			$data=$db->query("SELECT package_id,name,settings FROM packages WHERE package_id =".$r['package_id']);
			$xx=$data->fetch_object();
			//adodb_pr($xx);
			if($r['plan'] == 'monthly'){
				$package_expiration_date= (new \DateTime())->modify('+30 days')->format('Y-m-d H:i:s');
			}
			if($r['plan'] == 'annual'){
				$package_expiration_date=(new \DateTime())->modify('+12 months')->format('Y-m-d H:i:s');
			}
			$db->query("update users set package_id='".$xx->name."',package_settings=".json_encode($xx->settings)." ,package_expiration_date='".$package_expiration_date."' where user_id=".$r['user_id']);
			
			$addQuery.=" , date_paid='".date('Y-m-d H:i:s')."' ";
		}
		
		
		
		
		$db->query('update payments set status=\''.$cek->transaction_status.'\' '.$addQuery.' where id=\''.$cek->order_id.'\' ');
		
		
	}
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


function adodb_pr($data=array()){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}