<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;
use Altum\Models\Domain;
use Altum\Title;

class Link extends Controller {
    public $link;

    public function index() {

        Authentication::guard();

        $link_id = isset($this->params[0]) ? (int) $this->params[0] : false;
        $method = isset($this->params[1]) && in_array($this->params[1], ['settings', 'statistics']) ? $this->params[1] : 'settings';

        /* Make sure the link exists and is accessible to the user */
        if(!$this->link = Database::get('*', 'links', ['link_id' => $link_id, 'user_id' => $this->user->user_id])) {
            redirect('dashboard');
        }

        $this->link->settings = json_decode($this->link->settings);

        /* Get the current domain if needed */
        $this->link->domain = $this->link->domain_id ? (new Domain())->get_domain($this->link->domain_id) : null;

        /* Determine the actual full url */
        $this->link->full_url = $this->link->domain ? $this->link->domain->url . $this->link->url : url($this->link->url);

        /* Handle code for different parts of the page */
        switch($method) {
            case 'settings':

                if($this->link->type == 'biolink') {
                    /* Get the links available for the biolink */
                    $link_links_result = $this->database->query("SELECT * FROM `links` WHERE `biolink_id` = {$this->link->link_id} ORDER BY `order` ASC");

                    $biolink_link_types = require APP_PATH . 'includes/biolink_link_types.php';

                    /* Add the modals for creating the links inside the biolink */
                    foreach($biolink_link_types as $key) {
                        $data = ['link' => $this->link];
                        $view = new \Altum\Views\View('link/settings/create_' . $key . '_modal.settings.biolink.method', (array) $this);
                        \Altum\Event::add_content($view->run($data), 'modals');
                    }
					//create_whatsapp_form_modal.settings.biolink.method.php
					$data = ['link' => $this->link];
                        $view = new \Altum\Views\View('link/settings/create_whatsapp_form_modal.settings.biolink.method', (array) $this);
                        \Altum\Event::add_content($view->run($data), 'modals');	
                    if($this->link->subtype != 'base') {
                        redirect('link/' . $this->link->biolink_id);
                    }
                }

                /* Get the available domains to use */
                $domains = (new Domain())->get_domains($this->user->user_id);

                /* Prepare variables for the view */
                $data = [
                    'link'              => $this->link,
                    'method'            => $method,
                    'link_links_result' => $link_links_result ?? null,
                    'domains'           => $domains
                ];

                break;


            case 'statistics':

                 $start_date = isset($this->params[2]) ? Database::clean_string($this->params[2]) : false;
                $end_date = isset($this->params[3]) ? Database::clean_string($this->params[3]) : false;

                /* new set date */
                $dateparam = isset($this->params[2]) ? Database::clean_string($this->params[2]) :  date('m-Y');
                $date = explode('-',$dateparam);
                $month=$date[0];
                $year=$date[1];





                $date = \Altum\Date::get_start_end_dates($start_date, $end_date);

                /* Get data needed for statistics from the database */
                $logs = [];
                $logs_chart = [];
                $logs_data = [
                    'location'      => [],
                    'os'            => [],
                    'browser'       => [],
                    'referer'       => []
                ];
      
                $logs_result = Database::$database->query("
                    SELECT
                         `location`,
                         `os`,
                         `browser`,
                         `referer`,
                         `count`,
                         DATE_FORMAT(`date`, '%Y-%m-%d') AS `formatted_date`
                    FROM
                         `track_links`
                    WHERE
                        `link_id` = {$this->link->link_id}
                        AND  ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )
                    ORDER BY
                        `formatted_date`
                ");

                /* Generate the raw chart data and save logs for later usage */
                while($row = $logs_result->fetch_object()) {
                    $logs[] = $row;

                    /* Handle if the date key is not already set */
                    if(!array_key_exists($row->formatted_date, $logs_chart)) {
                        $logs_chart[$row->formatted_date] = [
                            'impression'        => 0,
                            'unique'            => 0,
                        ];
                    }

                    /* Distribute the data from the database row */
                    $logs_chart[$row->formatted_date]['unique']++;
                    $logs_chart[$row->formatted_date]['impression'] += $row->count;

                    if(!array_key_exists($row->location, $logs_data['location'])) {
                        $logs_data['location'][$row->location ?? 'false'] = 1;
                    } else {
                        $logs_data['location'][$row->location]++;
                    }

                    if(!array_key_exists($row->os, $logs_data['os'])) {
                        $logs_data['os'][$row->os ?? 'N/A'] = 1;
                    } else {
                        $logs_data['os'][$row->os]++;
                    }

                    if(!array_key_exists($row->browser, $logs_data['browser'])) {
                        $logs_data['browser'][$row->browser ?? 'N/A'] = 1;
                    } else {
                        $logs_data['browser'][$row->browser]++;
                    }

                    if(!array_key_exists($row->referer, $logs_data['referer'])) {
                        $logs_data['referer'][$row->referer ?? 'false'] = 1;
                    } else {
                        $logs_data['referer'][$row->referer]++;
                    }
                }

                $logs_chart = get_chart_data($logs_chart);

                arsort($logs_data['referer']);
                arsort($logs_data['browser']);
                arsort($logs_data['os']);
                arsort($logs_data['location']);

                /* $browser=$this->get_maps($this->link->link_id,$year, $month);
                echo '<pre>';
                print_r($browser);
                exit(); */
                /* Prepare variables for the view */
                $data = [
                    'link'              => $this->link,
                    'method'            => $method,
                    'date'              => $dateparam,
                    'logs'              => $logs,
                    'logs_chart'        => $logs_chart,
                    'logs_data'         => $logs_data,
                    'referal'           => $this->getGroubReveral($this->link->link_id,$year, $month),
                    'os'                => $this->get_visitor_os($this->link->link_id,$year, $month),
                    'browser'           => $this->reveral_browser($this->link->link_id,$year, $month),
                    'maps'              => $this->get_maps($this->link->link_id,$year, $month)
                ];

                break;
        }

        /* Prepare the method View */
        $view = new \Altum\Views\View('link/' . $method . '.method', (array) $this);
        $this->add_view_content('method', $view->run($data));

        /* Prepare the View */
        $data = [
            'link'      => $this->link,
            'method'    => $method
        ];

        $view = new \Altum\Views\View('link/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

        /* Set a custom title */
        Title::set(sprintf($this->language->link->title, $this->link->url));

    }

    private function getGroubReveral($link_id,$year,$month){
        $data=$this->database->query("SELECT
                                                `referer`
                                        FROM
                                                `track_links`
                                        WHERE
                                            `link_id` = {$link_id}
                                            AND  ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )
                                            GROUP BY
                                            `referer` ORDER BY `referer` ASC");
        $REFERAL=$data->fetch_all(MYSQLI_ASSOC);
        $arrayReveral=array();
        foreach($REFERAL as $r){
            $arrayReveral[]=!empty($r['referer'])?$this->get_base_domain($r['referer']):'';
        }

        $globalCount=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )")->fetch_object()->total;

        $data=array_unique($arrayReveral);
        $resultReferal=array();
        $backgroundColor=array();
        $labelData=array();
        $label=array();
        $i=0;
        foreach($data as $key => $val){
            $backgroundColor[]=$this->color_reveral($i);

            if(!empty($val)){
                $count=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND   ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} ) and referer  LIKE '%{$val}%' ")->fetch_object()->total;
            }else{
                $count=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND   ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} ) and referer IS NULL ")->fetch_object()->total;
            }
            $label[]=!empty($val)?$val:'other';
            $resultReferal[]=(int)$count;
            $labelData[!empty($val)?$val:'other']=[
                                'count' => $count,
                                'persen' => round(($count /$globalCount) * 100,2),
                                'color' => $this->color_reveral($i)
                            ];
            $i++;
        }

       return [
                'backgroundColor' => json_encode($backgroundColor),
                'labels' => json_encode($label),
                'data'  => json_encode($resultReferal),
                'raw'   =>  $labelData,
                'count' =>  $globalCount
       ];

    }


    private function get_visitor_os($link_id,$year,$month){
        $globalCount=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )")->fetch_object()->total;
        $visitoOS=$this->database->query("SELECT
                                        `os`
                                FROM
                                        `track_links`
                                WHERE
                                    `link_id` = {$link_id}
                                    AND  ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )
                                    GROUP BY
                                    `os` ORDER BY `os` ASC")->fetch_all(MYSQLI_ASSOC);
        $arrayOS=array();
        $i=0;
        $backgroundColor=array();
        $labelData=array();
        $label=array();
        $icon=array();
        $resultReferal=array();
        foreach($visitoOS as $r){
            $backgroundColor[]=$this->color_reveral($i);
            $label[]=$r['os'];
            $count=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND   ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} ) and os = '{$r['os']}' ")->fetch_object()->total;
            $resultReferal[]=(int) $count;
            //$arrayOS[$r['os']]=
            $labelData[$r['os']]=[
                'count' => $count,
                'persen' => round(($count /$globalCount) * 100,2),
                'color' => $this->color_reveral($i),
                'icon' => $this->os_icon($r['os'])
            ];

            $i++;
        }
        return [
                'backgroundColor' => json_encode($backgroundColor),
                'labels' => json_encode($label),
                'data'  => json_encode($resultReferal),
                'raw'   =>  $labelData,
                'count' =>  $globalCount 
            ];
    }


    private function reveral_browser($link_id,$year,$month){
        $globalCount=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND  ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )")->fetch_object()->total;
        $visitoBorwser=$this->database->query("SELECT
                                                    `browser`
                                            FROM
                                                    `track_links`
                                            WHERE
                                                `link_id` = {$link_id}
                                                AND ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )
                                                GROUP BY
                                                `browser` ORDER BY `browser` ASC")->fetch_all(MYSQLI_ASSOC);
        

        $i=0;
        $backgroundColor=array();
        $labelData=array();
        $label=array();
        $icon=array();
        $resultReferal=array();
        foreach($visitoBorwser as $r){
            $backgroundColor[]=$this->color_reveral($i);
            $label[]=$r['browser'];
            $count=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND   ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} ) and browser = '{$r['browser']}' ")->fetch_object()->total;
            $resultReferal[]=(int) $count;
            //$arrayOS[$r['os']]=
            $labelData[$r['browser']]=[
                'count' => $count,
                'persen' => round(($count /$globalCount) * 100,2),
                'color' => $this->color_reveral($i)
            ];

            $i++;
        }
        return [
                'backgroundColor' => json_encode($backgroundColor),
                'labels' => json_encode($label),
                'data'  => json_encode($resultReferal),
                'raw'   =>  $labelData,
                'count' =>  $globalCount
            ];
    }



    private function get_maps($link_id,$year,$month){
        $globalCount=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )")->fetch_object()->total;
        $visitoMaps=$this->database->query("SELECT
                                                    `location`
                                            FROM
                                                    `track_links`
                                            WHERE
                                                `link_id` = {$link_id}
                                                AND ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )
                                                GROUP BY
                                                `location` ORDER BY `location` ASC")->fetch_all(MYSQLI_ASSOC);
        $dataJson=array();
        $dataJson[]=['Country','Visit'];
        $raw=array();
        foreach($visitoMaps as $r){
            $count=$this->database->query("SELECT count(id) as total FROM `track_links` WHERE `link_id` = {$link_id} AND    ( YEAR(`date`) = {$year} AND MONTH(`date`) = {$month} )and location = '{$r['location']}' ")->fetch_object()->total;
            $dataJson[]=[$r['location'],(int) $count];

            $raw[$r['location']]=[
                'name'  => get_country_from_country_code($r['location']),
                'count' => (int) $count
            ];
        }
        return [
            'json' => json_encode($dataJson),
            'data' => $raw
        ];
    }



    private function get_base_domain($url){
        $info = parse_url($url);
        $host = $info['host'];
        $host_names = explode(".", $host);
        return $bottom_host_name = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];
    }

    private function color_reveral($key){
        $color= ["#12bf24", "#3461ff", "#ff6632","#e72e7a","#e72e2e","#8932ff","#6f42c1","#d63384","#20c997","#0dcaf0","#fd7e14","#ffc107","#6610f2"];
        return $color[$key];
    }


    private function os_icon($opt){
        $os=[
            'Android'   => 'fab fa-android',
            'iOS'       => 'fab fa-apple',
            'Linux'     => 'fab fa-linux',
            'OS X'      => 'far fa-desktop',
            'unknown'   => 'fas fa-question',
            'Windows'   => 'fab fa-windows'
        ];
       //print_r($os[$opt]);
        return $os[$opt];
    }


    private function icon_browser(){
        $browser=[
            'BlackBerry' => 'fab fa-blackberry',
            'Chrome'     => 'fab fa-chrome',
            'Edge'       => 'fab fa-edge',
            'Firefox'    => 'fab fa-firefox',
            'Google Search Appliance' => 'fab fa-google',
            'Internet Explorer' => 'fab fa-internet-explorer',
            'Mozilla' => 'fab fa-firefox-browser',
            'Navigator' => 'fas fa-browser',
            'Nokia S60 OSS Browser'
        ];
    }


}
