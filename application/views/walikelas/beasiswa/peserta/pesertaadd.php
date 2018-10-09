<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
echo form_open(base_url(akses().'/beasiswa/peserta/add'.$link),array('class'=>'form-horizontal'));
?>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Beasiswa</label>
	<div class="col-md-10">
		<?php
		if(!empty($beasiswaid))
		{
			$namaBeasiswa=field_value('beasiswa','beasiswa_id',$beasiswaid,'judul');
		?>
		<p class="form-control-static"><?=$namaBeasiswa;?></p>
		<input type="hidden" name="beasiswaid" id="beasiswaid" value="<?=$beasiswaid;?>"/>
		<?php
		}else{
		?>
		<select name="beasiswaid" class="form-control" id="beasiswaid" data-placeholder="Pilih Beasiswa" required="" style="width: 100%">
			<option></option>
			<?php
			if(!empty($beasiswa))
			{
				foreach($beasiswa as $rbe)
				{
					echo '<option value="'.$rbe->beasiswa_id.'" '.set_select('beasiswaid',$rbe->beasiswa_id).'>'.$rbe->judul.'</option>';
				}
			}
			?>
		</select>
		<?php
		}
		?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Siswa</label>
	<div class="col-md-10">
		<select name="siswaid" class="form-control loadajax" data-placeholder="Pilih Beasiswa" required="" style="width: 100%">
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Penilaian</label>
	<div class="col-md-10">
		<table class="table table-bordered">
			<thead>
				<th>Kriteria</th>
				<th>Nilai</th>
			</thead>
			<tbody>
			<?php
			if(!empty($kriteria))
			{
				foreach($kriteria as $rk)
				{
					$kriteriaid=$rk->kriteria_id;
					echo '<tr>';
					echo '<td>'.$rk->nama_kriteria.'</td>';
					echo '<td>';
					$dSub=$this->m_db->get_data('subkriteria',array('kriteria_id'=>$kriteriaid));
					if(!empty($dSub))
					{						
						echo '<select name="kriteria['.$kriteriaid.']" class="form-control" data-placeholder="Pilih Nilai" required style="width: 100%">';
						echo '<option></option>';
						foreach($dSub as $rSub)
						{
							$o='';
							if($rSub->tipe=="teks")
							{
								$o=$rSub->nama_subkriteria;
							}elseif($rSub->tipe=="nilai"){
								$opmin=$rSub->op_min;
								$opmax=$rSub->op_max;
								$nilaimin=$rSub->nilai_minimum;
								$nilaimax=$rSub->nilai_maksimum;
								if($opmin==$opmax && $nilaimin==$nilaimax)
								{
									$o=$opmax." ".$nilaimin;
								}else{
									$o=$opmin." ".$nilaimin." dan ".$opmax." ".$nilaimax;
								}
							}
							echo '<option value="'.$rSub->subkriteria_id.'">'.$o.'</option>';
						}
						echo '</select>';
					}
					echo '</td>';
					echo '</tr>';
				}
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
<?php
echo form_close();
?>
<script type="text/javascript">
$(document).ready(function () {
	
$(".loadajax").select2({		
placeholder:{
	id:'-1',
	text:'Pilih Siswa'
},
ajax:{
	url:'<?=base_url(akses()."/beasiswa/peserta/getpeserta");?>',
	dataType:'json',
	delay:0,
	data:function(){
		return {
	        beasiswa: $("#beasiswaid").val(),
	    };
	},
	processResults: function (data,params) {
		params.page = params.page || 1;
      	return {
	        results: $.map(data, function(obj) {
	            return { id: obj.siswa_id, text: obj.nama };
	        }),
	        pagination: {
	          more: (params.page * 30) < data.total_count
	        }
    	};
    }
}
});

});
</script>