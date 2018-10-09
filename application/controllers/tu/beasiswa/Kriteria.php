<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="tu")
        {
			redirect(base_url().'logout');
		}
		
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('beasiswa_model','mod_beasiswa');
    }
    
    function index()
    {        
        $meta['judul']="Kriteria Beasiswa";
        $this->load->view('tema/header',$meta);
        $d['beasiswa']=$this->mod_beasiswa->beasiswa_data();
        $this->load->view(akses().'/beasiswa/matriks/kriteriacontainer',$d);
        $this->load->view('tema/footer');
    }
    
    function gethtml()
    {
    	$id=$this->input->get('beasiswa');
		$output=array();
        $dKriteria=$this->mod_kriteria->kriteria_data();
		foreach($dKriteria as $rK)
		{
			$output[$rK->kriteria_id]=$rK->nama_kriteria;
		}		
    	$d['arr']=$output;
    	$d['beasiswaid']=$id;
    	$this->load->view(akses().'/beasiswa/matriks/matrikutama',$d);
	}
	
	function getsubcontainer()
	{
		$id=$this->input->get('beasiswaid');
		$d['kriteria']=$this->mod_kriteria->kriteria_data();
		$d['beasiswaid']=$id;
		$this->load->view(akses().'/beasiswa/matriks/subcontainer',$d);
	}
	
	function getsub()
	{		
		$beasiswa=$this->input->get('beasiswa');
		$id=$this->input->get('kriteria');
    	$namaKriteria=$this->mod_kriteria->kriteria_info($id,'nama_kriteria');
    	$dSub=$this->mod_kriteria->subkriteria_child($id,'nilai_id ASC');
    	$output=array();
    	if(!empty($dSub))
    	{					
		foreach($dSub as $rK)
		{
			$nama=field_value('nilai_kategori','nilai_id',$rK->nilai_id,'nama_nilai');
			$output[$rK->subkriteria_id]=$nama;
		}
		}
    	$d['arr']=$output;
    	$d['kriteriaid']=$id;
    	$d['beasiswaid']=$beasiswa;
    	$d['namakriteria']=$namaKriteria;
    	$this->load->view(akses().'/beasiswa/matriks/matriksub',$d);
	}
    
    function add()
    {
		$this->form_validation->set_rules('nama','Nama Kriteria','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama=$this->input->post('nama');
			if($this->mod_kriteria->kriteria_add($nama)==TRUE)
			{
				redirect(base_url(akses()).'/ahp/kriteria');
			}else{
				redirect(base_url(akses()).'/ahp/kriteria/add');
			}
		}else{
			$meta['judul']="Tambah Kriteria Utama";
        	$this->load->view('tema/header',$meta);
        	$this->load->view(akses().'/ahp/kriteria/kriteriaadd');
        	$this->load->view('tema/footer');
		}
	}
    
    function updatedata()
    {
		foreach($_POST as $k=>$v)
		{
			$s=array(
			'kriteria_id'=>$k,
			);
			$d=array(
			'nama_kriteria'=>$v,
			);
			$this->m_db->edit_row('kriteria',$d,$s);
		}
		redirect(base_url(akses().'/ahp/kriteria'));
	}
	
	function deletedata()
	{
		$s=array(
		'kriteria_id'=>$this->input->get('id'),
		);		
		$this->m_db->delete_row('kriteria',$s);
		redirect(base_url(akses().'/ahp/kriteria'));
	}
    
    function updateutama()
    {
    	$error=FALSE;
    	$beasiswaid=$this->input->post('beasiswaid');
    	if(!empty($beasiswaid))
    	{
			
		
    	$msg="";
    	$s=array(
    	'kriteria_nilai_id !='=>''
    	);
    	$this->m_db->delete_row('kriteria_nilai',$s);
    	    	
    	$cr=$this->input->post('crvalue');
    	if($cr > 0.01)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="beasiswaid")
				{									
				foreach($v as $x=>$x2)
				{
					$d=array(
					'beasiswa_id'=>$beasiswaid,
					'kriteria_id_dari'=>$k,
					'kriteria_id_tujuan'=>$x,
					'nilai'=>$x2,
					);
					$this->m_db->add_row('kriteria_nilai',$d);
				}
				}
			}
			$msg="Berhasil update nilai kriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
		}else{
			$msg="Gagal mengubah nilai kriteria";
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
	}
	
	function updatesub()
    {
    	$error=FALSE;
    	$beasiswaid=$this->input->post('beasiswaid');
    	$kriteriaid=$this->input->post('kriteriaid');
    	if(!empty($beasiswaid) && !empty($kriteriaid))
    	{
			
		
    	$msg="";
    	$s=array(
    	'beasiswa_id'=>$beasiswaid,
    	'kriteria_id'=>$kriteriaid,
    	);
    	$this->m_db->delete_row('subkriteria_nilai',$s);
    	    	
    	$cr=$this->input->post('crvalue');
    	if($cr > 0.01)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="beasiswaid" && $k!="kriteriaid")
				{									
				foreach($v as $x=>$x2)
				{
					$d=array(
					'beasiswa_id'=>$beasiswaid,
					'kriteria_id'=>$kriteriaid,
					'subkriteria_id_dari'=>$k,
					'subkriteria_id_tujuan'=>$x,
					'nilai'=>$x2,
					);
					$this->m_db->add_row('subkriteria_nilai',$d);
				}
				}
			}
			$msg="Berhasil update nilai subkriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
		}else{
			$msg="Gagal mengubah nilai subkriteria";
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
	}
	
	function updatesubprioritas()
	{
		$beasiswaid=$this->input->post('beasiswaid');
    	$kriteriaid=$this->input->post('kriteriaid');
    	$prio=$this->input->post('prio');
    	if(!empty($prio))
    	{
			foreach($prio as $rk=>$rv)
			{
				$s=array(
				'beasiswa_id'=>$beasiswaid,
				'subkriteria_id'=>$rk,
				);
				if($this->m_db->is_bof('subkriteria_hasil',$s)==TRUE)
				{
					$d=array(
					'beasiswa_id'=>$beasiswaid,
					'subkriteria_id'=>$rk,
					'prioritas'=>$rv,
					);
					$this->m_db->add_row('subkriteria_hasil',$d);
				}else{
					$d=array(					
					'prioritas'=>$rv,
					);
					$this->m_db->edit_row('subkriteria_hasil',$d,$s);
				}
			}
			echo json_encode('ok');
		}else{
			echo json_encode('no');
		}
	}
    
}
