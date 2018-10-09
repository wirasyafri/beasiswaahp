<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa extends CI_Controller
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
		$this->load->model('siswa_model','mod_siswa');
		$s=array(
		'user_id'=>user_info('user_id'),
		);
		$this->x_wali=$this->m_db->get_row('wali_kelas',$s,'wali_kelas_id');
		$this->x_kelas=$this->m_db->get_row('wali_kelas',$s,'kelas');
		$this->x_jurusan=$this->m_db->get_row('wali_kelas',$s,'jurusan');
    }
    
    function index()
    {
        $meta['judul']="Semua Siswa";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_siswa->siswa_data(array('kelas'=>$this->x_kelas,'jurusan'=>$this->x_jurusan));
        $this->load->view(akses().'/siswa/siswaview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nisn','NISNS','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('semester','Semester','required');
		$this->form_validation->set_rules('tahun','Tahun Masuk','required');
		$this->form_validation->set_rules('tempat','Tahun Masuk','required');
		$this->form_validation->set_rules('tanggal','Tahun Masuk','required');
		if($this->form_validation->run()==TRUE)
		{
			$nisn=$this->input->post('nisn');
			$nama=$this->input->post('nama');
			$kelas=$this->x_kelas;
			$jurusan=$this->x_jurusan;
			$semester=$this->input->post('semester');
			$tahun=$this->input->post('tahun');
			$wali=$this->x_wali;
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
			
			if($this->mod_siswa->siswa_add($nisn,$nama,$kelas,$jurusan,$semester,$jk,$tahun,$wali,$tempat,$tgl,$alamat,$anak_ke,$saudara,$ayah,$kerjaayah,$ibu,$kerjaibu)==TRUE)
			{
				set_header_message('success','Tambah Siswa','Berhasil menambah siswa');
				redirect(base_url(akses().'/siswa'));
			}else{
				set_header_message('danger','Tambah Siswa','Gagal menambah siswa');
				redirect(base_url(akses().'/siswa/add'));
			}
			
		}else{
			$meta['judul']="Tambah Siswa";
	        $this->load->view('tema/header',$meta);	        
	        $this->load->view(akses().'/siswa/siswaadd');
	        $this->load->view('tema/footer');
		}
	}
    
    function edit()
    {
		$this->form_validation->set_rules('siswaid','Siswa ID','required');
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
			$kelas=$this->x_kelas;
			$jurusan=$this->x_jurusan;
			$semester=$this->input->post('semester');
			$tahun=$this->input->post('tahun');
			$wali=$this->x_wali;
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
			
			if($this->mod_siswa->siswa_edit($siswaid,$nisn,$nama,$kelas,$jurusan,$semester,$jk,$tahun,$wali,$tempat,$tgl,$alamat,$anak_ke,$saudara,$ayah,$kerjaayah,$ibu,$kerjaibu)==TRUE)
			{
				set_header_message('success','Ubah Siswa','Berhasil mengubah siswa');
				redirect(base_url(akses().'/siswa'));
			}else{
				set_header_message('danger','Ubah Siswa','Gagal mengubah siswa');
				redirect(base_url(akses().'/siswa'));
			}
			
		}else{
			$meta['judul']="Ubah Siswa";
	        $this->load->view('tema/header',$meta);
	        $id=$this->input->get('id');
	        $s=array(
	        'kelas'=>$this->x_kelas,
	        'jurusan'=>$this->x_jurusan,
	        'walikelas_id'=>$this->x_wali,
	        'siswa_id'=>$id,
	        );
	        $d['data']=$this->mod_siswa->siswa_data($s);
	        $this->load->view(akses().'/siswa/siswaedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		if($this->mod_siswa->siswa_delete($id,$this->x_kelas,$this->x_jurusan,$this->x_wali)==TRUE)
		{
			set_header_message('success','Hapus Siswa','Berhasil menghapus siswa');
			redirect(base_url(akses().'/siswa'));
		}else{
			set_header_message('danger','Hapus Siswa','Gagal menghapus siswa');
			redirect(base_url(akses().'/siswa'));
		}
	}
    
}
