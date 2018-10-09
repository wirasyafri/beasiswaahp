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
echo validation_errors();
echo form_open(base_url(akses().'/walikelas/add'),array('class'=>'form-horizontal'));
?>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama</label>
	<div class="col-md-6">
		<input type="text" name="nama" id="" class="form-control " autocomplete="" placeholder="Nama User" required="" value="<?php echo set_value('nama'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Gender</label>
	<div class="col-md-6">
		<?php
		$arr=array('pria','wanita');
		foreach($arr as $r)
		{
		?>
		<div class="radio">
			<label>
				<input type="radio" name="jk" value="<?=$r;?>"/> <?=ucfirst($r);?>
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
		<input type="text" name="kelas" id="" class="form-control " autocomplete="" placeholder="Kelas" required="" value="<?php echo set_value('kelas'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Jurusan</label>
	<div class="col-md-6">
		<input type="text" name="jurusan" id="" class="form-control " autocomplete="" placeholder="Jurusan" required="" value="<?php echo set_value('jurusan'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Tempat Lahir</label>
	<div class="col-md-6">
		<input type="text" name="tempat" id="" class="form-control " autocomplete="" placeholder="Tempat Lahir" required="" value="<?php echo set_value('tempat'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Tanggal Lahir</label>
	<div class="col-md-6">
		<input type="text" name="tgl" id="" class="form-control tanggal" autocomplete="" placeholder="Tanggal lahir" required="" value="<?php echo set_value('tgl'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Username</label>
	<div class="col-md-6">
		<input type="text" name="username" id="" class="form-control " required="" autocomplete="" placeholder="Username Baru" value="<?php echo set_value('username'); ?>"/>		
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Password Baru</label>
	<div class="col-md-6">
		<input type="password" name="password" id="" class="form-control " required="" autocomplete="" placeholder="Password Baru" value="<?php echo set_value('password'); ?>"/>		
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
	</div>
</div>
<?php
echo form_close();
?>