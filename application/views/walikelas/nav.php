<?php
$menu=array(
	'Data Siswa'=>array(		
		'icon'=>'fa fa-users',
		'slug'=>'siswa',
		'child'=>array(
				'Semua Siswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/siswa",
					'target'=>"",
					),
				'Tambah Siswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/siswa/add",
					'target'=>"",
					),				
			),
	),
	'Beasiswa'=>array(		
		'icon'=>'fa fa-money',
		'slug'=>'beasiswa',
		'child'=>array(
				'Data Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/beasiswa",
					'target'=>"",
					),
				'Peserta Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/peserta",
					'target'=>"",
					),
				'Tambah Peserta'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/peserta/add",
					'target'=>"",
					),
			),
	),
);
?>