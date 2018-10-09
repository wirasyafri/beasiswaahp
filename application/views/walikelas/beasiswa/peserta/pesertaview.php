<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#datatable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
});
</script>
<div>
	<a href="<?=base_url(akses().'/beasiswa/peserta/add'.$link);?>" class="btn btn-primary btn-md">Tambah Peserta</a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>NISN</th>
		<th>Nama</th>
		<th>Kelas</th>
		<th>Semester</th>
		<th>Tahun Masuk</th>
		<th>Beasiswa</th>
		<th>Status</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->siswa_id;
				$pid=$row->peserta_id;
			?>
			<tr>
				<td><?=$row->nisn;?></td>				
				<td><?=$row->nama;?></td>
				<td><?=$row->kelas." ".$row->jurusan;?></td>				
				<td><?=$row->semester;?></td>
				<td><?=$row->tahun;?></td>
				<td><?=$row->judul;?></td>
				<td><?=ucwords($row->status);?></td>
				<td>
					<?php
					$s=array(
			        'kelas'=>$kelas,
			        'jurusan'=>$jurusan,
			        'walikelas_id'=>$wali,
			        'siswa_id'=>$id,
			        );
			        if($this->m_db->is_bof('siswa',$s)==FALSE)
			        {
					?>
					<a href="<?=base_url(akses().'/beasiswa/peserta/edit');?>?peserta=<?=$pid;?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a onclick="return confirm('Yakin ingin menghapus siswa ini?');" href="<?=base_url(akses().'/beasiswa/peserta/delete');?>?peserta=<?=$pid;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
					<?php	
					}
					?>					
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>