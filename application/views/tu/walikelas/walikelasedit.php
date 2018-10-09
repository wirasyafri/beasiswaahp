<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/jquery-ui.min.css"/>
<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/themes/overcast/jquery-ui.min.css"/>
<script src="<?=base_url();?>konten/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	if($(".tanggal").length)
	{
		$(".tanggal").datepicker({
			dateFormat: "yy-mm-dd",
			showAnim:"slide",
			changeMonth: true,
			changeYear: true,
			yearRange:'c-70:c+10',
		});
	}
});
</script>
<?php
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/walikelas/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="walikelasid" value="<?=$row->wali_kelas_id;?>"/>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama</label>
	<div class="col-md-6">
		<input type="text" name="nama" id="" class="form-control " autocomplete="" placeholder="Nama User" required="" value="<?php echo set_value('nama',$row->nama); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Gender</label>
	<div class="col-md-6">
		<?php
		$arr=array('pria','wanita');
		foreach($arr as $r)
		{
			$jj='';
			if($r==$row->jenkel)
			{
				$jj='checked="checked"';
			}
		?>
		<div class="radio">
			<label>
				<input type="radio" name="jk" value="<?=$r;?>" <?=$jj;?>/> <?=ucfirst($r);?>
			</label>
		</div>		
		<?php
		}
		?>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Kelas</label>
	<div class="col-md-6">
		<input type="text" name="kelas" id="" class="form-control " autocomplete="" placeholder="Kelas" required="" value="<?php echo set_value('kelas',$row->kelas); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Jurusan</label>
	<div class="col-md-6">
		<input type="text" name="jurusan" id="" class="form-control " autocomplete="" placeholder="Jurusan" required="" value="<?php echo set_value('jurusan',$row->jurusan); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Tempat Lahir</label>
	<div class="col-md-6">
		<input type="text" name="tempat" id="" class="form-control " autocomplete="" placeholder="Tempat Lahir" required="" value="<?php echo set_value('tempat',$row->tempat); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Tanggal Lahir</label>
	<div class="col-md-6">
		<input type="text" name="tgl" id="" class="form-control tanggal" autocomplete="" placeholder="Tanggal lahir" required="" value="<?php echo set_value('tgl',$row->tgl_lahir); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Ubah</button>
	</div>
</div>
<?php
echo form_close();
?>