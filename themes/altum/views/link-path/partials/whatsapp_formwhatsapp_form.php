<?php defined('ALTUMCODE') || die() ?>
<?php ob_start() ?>


<?php
$data=json_decode($link->settings);


$from='';
//$from='<p class="mb-4 text-center text-bold" >'. preg_replace("/\r\n|\r|\n/", '<br/>', $link->keterangan).'</p><hr>';
foreach($data as $r){
	$required=(@$r->required == 1)?'required="required"':'';
	$mandatori=(@$r->required == 1)?'*)':'';
	
	$name=str_replace(':','',trim($r->label));
	$name=str_replace('&','dan',trim($name));
	
	if($r->type == 'Input'){
		
		$from.='<div class="form-group">
				<label>'.$r->label.' '.$mandatori.'</label>
				<input type="text" class="form-control" name="'.$name.'" value="'.$r->value.'" '.$required.'>
				<small class="form-text text-muted" >'.@$r->ket.'</small>
			</div>';
		
	}elseif($r->type == 'Select'){
		$optionData=explode(',',$r->value);
		
		$option='';
		foreach($optionData as $k=>$v){
			$option.='<option value="'.$v.'">'.$v.'</option>';
		}
		
		
		$from.='<div class="form-group">
					<label>'.$r->label.' '.$mandatori.'</label>
					<select class="form-control" '.$required.' name="'.$name.'">
						<option value="">Pilih</option>
						'.$option.'
					</select>
					<small class="form-text text-muted" >'.@$r->ket.'</small>
				</div>';
		
	}else{
		
		$from.='<div class="form-group">
				<label>'.$r->label.' '.$mandatori.'</label>
				<textarea type="text" class="form-control" name="'.$name.'" '.$required.'></textarea>
				<small class="form-text text-muted" >'.@$r->ket.'</small>
			</div>';
		
	}
	
	
}


$from.='<input type="hidden" name="wa" value="'.$link->location_url.'"> ';


$keterangan=htmlspecialchars_decode(html_entity_decode(preg_replace("/\r\n|\r|\n/", '<br/>', $link->keterangan)));
$keterangan=str_replace('"',"''",$keterangan);
?>


<div class="my-3">
    <a 
	href="#"  
	class="btn btn-block btn-primary link-btn formwhatsapp" 
	
	
	data-id="<?= $link->link_id ?>"
	data-title="<?= $link->url ?>"
	data-phone="<?= $link->location_url ?>"
	data-param='<?= htmlspecialchars_decode(html_entity_decode($from)) ?>'
	data-ket="<?= $keterangan  ?>"
	
	style="background: <?= !empty($link->bg_color)?$link->bg_color:'#fff'; ?>; color: <?= !empty($link->text_color)?$link->text_color:'#38b2ac'; ?>; border-radius: 50px;"
	>
        <?= $link->url ?>
    </a>

	
</div>



<?php $html = ob_get_clean(); ?>
<?php return (object) ['html' => $html] ?>
