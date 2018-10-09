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

<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>Judul</th>
		<th>Keterangan</th>
		<th>Tahun</th>
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
				<td><?=$row->keterangan;?></td>				
				<td><?=$row->tahun;?></td>
				<td>
					<a href="<?=base_url(akses().'/beasiswa/peserta');?>?id=<?=$id;?>" class="btn btn-xs btn-info"><i class="fa fa-users"></i> Daftar Peserta</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>