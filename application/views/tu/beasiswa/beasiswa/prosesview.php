
<?php
if(empty($data))
{
	redirect(base_url(akses().'/beasiswa/beasiswa'));
}
foreach($data as $row){	
}
$beasiswaid=$row->beasiswa_id;
$beasiswaID=$beasiswaid;
?>
<script type="text/javascript">
function proseshitung()
{
	$.ajax({
		type:'get',
		dataType:'json',
		url:"<?=base_url(akses().'/beasiswa/beasiswa/proseshitung');?>",
		data:"id=<?=$beasiswaid;?>",
		error:function(){
			$("#respon").html('Proses hitung seleksi beasiswa gagal');
			$("#error").show();
		},
		beforeSend:function(){
			$("#error").hide();
			$("#respon").html("Sedang bekerja, tunggu sebentar");
		},
		success:function(x){
			if(x.status=="ok")
			{
				alert('Proses seleksi berhasil. Halaman akan direfresh');
				window.location=window.location;
			}else{
				$("#respon").html('Proses hitung seleksi beasiswa gagal');
				$("#error").show();
			}
		},
	});
}
</script>

<div id="respon" class="hidden-print"></div>
<?php
$sql="Select COUNT(*) as m FROM peserta Where beasiswa_id='$beasiswaid' AND status IN ('lolos','tidaklolos')";
$c=$this->m_db->get_query_row($sql,'m');
if($c < 1)
{
	echo '<div class="alert alert-warning hidden-print" id="error">Beasiswa belum diproses. Klik <a href="javascript:;" onclick="proseshitung();">di sini</a> untuk proses</div>';
}else{	
?>
<a href="<?=base_url('laporan/penerimabeasiswa');?>?id=<?=$beasiswaid;?>" target="_blank" class="btn btn-default btn-md hidden-print"><i class="fa fa-print"></i> Cetak</a>
<a href="javascript:;" onclick="proseshitung();" class="btn btn-primary btn-md">Ulangi Proses Hitung</a>
<table class="table table-bordered">
<thead>
	<th>Nama Siswa</th>
	<?php
	$dKriteria=$this->mod_kriteria->kriteria_data();
	if(!empty($dKriteria))
	{
		foreach($dKriteria as $rKriteria)
		{
			echo '<th>'.$rKriteria->nama_kriteria.'</th>';
		}
	}
	?>
	<th>Total</th>
	<th>Status</th>
</thead>
<?php
$s=array(
'beasiswa_id'=>$beasiswaID,
);
if($this->m_db->is_bof('beasiswa',$s)==FALSE)
{
	$dPeserta=$this->m_db->get_data('peserta',$s);
	if(!empty($dPeserta))
	{
		
		foreach($dPeserta as $rPeserta)
		{
			$pesertaID=$rPeserta->peserta_id;
			$siswaID=$rPeserta->siswa_id;
			$NISN=field_value('siswa','siswa_id',$siswaID,'nisn');
			$nama=field_value('siswa','siswa_id',$siswaID,'nama');
			
			?>
			<tr>
				<td><?=$NISN." ".$nama;?></td>
				<?php
				$total=0;
				if(!empty($dKriteria))
				{
					foreach($dKriteria as $rKriteria)
					{						
						$kriteriaid=$rKriteria->kriteria_id;
						$subkriteria=peserta_nilai($pesertaID,$kriteriaid);
						$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
						$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
						$prioritas=ambil_prioritas($beasiswaid,$subkriteria);
						$total+=$prioritas;
						echo '<td>'.number_format($prioritas,2).'</td>';
					}
				}
				?>
				<td><?=number_format($total,2);?></td>
				<td><?=ucwords($rPeserta->status);?></td>
			</tr>			
			<?php
			
		}
		
	}else{
		return false;
	}
	
}else{
	return false;
}
?>
</table>
<?php
}
?>