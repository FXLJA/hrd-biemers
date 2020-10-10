<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
    }

    public function index()
    {
        // jika form login disubmit
        if($this->input->post()){
            if($this->login_model->doLogin())
            {
                if($_SESSION['level']=='HR')
                {
                    redirect(site_url('admin'));    
                }
                if($_SESSION['level']=='NHR')
                {
                    redirect(site_url('karyawan'));    
                }  
            } 
        }

        // tampilkan halaman login
        $this->load->view("login_page.php");
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
}
?>