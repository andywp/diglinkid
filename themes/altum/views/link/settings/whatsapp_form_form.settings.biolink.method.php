 <?php defined('ALTUMCODE') || die() ?>
<style>
	button.btn.btn-danger.btn-hapus {
		position: absolute;
		right: 0;
		top: 0;
	}
	.card-body.card-formdinamis {
		position: relative;
	}
</style>

 <form name="update_biolink_" method="post" role="form">
    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
    <input type="hidden" name="request_type" value="update" />
    <input type="hidden" name="type" value="biolink" />
    <input type="hidden" name="subtype" value="whatsapp_form" />
    <input type="hidden" name="link_id" value="<?= $row->link_id ?>" />

    <div class="notification-container"></div>

    <div class="form-group mb-3">
		<label><i class="fa fa-signature"></i>Judul Form</label>
		<input type="text" value="<?= $row->url ?>" class="form-control" name="url" required="required" placeholder="Masukan judul form" />
	</div>
	<div class="form-group mb-3">
		<label><i class="fa fa-signature"></i>Keterangan</label>
		<textarea class="form-control" name="keterangan" rows="5" required="required"><?= $row->keterangan ?></textarea>
	</div>
	<div class="form-group mb-3">
		<label><i class="fa fa-signature"></i>Nomor Whatsapp contoh 628123456754 </label>
		<input type="text" class="form-control" value="<?= $row->location_url ?>" name="location_url" required="required" placeholder="Masukan Nomor Whatsapp" />
	</div>
	<div class="form-group mb-3">
		<label><i class="fa fa-paint-brush"></i> Text Color</label>
		<input  type="hidden" name="text_color" class="form-control" value="<?= !empty($row->text_color)?$row->text_color:'#38b2ac'; ?>" required="required" />
		<div class="text_color_pickr"></div>
	</div>
	<div class="form-group mb-3">
		<label><i class="fa fa-fill"></i> Background Color</label>
		<input type="hidden" name="background_color" class="form-control" value="<?= !empty($row->bg_color)?$row->bg_color:'#fff'; ?>" required="required" />
		<div class="background_color_pickr"></div>
	</div>
	<hr>
	
	
    
	<div class="form-group d-flex mb-3">
		<div class="float-right">
			<button class="btn btn-success" type="button" onclick="addFormWhatsAPP<?= $row->link_id ?>();"> <i class="fas fa-plus-circle"></i> Tambah Field </button>
		</div>
	</div>
	
	
    <?php 
		$fromHTML='';
		$i=1;
		if(is_object($row->settings)){
		foreach(@$row->settings as $r){
			
			//echo $r->type;
			
			$selectedInput=($r->type == 'Input')?'selected':'';
			$selectedSelect=($r->type == 'Select')?'selected':'';
			$selectedTextarea=($r->type == 'Textarea')?'selected':'';
			$checked=(@$r->required == 1)?'checked':'';
			
			$fromHTML.='
		
						<div class="form-group removeclass'.$row->link_id.$i.'">
							<div class="card">
								<div class="card-body card-formdinamis">
									<div class="form-group mb-3">
										<label>Type</label>
										<select class="form-control" required="required" name="seting['.$i.'][type]">
											<option value="Input" '.$selectedInput.' >Input</option>
											<option value="Select" '.$selectedSelect.' >Select</option>
											<option value="Textarea" '.$selectedTextarea.' >Textarea </option>
										</select>
									</div>
									<div class="form-group mb-3">
										<label><i class="fa fa-signature"></i>Label</label>
										<input type="text" class="form-control" name="seting['.$i.'][label]" value="'.$r->label.'" required="required" placeholder="Label Form" />
									</div>
									<div class="form-group mb-3">
										<label><i class="fa fa-signature"></i>Keterangan</label>
										<input type="text" class="form-control" name="seting['.$i.'][ket]" value="'.@$r->ket.'" required="required" placeholder="Keterangan" />
									</div>
									<div class="form-group mb-3">
										<label><i class="fa fa-signature"></i>Value pisahkan dengan koma (Digunakan untuk Select)</label>
										<input type="text" class="form-control" name="seting['.$i.'][value]"  value="'.$r->value.'"  placeholder="Pisahkan dengan koma" />
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="seting['.$i.'][required]" value="1" '.$checked.'>
										<label class="form-check-label">Harus Diisi</label>
									</div>
									<button title="delete" class="btn btn-outline-danger btn-hapus" type="button" onclick="remove_fields'.$row->link_id .'(\''.$i.'\');"> <i class="fas fa-trash-alt"></i></button>
								</div>
							</div>
						</div>
						<div class="clear"></div>
							
			
					';
			
			$i++;
			
		}
		}
	
	
	
	?>
	<?= $fromHTML ?>
	<div id="addFormWhatsAPP<?= $row->link_id ?>">

    </div>
    
    
	
	
	
	
	
	
	
	
    <div class="text-center mt-4">
        <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->global->update ?></button>
    </div>
</form>

<script>
    var room<?= $row->link_id ?> = <?= $i ?>;

  function addFormWhatsAPP<?= $row->link_id ?>() {

    room<?= $row->link_id ?>++;
    var objTo = document.getElementById('addFormWhatsAPP<?= $row->link_id ?>')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass<?= $row->link_id ?>" + room<?= $row->link_id ?>);
    var rdiv = 'removeclass<?= $row->link_id ?>' + room<?= $row->link_id ?>;
	
	var html='';
		
		html+='<div class="card">';
		html+='<div class="card-body card-formdinamis">';
		
		html+='<div class="form-group">';
			html+='<label >Type</label>';
			html+='<select class="form-control" required="required" name="seting['+room<?= $row->link_id ?>+'][type]">';
			  html+='<option value="Input" >Input</option>';
			  html+='<option value="Select" >Select</option>';
			  html+='<option value="textarea" >textarea </option>';
			html+='</select>';
		html+='</div>'; 
		html+='<div class="form-group">';
			html+='<label><i class="fa fa-signature"></i>Label</label>';
			html+='<input type="text" class="form-control" name="seting['+room<?= $row->link_id ?>+'][label]" required="required" placeholder="Label Form" />';
		html+='</div>';
		
		html+='<div class="form-group">';
			html+='<label><i class="fa fa-signature"></i>Keterangan</label>';
			html+='<input type="text" class="form-control" name="seting['+room<?= $row->link_id ?>+'][ket]" required="required" placeholder="Label Form" />';
		html+='</div>';
		
		html+='<div class="form-group">';
			html+='<label><i class="fa fa-signature"></i>Value pisahkan dengan koma (Digunakan untuk Select)</label>';
			html+='<input type="text" class="form-control" name="seting['+room<?= $row->link_id ?>+'][value]"  placeholder="Pisahkan dengan koma" />';
		html+='</div>';
		
		html+='<div class="form-check">';
			html+='<input class="form-check-input" type="checkbox" name="seting['+room<?= $row->link_id ?>+'][required]" value="1">';
			html+='<label class="form-check-label">Harus Diisi</label>';
		html+='</div>';
		
		html+='<button title="delete" class="btn btn-danger btn-hapus" type="button" onclick="remove_fields<?=$row->link_id?>(\'' + room<?= $row->link_id ?> + '\');"> <i class="fas fa-trash-alt"></i></button></div></div></div></div><div class="clear"></div>';
		
		html+='</div>';
		html+='</div>';
		
	divtest.innerHTML =html;
    //objTo.prepend(divtest)
	 $('#addFormWhatsAPP<?= $row->link_id ?>').append(divtest.innerHTML);
  }

  function remove_fields<?= $row->link_id ?>(rid) {
    $('.removeclass<?= $row->link_id ?>' + rid).remove();
  }
</script>
