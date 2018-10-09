<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peserta extends CI_Controller
{
	private $x_wali;
	private $x_kelas;
	private $x_jurusan;
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="walikelas")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('Beasiswa_model','mod_bea');
		$this->load->model('siswa_model','mod_siswa');
		$this->load->model('kriteria_model','mod_kriteria');
		$s=array(
		'user_id'=>user_info('user_id'),
		);
		$this->x_wali=$this->m_db->get_row('wali_kelas',$s,'wali_kelas_id');
		$this->x_kelas=$this->m_db->get_row('wali_kelas',$s,'kelas');
		$this->x_jurusan=$this->m_db->get_row('wali_kelas',$s,'jurusan');
    }
    
    function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$s="";
    	$nama="";
    	if(!empty($id))
    	{
			$s=" Where beasiswa.beasiswa_id='$id'";
			$nama=" ".field_value('beasiswa','beasiswa_id',$id,'judul');
		}
    	$sql="SELECT peserta.peserta_id,siswa.siswa_id,siswa.nisn,siswa.nama,siswa.kelas,siswa.jurusan,siswa.semester,siswa.tahun,beasiswa.judul,peserta.status FROM (peserta LEFT JOIN siswa ON peserta.siswa_id = siswa.siswa_id) LEFT JOIN beasiswa ON peserta.beasiswa_id = beasiswa.beasiswa_id".$s;
        $meta['judul']="Peserta Beasiswa".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $d['wali']=$this->x_wali;
        $d['kelas']=$this->x_kelas;
        $d['jurusan']=$this->x_jurusan;
        $this->load->view(akses().'/beasiswa/peserta/pesertaview',$d);
        $this->load->view('tema/footer');
    }
    
    function getpeserta()
    {
		$beasiswa=$this->input->get('beasiswa');
		if(!empty($beasiswa))
		{
			$s=array(
			'beasiswa_id'=>$beasiswa,
			);
			$d=$this->m_db->get_data('peserta',$s);
			if(!empty($d))
			{
				$listSiswa="";
				foreach($d as $r)
				{
					$listSiswa.=$r->siswa_id.",";
				}
				$listSiswa=substr($listSiswa,0,-1);
				
				$sql="Select * from siswa Where siswa_id NOT IN ($listSiswa)";
				$o=$this->m_db->get_query_data($sql);
				echo json_encode($o);
			}else{
				$d=$this->mod_siswa->siswa_data();
				echo json_encode($d);
			}
		}else{
			echo json_encode(array());
		}
	}
    
    function add()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('siswaid','ID Siswa','required');
		$this->form_validation->set_rules('beasiswaid','ID Beasiswa','required');
		if($this->form_validation->run()==TRUE)
		{			
			$siswa=$this->input->post('siswaid');
			$beasiswa=$this->input->post('beasiswaid');
			$kriteria=$this->input->post('kriteria');
			
			
			
			if($this->mod_bea->peserta_add($siswa,$this->x_kelas,$this->x_jurusan,$this->x_wali,$beasiswa,$kriteria)==TRUE)
			{
				set_header_message('success','Tambah Peserta','Berhasil menambah peserta beasiswa');
				redirect(base_url(akses().'/beasiswa/peserta'.$ref));
			}else{
				set_header_message('danger','Tambah Peserta','Gagal menambah peserta beasiswa');
				redirect(base_url(akses().'/beasiswa/peserta/add'.$ref));
			}
		}else{
			$meta['judul']="Tambah Peserta";
	        $this->load->view('tema/header',$meta);
	        $d['link']=$ref;
	        $d['beasiswa']=$this->mod_bea->beasiswa_data();
	        $d['beasiswaid']=$bearef;
	        $s=array(
	        'kelas'=>$this->x_kelas,
	        'jurusan'=>$this->x_jurusan,
	        'walikelas_id'=>$this->x_wali,
	        );
	        $d['siswa']=$this->mod_siswa->siswa_data($s);
	        $d['kriteria']=$this->mod_kriteria->kriteria_data();
	        $this->load->view(akses().'/beasiswa/peserta/pesertaadd',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function edit()
	{
		$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('pesertaid','ID Siswa','required');
		$this->form_validation->set_rules('siswaid','ID Siswa','required');
		$this->form_validation->set_rules('beasiswaid','ID Beasiswa','required');
		if($this->form_validation->run()==TRUE)
		{			
			$pesertaid=$this->input->post('pesertaid');
			$siswa=$this->input->post('siswaid');
			$beasiswa=$this->input->post('beasiswaid');
			$kriteria=$this->input->post('kriteria');			
			
			if($this->mod_bea->peserta_edit($pesertaid,$siswa,$this->x_kelas,$this->x_jurusan,$this->x_wali,$beasiswa,$kriteria)==TRUE)
			{
				set_header_message('success','Ubah Peserta','Berhasil mengubah peserta beasiswa');
				redirect(base_url(akses().'/beasiswa/peserta'.$ref));
			}else{
				set_header_message('danger','Ubah Peserta','Gagal mengubah peserta beasiswa');
				redirect(base_url(akses().'/beasiswa/peserta'.$ref));
			}
			
		}else{
			$id=$this->input->get('peserta');
			$siswaid=field_value('peserta','peserta_id',$id,'siswa_id');
			$s=array(
	        'kelas'=>$this->x_kelas,
	        'jurusan'=>$this->x_jurusan,
	        'walikelas_id'=>$this->x_wali,
	        'siswa_id'=>$siswaid,
	        );
	        if($this->m_db->is_bof('siswa',$s)==FALSE)
	        {
				$meta['judul']="Ubah Peserta";
		        $this->load->view('tema/header',$meta);
		        $d['link']=$ref;
		        $d['beasiswa']=$this->mod_bea->beasiswa_data();
		        $d['beasiswaid']=$bearef;
		        $s=array(
		        'kelas'=>$this->x_kelas,
		        'jurusan'=>$this->x_jurusan,
		        'walikelas_id'=>$this->x_wali,
		        );
		        $d['siswa']=$this->mod_siswa->siswa_data($s);
		        $d['kriteria']=$this->mod_kriteria->kriteria_data();
		        $d['data']=$this->m_db->get_data('peserta',array('peserta_id'=>$id));
		        $this->load->view(akses().'/beasiswa/peserta/pesertaedit',$d);
		        $this->load->view('tema/footer');
		    }else{
				redirect(base_url(akses().'/beasiswa/peserta'));
			}
		}
	}
	
	function delete()
	{
		$id=$this->input->get('peserta');
		if($this->mod_bea->peserta_delete($id,$this->x_kelas,$this->x_jurusan,$this->x_wali)==TRUE)
		{
			set_header_message('success','Hapus Peserta','Berhasil menghapus peserta');
			redirect(base_url(akses().'/beasiswa/peserta'));
		}else{
			set_header_message('danger','Hapus Peserta','Gagal menghapus peserta');
			redirect(base_url(akses().'/beasiswa/peserta'));
		}
	}
    
}
