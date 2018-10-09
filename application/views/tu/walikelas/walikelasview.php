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
	<a href="<?=base_url(akses().'/walikelas/add');?>" class="btn btn-primary btn-flat">Tambah Wali Kelas</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>Nama</th>
		<th>NUPTK</th>		
		<th>Kelas</th>
		<th>Jurusan</th>
		<th>TTL</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->wali_kelas_id;
				$title="Bapak ";
				if($row->jenkel=="wanita")
				{
					$title="Ibu ";
				}
			?>
			<tr>
				<td><?=$title.$row->nama;?></td>
				<td><?=$row->nuptk;?></td>
				<td><?=$row->kelas;?></td>
				<td><?=$row->jurusan;?></td>
				<td><?=$row->tempat.",".$row->tgl_lahir;?></td>
				<td>
					<a href="<?=base_url(akses().'/walikelas/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-info">Edit</a>
					<a onclick="return confirm('Yakin ingin menghapus wali kelas ini?');" href="<?=base_url(akses().'/walikelas/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger">Delete</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>