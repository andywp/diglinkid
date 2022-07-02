<?php

namespace Altum\Controllers;

use Altum\Middlewares\Authentication;
use Altum\Database\Database;

class Index extends Controller {

    public function index() {
		
        /* Custom index redirect if set */
        /* if(!empty($this->settings->index_url)) {
            header('Location: ' . $this->settings->index_url);
            die();
        } */

        /* Check if the current link accessed is actually the original url or not ( multi domain use ) */
        $original_url_host = parse_url(url())['host'];
        $request_url_host = Database::clean_string($_SERVER['HTTP_HOST']);

        if($original_url_host != $request_url_host) {
            die('Ready to use as a custom domain.');
        }

        if($_SESSION['user_id'] != '' || $_SESSION['user_id'] != null) {
            redirect('dashboard');
        } else {
            /* Main View */
            $data = [];

            $view = new \Altum\Views\View('index/index', (array) $this);

            $this->add_view_content('content', $view->run($data));
        }

    }

}
