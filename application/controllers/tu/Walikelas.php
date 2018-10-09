<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Walikelas extends CI_Controller
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
    }
    
    function index()
    {
        $meta['judul']="Data Wali Kelas";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('wali_kelas');
        $this->load->view(akses().'/walikelas/walikelasview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('jurusan','Jurusan','required');
		$this->form_validation->set_rules('tempat','Tempat Lahir','required');
		$this->form_validation->set_rules('tgl','Tanggal Lahir','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password User','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama=$this->input->post('nama');
			$kelas=$this->input->post('kelas');
			$jurusan=$this->input->post('jurusan');
			$tempat=$this->input->post('tempat');
			$tgl=$this->input->post('tgl');
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$akses='walikelas';
			$jk=$this->input->post('jk');
			
			$d=array(
			'username'=>$username,
			'nama'=>$nama,
			'password'=>md5($password),
			'akses'=>$akses,
			);
			if($this->m_db->add_row('pengguna',$d)==TRUE)
			{
				$userID=$this->m_db->last_insert_id();
				
				$d2=array(
				'nuptk'=>$username,
				'kelas'=>$kelas,
				'jurusan'=>$jurusan,
				'nama'=>$nama,
				'tempat'=>$tempat,
				'tgl_lahir'=>$tgl,
				'jenkel'=>$jk,
				);
				
				if($this->m_db->add_row('wali_kelas',$d2)==TRUE)
				{
					set_header_message('success','Tambah Wali Kelas','Berhasil Tambah Wali Kelas');
					redirect(base_url(akses().'/walikelas'));
				}else{
					set_header_message('danger','Tambah Wali Kelas','Gagal Tambah Wali Kelas');
					redirect(base_url(akses().'/walikelas/add'));
				}
			}else{
				set_header_message('danger','Tambah Wali Kelas','Gagal Tambah Wali Kelas');
				redirect(base_url(akses().'/walikelas/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Wali Kelas";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/walikelas/walikelasadd');
			$this->load->view('tema/footer');
		}
	}
	
	function edit()
    {
		$this->form_validation->set_rules('walikelasid','ID Wali Kelas','required');
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('jurusan','Jurusan','required');
		$this->form_validation->set_rules('tempat','Tempat Lahir','required');
		$this->form_validation->set_rules('tgl','Tanggal Lahir','required');
		if($this->form_validation->run()==TRUE)
		{
			$walikelasid=$this->input->post('walikelasid');
			$nama=$this->input->post('nama');
			$kelas=$this->input->post('kelas');
			$jurusan=$this->input->post('jurusan');
			$tempat=$this->input->post('tempat');
			$tgl=$this->input->post('tgl');
			$akses='walikelas';
			$jk=$this->input->post('jk');
			
			$s=array(
			'wali_kelas_id'=>$walikelasid,
			);
			
			$d2=array(			
			'kelas'=>$kelas,
			'jurusan'=>$jurusan,
			'nama'=>$nama,
			'tempat'=>$tempat,
			'tgl_lahir'=>$tgl,
			'jenkel'=>$jk,
			);
			if($this->m_db->edit_row('wali_kelas',$d2,$s)==TRUE)
			{
				$userID=$this->m_db->get_row('wali_kelas',$s,'user_id');
				$s2=array(
				'user_id'=>$userID,
				);
				$d=array(				
				'nama'=>$nama,
				);
				$this->m_db->edit_row('pengguna',$d,$s2);
				set_header_message('success','Ubah Wali Kelas','Berhasil Mengubah Wali Kelas');
				redirect(base_url(akses().'/walikelas'));
			}else{
				set_header_message('danger','Ubah Wali Kelas','Gagal Mengubah Wali Kelas');
				redirect(base_url(akses().'/walikelas'));
			}			
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Wali Kelas";
			$this->load->view('tema/header',$meta);
			$d['data']=$this->m_db->get_data('wali_kelas',array('wali_kelas_id'=>$id));
			$this->load->view(akses().'/walikelas/walikelasedit',$d);
			$this->load->view('tema/footer');
		}
	}
    
    function delete()
    {
		$id=$this->input->get('id');
		$s=array(
		'wali_kelas_id'=>$id,
		);
		if($this->m_db->is_bof('wali_kelas',$s)==FALSE)
		{
			$userid=$this->m_db->get_row('wali_kelas',$s,'user_id');
			$this->m_db->delete_row('wali_kelas',$s);
			$s2=array(
			'user_id'=>$userid,
			);
			$this->m_db->delete_row('pengguna',$s2);
			set_header_message('success','Hapus Wali Kelas','Berhasil menghapus wali kelas');
			redirect(base_url(akses()).'/walikelas');
		}else{
			set_header_message('danger','Hapus Wali Kelas','Gagal menghapus wali kelas');
			redirect(base_url(akses()).'/walikelas');
		}
	}
    
}
