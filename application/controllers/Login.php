<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();            
        $this->load->library('form_validation');
        $this->load->library('m_db');
    }
    
    function index()
    {
    	// $this->load->view('asda');
    	echo "</pre>";
    	//print_r($_POST);
    	$this->form_validation->set_rules('username','Username','required');
    	$this->form_validation->set_rules('password','Password','required');
    	if($this->form_validation->run()==TRUE)
    	{
			$s=array(
			'username'=>$this->input->post('username'),
			);
			if($this->m_db->is_bof('pengguna',$s)==FALSE)
			{
				
				$s2=array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				);
				if($this->m_db->is_bof('pengguna',$s2)==FALSE)
				{
					
					$akses=$this->m_db->get_row('pengguna',$s2,'akses');
					$userid=$this->m_db->get_row('pengguna',$s2,'user_id');
					$this->session->set_userdata('infouser',array(
							'userid'=>$userid,
							'username'=>$this->input->post('username'),
							'akses'=>$akses,
					));
					echo $akses;
					echo base_url();
					redirect(base_url().$akses.'/Dashboard');		
					// redirect($akses.'/Dashboard')								;
				}else{
					echo "salah";
					redirect(base_url());
				}
			}else{
					echo "salah";
				
				redirect(base_url());
			}
		}else{
			$meta['judul']="User s";
	        $this->load->view('tema/loginview',$meta);
		}        
    }
    
    function logout()
    {
		$this->session->unset_userdata('infouser');
		redirect(base_url());
	}
    
}
