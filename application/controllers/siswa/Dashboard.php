<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="siswa")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('siswa_model','mod_siswa');
    }
    
    function index()
    {
    	$userid=user_info('user_id');
        $meta['judul']="Dashboard Siswa";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('siswa',array('user_id'=>$userid));
        $this->load->view(akses().'/dashboardview',$d);
        $this->load->view('tema/footer');
    }
    
    function edit()
    {		
		$this->form_validation->set_rules('nisn','NISNS','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('semester','Semester','required');
		$this->form_validation->set_rules('tahun','Tahun Masuk','required');
		$this->form_validation->set_rules('tempat','Tahun Masuk','required');
		$this->form_validation->set_rules('tanggal','Tahun Masuk','required');
		if($this->form_validation->run()==TRUE)
		{
			$siswaid=$this->input->post('siswaid');
			$nisn=$this->input->post('nisn');
			$nama=$this->input->post('nama');
			$tahun=$this->input->post('tahun');
			$jk=$this->input->post('jk');
			$tempat=$this->input->post('tempat');
			$tgl=$this->input->post('tanggal');
			$alamat=$this->input->post('alamat');
			$anak_ke=$this->input->post('anakke');
			$saudara=$this->input->post('saudara');
			$ayah=$this->input->post('namaayah');
			$ibu=$this->input->post('namaibu');
			$kerjaayah=$this->input->post('kerjaayah');
			$kerjaibu=$this->input->post('kerjaibu');
			
			if($this->mod_siswa->siswa_edit_siswa($siswaid,$nisn,$nama,$jk,$tahun,$tempat,$tgl,$alamat,$anak_ke,$saudara,$ayah,$kerjaayah,$ibu,$kerjaibu)==TRUE)
			{
				set_header_message('success','Ubah Profil','Berhasil mengubah Profil');
				redirect(base_url(akses().'/dashboard'));
			}else{
				set_header_message('danger','Ubah Profil','Gagal mengubah Profil');
				redirect(base_url(akses().'/dashboard'));
			}
			
		}else{
			redirect(base_url(akses().'/dashboard'));
		}
	}
    
}
