<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa_model extends CI_Model
{
	private $tb_siswa='siswa';
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function siswa_data($where=array(),$order="nama ASC")
    {
		$d=$this->m_db->get_data($this->tb_siswa,$where,$order);
		return $d;
	}
	
	function siswa_info($siswaID,$output)
	{
		$s=array(
		'siswa_id'=>$siswaID,
		);
		$item=$this->m_db->get_row($this->tb_siswa,$s,$output);
		return $item;
	}
	
	function siswa_add($nisn,$nama,$kelas,$jurusan,$semester,$jk,$tahun,$wali_kelas,$tmp_lahir,$tgl_lahir,$alamat='',$anak_ke='',$saudara='',$nama_ayah='',$kerja_ayah='',$nama_ibu='',$kerja_ibu='')
	{
		$s=array(
		'nisn'=>$nisn,
		);
		if($this->m_db->is_bof($this->tb_siswa,$s)==TRUE)
		{
			if($this->m_db->is_bof('pengguna',array('username'=>$nisn))==TRUE)
			{
				
			
			$dUser=array(
			'nama'=>$nama,
			'username'=>$nisn,
			'password'=>md5($nisn),
			'akses'=>'siswa',
			);
			if($this->m_db->add_row('pengguna',$dUser)==TRUE)
			{
				$user_id=$this->m_db->last_insert_id();
				$d=array(
				'nisn'=>$nisn,
				'nama'=>$nama,
				'kelas'=>$kelas,
				'jurusan'=>$jurusan,
				'semester'=>$semester,
				'jenkel'=>$jk,
				'tahun'=>$tahun,
				'walikelas_id'=>$wali_kelas,
				'user_id'=>$user_id,
				'tempat_lahir'=>$tmp_lahir,
				'tgl_lahir'=>$tgl_lahir,
				'alamat'=>$alamat,
				'anak_ke'=>$anak_ke,
				'saudara'=>$saudara,
				'nama_ayah'=>$nama_ayah,
				'pekerjaan_ayah'=>$kerja_ayah,
				'nama_ibu'=>$nama_ibu,
				'pekerjaan_ibu'=>$kerja_ibu,
				);
				if($this->m_db->add_row($this->tb_siswa,$d)==TRUE)
				{
					return true;
				}else{
					$this->m_db->delete_row('pengguna',array('user_id'=>$user_id));
					return false;
				}
			}else{
				return false;
			}
			
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function siswa_edit($siswaID,$nisn,$nama,$kelas,$jurusan,$semester,$jk,$tahun,$wali_kelas,$tmp_lahir,$tgl_lahir,$alamat='',$anak_ke='',$saudara='',$nama_ayah='',$kerja_ayah='',$nama_ibu='',$kerja_ibu='')
	{
		$s=array(
		'nisn'=>$nisn,
		);
		$sSiswa=array(
		'siswa_id'=>$siswaID,
		);
		$c=$this->m_db->count_data($this->tb_siswa,$s);
		if($c < 2)
		{
			if($this->m_db->is_bof('siswa',$sSiswa)==FALSE)
			{
				
			$userID=$this->m_db->get_row('siswa',$sSiswa,'user_id');
			if($this->m_db->is_bof('pengguna',array('username'=>$nisn))==FALSE)
			{
				
			
			$dUser=array(
			'nama'=>$nama,
			'username'=>$nisn,
			'akses'=>'siswa',
			);
			$sUser=array(
			'user_id'=>$userID,
			);
			if($this->m_db->edit_row('pengguna',$dUser,$sUser)==TRUE)
			{				
				$d=array(
				'nisn'=>$nisn,
				'nama'=>$nama,
				'kelas'=>$kelas,
				'jurusan'=>$jurusan,
				'semester'=>$semester,
				'jenkel'=>$jk,
				'tahun'=>$tahun,
				'walikelas_id'=>$wali_kelas,
				'tempat_lahir'=>$tmp_lahir,
				'tgl_lahir'=>$tgl_lahir,
				'alamat'=>$alamat,
				'anak_ke'=>$anak_ke,
				'saudara'=>$saudara,
				'nama_ayah'=>$nama_ayah,
				'pekerjaan_ayah'=>$kerja_ayah,
				'nama_ibu'=>$nama_ibu,
				'pekerjaan_ibu'=>$kerja_ibu,
				);
				if($this->m_db->edit_row($this->tb_siswa,$d,$sSiswa)==TRUE)
				{
					return true;
				}else{					
					return false;
				}
			}else{
				return false;
			}
			
			}else{
				return false;
			}
			
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function siswa_edit_siswa($siswaID,$nisn,$nama,$jk,$tahun,$tmp_lahir,$tgl_lahir,$alamat='',$anak_ke='',$saudara='',$nama_ayah='',$kerja_ayah='',$nama_ibu='',$kerja_ibu='')
	{		
		$sSiswa=array(
		'siswa_id'=>$siswaID,
		);
					
		$d=array(
		'nisn'=>$nisn,
		'nama'=>$nama,
		'jenkel'=>$jk,
		'tahun'=>$tahun,
		'tempat_lahir'=>$tmp_lahir,
		'tgl_lahir'=>$tgl_lahir,
		'alamat'=>$alamat,
		'anak_ke'=>$anak_ke,
		'saudara'=>$saudara,
		'nama_ayah'=>$nama_ayah,
		'pekerjaan_ayah'=>$kerja_ayah,
		'nama_ibu'=>$nama_ibu,
		'pekerjaan_ibu'=>$kerja_ibu,
		);
		if($this->m_db->edit_row($this->tb_siswa,$d,$sSiswa)==TRUE)
		{
			return true;
		}else{					
			return false;
		}
	}
	
	function siswa_delete($siswaID,$kelas,$jurusan,$wali)
	{
		$s=array(
        'kelas'=>$kelas,
        'jurusan'=>$jurusan,
        'walikelas_id'=>$wali,
        'siswa_id'=>$siswaID,
        );
        $userid=$this->m_db->get_row('siswa',$s,'user_id');
        if($this->m_db->delete_row('siswa',$s)==TRUE)
        {
        	$this->m_db->delete_row('pengguna',array('user_id'=>$userid));
			return true;
		}else{
			return false;
		}
	}
}