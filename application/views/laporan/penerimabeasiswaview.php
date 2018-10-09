<?php
foreach($data as $row){	
}
$beasiswaid=$row->beasiswa_id;
$beasiswaID=$beasiswaid;
?>
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