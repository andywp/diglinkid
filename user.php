<?php exit();
/* @date_default_timezone_set('Asia/Jakarta');
include 'app/config/config.php';
$db = new mysqli(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD,DATABASE_NAME);
// cek koneksi
if($db->connect_error){
  die("Connection failed: " . $db->connect_error);
}
$users=$db->query("SELECT email FROM users")->fetch_all(MYSQLI_ASSOC);
/* print_r($users); */

/* $html='';
foreach($users as $r){
	$html.='
				<tr>
					<td>'.$r['email'].'</td>
				</tr>
			';
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Email.xls");
echo '<table border="1">
		<thead>
			<tr>
				<td>Email</td>
			</tr>
		</thead>
		<tbody>
			'.$html.'
			
		</tbody>
	</table>';  */