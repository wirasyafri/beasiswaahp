<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
if(empty($data))
{
	redirect(base_url(akses().'/beasiswa/peserta'));
}
foreach($data as $row){	
}

echo validation_errors();
echo form_open(base_url(akses().'/beasiswa/peserta/edit'.$link),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="pesertaid" value="<?=$row->peserta_id;?>"/>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Beasiswa</label>
	<div class="col-md-10">
		<p class="form-control-static"><?=field_value('beasiswa','beasiswa_id',$row->beasiswa_id,'judul');?></p>
		<input type="hidden" name="beasiswaid" id="beasiswaid" value="<?=$row->beasiswa_id;?>"/>		
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Siswa</label>
	<div class="col-md-10">
		<p class="form-control-static"><?=field_value('siswa','siswa_id',$row->siswa_id,'nama');?></p>
		<input type="hidden" name="siswaid" value="<?=$row->siswa_id;?>"/>
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
							$nDB=peserta_nilai($row->peserta_id,$rSub->kriteria_id);							
							$jj='';
							if($rSub->subkriteria_id==$nDB)
							{
								$jj='selected="selected"';
							}							
							echo '<option value="'.$rSub->subkriteria_id.'" '.$jj.'>'.$o.'</option>';
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
		<button type="submit" class="btn btn-primary btn-flat">Ubah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
<?php
echo form_close();
?>