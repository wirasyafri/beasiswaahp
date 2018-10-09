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
	<a href="<?=base_url(akses().'/beasiswa/beasiswa/add');?>" class="btn btn-primary btn-flat">Tambah Beasiswa</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>Judul</th>
		<th>Tahun</th>
		<th>Kuota</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->beasiswa_id;
			?>
			<tr>
				<td><?=$row->judul;?></td>				
				<td><?=$row->tahun;?></td>
				<td><?=$row->kuota;?></td>
				<td>
					<a href="<?=base_url(akses().'/beasiswa/beasiswa/proses');?>?id=<?=$id;?>" class="btn btn-xs btn-success">Penerima</a> 
					<a href="<?=base_url(akses().'/beasiswa/beasiswa/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-info">Edit</a>
					<a onclick="return confirm('Yakin ingin menghapus beasiswa ini?');" href="<?=base_url(akses().'/beasiswa/beasiswa/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger">Delete</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>