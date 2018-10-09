<?php
$menu=array(
	'Beasiswa'=>array(		
		'icon'=>'fa fa-money',
		'slug'=>'beasiswa',
		'child'=>array(
				'Semua Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa",
					'target'=>"",
					),
				'Tambah Beasiswa'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/beasiswa/add",
					'target'=>"",
					),				
			),
	),
);
?>