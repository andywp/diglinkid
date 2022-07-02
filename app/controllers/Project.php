<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;
use Altum\Models\Domain;
use Altum\Title;
use QRcode;
class Project extends Controller {

    public function index() {

        Authentication::guard();

        /* Create Modal */
        $view = new \Altum\Views\View('project/create_project_modal', (array) $this);
        \Altum\Event::add_content($view->run(), 'modals');


        $project_id = isset($this->params[0]) ? (int) $this->params[0] : false;

        /* Make sure the project exists and is accessible to the user */
        if(!$project = Database::get('*', 'projects', ['project_id' => $project_id, 'user_id' => $this->user->user_id])) {

            /* Get the campaigns list for the user */
            $projects_result = Database::$database->query("SELECT * FROM `projects` WHERE `user_id` = {$this->user->user_id}");

            /* Some statistics for the widgets */
            $links_total = Database::$database->query("SELECT COUNT(*) AS `total` FROM `links` WHERE `user_id` = {$this->user->user_id}")->fetch_object()->total;

            /* Get statistics based on the total clicks */
            $links_clicks_total = Database::$database->query("SELECT SUM(`clicks`) AS `total` FROM `links` WHERE `user_id` = {$this->user->user_id}")->fetch_object()->total;

            /* Prepare the View */
            $data = [
                'projects_result'       => $projects_result,
                'links_total'           => $links_total,
                'links_clicks_total'    => $links_clicks_total
            ];

            $view = new \Altum\Views\View('project/allproject', (array) $this);

            $this->add_view_content('content', $view->run($data));

            Title::set(sprintf($this->language->project->title, $project->name));
            
        } else {

            /* Get the links list for the project */
            $links_result = Database::$database->query("
                SELECT 
                    `links`.*, `domains`.`scheme`, `domains`.`host`
                FROM 
                    `links`
                LEFT JOIN 
                    `domains` ON `links`.`domain_id` = `domains`.`domain_id`
                WHERE 
                    `links`.`project_id` = {$project->project_id} AND 
                    `links`.`user_id` = {$this->user->user_id} AND 
                    (`links`.`subtype` = 'base' OR `links`.`subtype` = '')
                ORDER BY
                    `links`.`type`
            ");

            /* Iterate over the links */
            $links_logs = [];

            while($row = $links_result->fetch_object()) {
                $row->full_url = $row->domain_id ? $row->scheme . $row->host . '/' . $row->url : url($row->url);

                $links_logs[] = $row;
            }

            /* Get statistics */
            if(count($links_logs)) {
                $logs_chart = [];
                $start_date_query = (new \DateTime())->modify('-30 day')->format('Y-m-d H:i:s');
                $end_date_query = (new \DateTime())->modify('+1 day')->format('Y-m-d H:i:s');
                $project_ids = implode(', ', array_unique(array_map(function($row) {
                    return (int) $row->link_id;
                }, $links_logs)));

                $logs_result = Database::$database->query("
                    SELECT
                        `count`,
                        DATE_FORMAT(`date`, '%Y-%m-%d') AS `formatted_date`
                    FROM
                        `track_links`
                    WHERE
                        `link_id` IN ({$project_ids})
                        AND (`date` BETWEEN '{$start_date_query}' AND '{$end_date_query}')
                    ORDER BY
                        `formatted_date`
                ");

                /* Generate the raw chart data and save logs for later usage */
                while($row = $logs_result->fetch_object()) {
                    $logs[] = $row;

                    /* Handle if the date key is not already set */
                    if (!array_key_exists($row->formatted_date, $logs_chart)) {
                        $logs_chart[$row->formatted_date] = [
                            'impression' => 0,
                            'unique' => 0,
                        ];
                    }

                    /* Distribute the data from the database row */
                    $logs_chart[$row->formatted_date]['unique']++;
                    $logs_chart[$row->formatted_date]['impression'] += $row->count;
                }

                $logs_chart = get_chart_data($logs_chart);
            }

            /* Create Link Modal */
            $domains = (new Domain())->get_domains($this->user->user_id);

            $data = [
                'project' => $project,
                'domains' => $domains
            ];

            $view = new \Altum\Views\View('project/create_link_modals', (array) $this);

            \Altum\Event::add_content($view->run($data), 'modals');

            /* Prepare the View */
            $data = [
                'project'        => $project,
                'links_logs'     => $links_logs,
                'logs_chart'     => $logs_chart ?? false
            ];

            $view = new \Altum\Views\View('project/index', (array) $this);

            $this->add_view_content('content', $view->run($data));
            
            $view = new \Altum\Views\View('project/qrcode_modal', (array) $this);
            \Altum\Event::add_content($view->run($data), 'modals');

            $view = new \Altum\Views\View('project/link_modal', (array) $this);
            \Altum\Event::add_content($view->run($data), 'modals');

            /* Set a custom title */
            Title::set(sprintf($this->language->project->title, $project->name));
        }

    }
	
	public function ajaxqrcode(){
		Authentication::guard();
		$error=false;
		$alert='';
		$url='';
		QRcode::png(SITE_URL.$_POST['url'], UPLOADS_URL_PATH.'qrcode/'.$_POST['url'].'.png','H',10,2);
		
		$url=SITE_URL.'uploads/qrcode/'.$_POST['url'].'.png';
		
		$respone=[
					'error' => $error,
					'alert' => $alert,
					'url'   => $url
				];
		echo json_encode($respone);
		exit();
	}

    public function ajaxLink() {

        Authentication::guard();

        if(isset($_POST['id'])) {
            $link_id = $_POST['id'];
            /* Make sure the link exists and is accessible to the user */
            if(!$this->link = Database::get('*', 'links', ['link_id' => $link_id, 'user_id' => $this->user->user_id])) {
                $respone=[
                    'error' => true,
                ];
                echo json_encode($respone);
                exit();
            }

            $this->link->settings = json_decode($this->link->settings);

            /* Get the current domain if needed */
            $this->link->domain = $this->link->domain_id ? (new Domain())->get_domain($this->link->domain_id) : null;

            /* Determine the actual full url */
            $this->link->full_url = $this->link->domain ? $this->link->domain->url . $this->link->url : url($this->link->url);

            /* Handle code for different parts of the page */
            if($this->link->type == 'biolink') {
                $respone=[
                    'error' => false,
                    'biolink' => true,
                    'link_id' => $link_id
                ];
                echo json_encode($respone);
                exit();
            } else {
                /* Get the available domains to use */
                // $domains = (new Domain())->get_domains($this->user->user_id);

                // /* Prepare variables for the view */
                // $data = [
                //     'link'              => $this->link,
                //     'method'            => $method,
                //     'link_links_result' => $link_links_result ?? null,
                //     'domains'           => $domains
                // ];

                $respone=[
                    'error' => false,
                    'biolink' => false,
                    'link_id' => $link_id
                ];
                echo json_encode($respone);
                exit();
            }
        } else {
            $respone=[
                'error' => true,
            ];
            echo json_encode($respone);
            exit();
        }

    }

}
