<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
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
    }
    
    function index()
    {
        $meta['judul']="Dashboard Wali Kelas";
        $this->load->view('tema/header',$meta);
        $this->load->view(akses().'/dashboardview');
        $this->load->view('tema/footer');
    }
    
}
