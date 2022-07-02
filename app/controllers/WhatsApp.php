<?php

namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\db\db;
use Altum\Date;
/* use Altum\Middlewares\Authentication; */
use Altum\Middlewares\Csrf;
use Altum\Models\Package;
use Altum\Models\User;
use Exception;


class WhatsApp extends Controller { 

	public function index() {
		$kode = (isset($this->params[0])) ? $this->params[0] : false;
		$wa = Database::get('*', 'wa', ['url' => $kode]);
		if($wa){
			$txt=str_replace('\r\n','%0A ',$wa->pesan);
			 $url='https://api.whatsapp.com/send?phone='.$wa->phone.'&text='.htmlspecialchars($txt);
			
		}else{
			$url=SITE_URL;
		}
		//redirect($url);
		header("Location:".$url);
		exit();
	}



}