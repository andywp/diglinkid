<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Middlewares\Authentication;
use Altum\Models\Package;
use Altum\Routing\Router;
use Altum\Models\Domain;
use Illuminate\Database\Capsule\Manager as DB;

class Dashboard extends Controller {

    public function index() {

        Authentication::guard();

        /* Create Modal */
        $view = new \Altum\Views\View('dashboard/create_project_modal', (array) $this);
        \Altum\Event::add_content($view->run(), 'modals');

        /* Get the campaigns list for the user */
        //$projects_result = Database::$database->query("SELECT * FROM `projects` WHERE `user_id` = {$this->user->user_id}");

        /* Some statistics for the widgets */
        //$links_total = Database::$database->query("SELECT COUNT(*) AS `total` FROM `links` WHERE `user_id` = {$this->user->user_id}")->fetch_object()->total;

        /* Get statistics based on the total clicks */
       // $links_clicks_total = Database::$database->query("SELECT SUM(`clicks`) AS `total` FROM `links` WHERE `user_id` = {$this->user->user_id}")->fetch_object()->total;

        /* Create Link Modal */
        $domains = (new Domain())->get_domains($this->user->user_id);

        $data = [
            'project' => 0,
            'domains' => $domains
        ];

        $view = new \Altum\Views\View('dashboard/create_link_modals', (array) $this);

        \Altum\Event::add_content($view->run($data), 'modals');



        $links_result = Database::$database->query("
                SELECT 
                    `links`.`*`, `domains`.`scheme`, `domains`.`host`
                FROM 
                    `links`
                LEFT JOIN 
                    `domains` ON `links`.`domain_id` = `domains`.`domain_id`
                WHERE 
                    `links`.`user_id` = {$this->user->user_id} AND 
                    (`links`.`subtype` = 'base' OR `links`.`subtype` = '')
                ORDER BY
                    `links`.`type`
            ");

        //$rowLink = $links_result->fetch_all(MYSQLI_ASSOC);
        $rowLink=array();

        /* //get link by user */

       $total=DB::table('links')->where('user_id',$this->user->user_id)
                                    ->where(function($query){
                                        $query->orWhere('subtype','base');
                                        $query->orWhere('subtype','');
                                    })->count();                        



        /* Prepare the View */
        $data = [
            //'projects_result'       => $projects_result,
            //'links_total'           => $links_total,
            //'links_clicks_total'    => $links_clicks_total,
            //'data'                  => $rowLink,
            'total'                 => $total
        ];

        $view = new \Altum\Views\View('dashboard/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function getlink(){
        header('Content-Type: application/json; charset=utf-8');
        Authentication::guard();
        $current = intval($_POST['current'] -1);

        $length =intval($_POST['length']);
        $length=($current > 1)?($current * $length) - $current:0;
       // $nextlength=12 * $_GET['current'];

       

       $batas = 12;
       $halaman = isset($_POST['current'])?(int)$_POST['current'] : 1;
       $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;


        $getTotal=DB::table('links')->where('user_id',$this->user->user_id)
                                    ->where(function($query){
                                        $query->orWhere('subtype','base');
                                        $query->orWhere('subtype','');
                                    }); 
        if(isset($_POST['key']) && !empty($_POST['key'])){
            $getTotal->where('links.location_url','like',"%{$_POST['key']}%");
        }
        $total=$getTotal->count();

        $getData=DB::table('links')->leftJoin('domains','links.domain_id','=','domains.domain_id')
                                ->where('links.user_id',$this->user->user_id)
                                ->where(function($query){
                                    $query->orWhere('links.subtype','base');
                                    $query->orWhere('links.subtype','');
                                })
                                ->select('links.*','domains.scheme','domains.host');
        if(isset($_POST['key']) && !empty($_POST['key'])){
            $getData->where('links.location_url','like',"%{$_POST['key']}%");
        }                       
        $data=$getData->limit($batas)->offset($halaman_awal)->orderBy('links.link_id','DESC')->get();
        $return=[
            'total'  => $total,
            'length' => $_POST['length'],
            'data'  => $data
        ];

        exit(json_encode($return));
    }



}
