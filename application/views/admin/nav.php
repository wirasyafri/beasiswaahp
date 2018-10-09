<?php
$menu=array(
	'Users'=>array(		
		'icon'=>'fa fa-users',
		'slug'=>'user',
		'child'=>array(
				'All User'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/users",
					'target'=>"",
					),
				'Add User'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/users/add",
					'target'=>"",
					),				
			),
	),
);
?>