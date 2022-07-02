<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;

class AdminStatistics extends Controller {

    public function index() {
		ini_set('memory_limit', '1024M');
		ini_set('max_execution_time', '9000');
		/* ini_set('display_errors', '1');
		ini_set('upload_max_filesize', '1M');
		error_reporting(1); */
		/* phpinfo();exit(); */
        Authentication::guard('admin');

        $start_date = isset($this->params[0]) ? Database::clean_string($this->params[0]) : (new \DateTime())->modify('-30 day')->format('Y-m-d');
        $end_date = isset($this->params[1]) ? Database::clean_string($this->params[1]) : (new \DateTime())->format('Y-m-d');

        $date = \Altum\Date::get_start_end_dates($start_date, $end_date);

        /* Main View */
        $data = ['date' => $date];
		
        $view = new \Altum\Views\View('admin/statistics/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
