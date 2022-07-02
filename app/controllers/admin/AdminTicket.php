<?php
namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\Middlewares\Csrf;
use Altum\Middlewares\Authentication;
class AdminTicket extends Controller {
	public function index() {
       Authentication::guard('admin');
		$data = Database::$database->query("SELECT * FROM `subscribe` ORDER BY `id` DESC");
		//print_r($data);exit();
        /* Main View */
        $data = [
            'data' => $data
        ];
	   
        /* Main View */
        $view = new \Altum\Views\View('admin/ticket/index', (array) $this);
        $this->add_view_content('content', $view->run($data));

    }
	
	public function download(){
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_ticket_".date("Y-m-d").".xls");
		$data = Database::$database->query("SELECT * FROM `ticket` ORDER BY `id` ASC");
		$hal=$data->fetch_all(MYSQLI_ASSOC);
		$html='';
		$no=1;
		foreach($hal as $r){
			$html.='
					<tr>
						<td>'.$no.'</td>
						<td>'.$r['name'].'</td>
						<td>\''.$r['whatsapp_number'].'\'</td>
						<td>'.$r['subject'].'</td>
						<td>'.$r['department'].'</td>
						<td>'.$r['priority'].'</td>
						<td>'.$r['message'].'</td>
						<td>'.$r['date_create'].'</td>
					</tr>
				';
			$no++;
		}
		
		
		
		$table='<table border="1" width="100%" >
					<thead>
						<tr>
							<th>No</th>
							<th>name</th>
							<th>Whatsapp number</th>
							<th>Subject</th>
							<th>Department</th>
							<th>Priority</th>
							<th>Message</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						'.$html.'
					</tbody?
				</table>';
		
		
		echo $table;
		
		exit();
	}
	
	
	
	
}