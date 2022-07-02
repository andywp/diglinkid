<?php defined('ALTUMCODE') || die() ?>
<?php
 $link=json_decode($data->settings);

$from='<p class="mb-4 text-center text-bold" >'.$data->keterangan .'</p><hr>';
foreach($link as $r){
	$required=(@$r->required == 1)?'required="required"':'';
	$mandatori=(@$r->required == 1)?'*)':'';
	if($r->type == 'Input'){
		
		$from.='<div class="form-group">
				<label>'.$r->label.' '.$mandatori.'</label>
				<input type="text" class="form-control" name="'.$r->label.'" value="'.$r->value.'" '.$required.'>
			</div>';
		
	}elseif($r->type == 'Select'){
		$optionData=explode(',',$r->value);
		
		$option='';
		foreach($optionData as $k=>$v){
			$option.='<option value="'.$v.'">'.$v.'</option>';
		}
		
		
		$from.='<div class="form-group">
					<label>'.$r->label.' '.$mandatori.'</label>
					<select class="form-control" '.$required.' name="'.$r->label.'">
						<option value="">Pilih</option>
						'.$option.'
					</select>
				</div>';
		
	}else{
		
		$from.='<div class="form-group">
				<label>'.$r->label.' '.$mandatori.'</label>
				<textarea type="text" class="form-control" name="'.$r->label.'" '.$required.'></textarea>
			</div>';
		
	}
	
	
}


$from.='<input type="hidden" name="wa" value="'.$data->location_url.'"> ';


?>




<div class="container pt-5">
	<div class="d-flex justify-content-between">
		<h1 class="h3 text-center"><?= $data->url ?></h1>
	</div>
	<?php display_notifications() ?>
	<div class="notification-container msg-alert"></div>
	<form method="POST" action="" id="formwhatsapp" >
		<?= $from ?>
		
		<button type="submit" class="btn btn-primary text-center">Kirim</button>
	</form>
</div>



<?php ob_start() ?>

<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>


