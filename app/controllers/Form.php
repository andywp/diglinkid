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


class Form extends Controller { 

	public function index() {
		$id = (isset($this->params[0])) ? $this->params[0] : false;
		$id=base64_decode($id);
		$data=$this->database->query("SELECT * FROM links where link_id='".$id."'");
		$link=$data->fetch_object();
		/* print_r($link);
		exit(); */
		
		$view = new \Altum\Views\View('form/index', (array) $this);
		$data = $link;
        $this->add_view_content('content', $view->run($data));
	}



}