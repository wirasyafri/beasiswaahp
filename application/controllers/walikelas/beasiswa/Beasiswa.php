<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Beasiswa extends CI_Controller
{
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
    }
    
    function index()
    {
        $meta['judul']="Semua Beasiswa";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_bea->beasiswa_data();
        $this->load->view(akses().'/beasiswa/beasiswa/beasiswaview',$d);
        $this->load->view('tema/footer');
    }
    
}
