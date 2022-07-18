<?php
namespace Altum\Controllers;
use Altum\Database\Database;
use Altum\Middlewares\Csrf;
use Altum\Middlewares\Authentication;
use Altum\Response;
use Illuminate\Database\Capsule\Manager as DB;
use Carbon\Carbon;
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

	public function datatable(){
		Authentication::guard('admin');
		$datatable = new \Altum\DataTable();
		$datatable->set_accepted_columns(['id', 'name', 'subject', 'department', 'priority', 'status','last_replay']);
		$datatable->process($_POST);

		$result = Database::$database->query("
								SELECT 
									`id`, `name`, `subject`, `department`, `priority`, `status`, `last_replay`,`open`,
									(SELECT COUNT(*) FROM `ticket`) AS `total_before_filter`,
									(SELECT COUNT(*) FROM `ticket` WHERE `subject`  LIKE '%{$datatable->get_search()}%' OR `name`  LIKE '%{$datatable->get_search()}%' OR `name`  LIKE '%{$datatable->get_search()}%' OR `email`  LIKE '%{$datatable->get_search()}%' ) AS `total_after_filter`
								FROM
									`ticket`
								WHERE
									`subject`  LIKE '%{$datatable->get_search()}%' 
									OR
									`name`  LIKE '%{$datatable->get_search()}%'
									OR
									`email`  LIKE '%{$datatable->get_search()}%'
								ORDER BY
									`last_replay` ASC,
									" . $datatable->get_order() . "
								LIMIT
									{$datatable->get_start()}, {$datatable->get_length()}

						");
		$total_before_filter = 0;
		$total_after_filter = 0;
		$data = [];
		//print_r($result->fetch_object());
		while($row = $result->fetch_object()):
			$is_open=($row->open)?'is_open':'';
			$row->subject="<a href=\"".url('admin/ticket/view/'.$row->id)."\"><span id=\"title-{$row->id}\" class=\"tiket-title {$is_open}\"> #".$row->id." | ".$row->subject." | ".$row->name.'</a>';
			$data[] = $row;
            $total_before_filter = $row->total_before_filter;
            $total_after_filter = $row->total_after_filter;
		endwhile;
		Response::simple_json([
            'data' => $data,
            'draw' => $datatable->get_draw(),
            'recordsTotal' => $total_before_filter,
            'recordsFiltered' =>  $total_after_filter
        ]);
	}


	public function view(){
		Authentication::guard();
		$this->t_id =  isset($this->params[0]) ? $this->params[0] : false;
		$view = new \Altum\Views\View('admin/ticket/view-ticket', (array) $this);

		$tiket=DB::table('ticket')->where('id',$this->t_id)->first();
		$service=DB::table('users')->select('package_id','package_expiration_date','date')->where('user_id',$tiket->user_id)->first();

		$replay=DB::table('ticket_reply')->where('ticket_id',$this->t_id )->orderBy('replay_id')->get();
		//dd($replay);


		$data = [
			'user'    	=> $this->user,
			'tiket'		=> $tiket,
			'service'	=> $service,
			'replay'	=> $replay
	  	];
		$this->add_view_content('content', $view->run($data));
		
		
	}

	public function replay(){
		$error=true;
		$alert='';
		$id=0;
		//print_r($this->user);
		Authentication::guard();
		if(!Csrf::check()){
			$alert='invalid token. please relaod';
		}elseif($_POST['message'] ==''){
			$alert='TIket message is required';
		}else{
			$ticket_id = (int) $_POST['tid'];
			$user_id = $this->user->user_id;
			$user_name = $this->user->name;
			$type = 'admin';
			$replay_message = $_POST['message'];
			$date_create = Carbon::now();

			DB::table('ticket_reply')->insert([
				'ticket_id' => $ticket_id,
				'user_id' 	=> $user_id,
				'user_name' => $user_name,
				'type'		=> $type,
				'replay_message' => $replay_message,
				'date_create' => $date_create
			]);

			DB::table('ticket')->where('id',$ticket_id)->update(['last_replay' => $date_create, 'status' => 'Answered', 'open' => 0 ]);
			$error=false;
			$alert='Success replay ticket';
			$id=$ticket_id;
		}

		$return=[
			'error' => $error,
			'alert' => $alert,
			'id'	=> $id
		];
		echo json_encode($return);
		exit();
	}


	private function status_ticket($status){
		$bg=[
			'Open' => 'info',
			'Answered' => 'primary',
			'Customer-Replay' => 'warning',
			'Closed'	=> 'dark'
		];

		return $bg[$status];
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