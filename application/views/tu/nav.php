<?php

$menu=array(
	'Beasiswa'=>array(		
		'icon'=>'fa fa-money',
		'slug'=>'beasiswa',
		'child'=>array(
				'Semua Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/beasiswa",
					'target'=>"",
					),
				'Kriteria Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/kriteria",
					'target'=>"",
					),
				'Peserta Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/peserta",
					'target'=>"",
					),				
			),
	),
	'Wali Kelas'=>array(		
		'icon'=>'fa fa-users',
		'slug'=>'walikelas',
		'child'=>array(
				'Semua Wali Kelas'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/walikelas",
					'target'=>"",
					),
				'Tambah Wali Kelas'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/walikelas/add",
					'target'=>"",
					),				
			),
	),	
	'Master'=>array(		
		'icon'=>'fa fa-code',
		'slug'=>'master',
		'child'=>array(
				'Data Kriteria'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/master/kriteria",
					'target'=>"",
				),
				'Tambah Kriteria Utama'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/master/kriteria/add",
					'target'=>"",
				),				
			),
	),
);
?>