<?php

class Home extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("login_model");
		if($this->login_model->isNotLogin()) redirect(site_url('login'));
	}

	public function index()
	{
        // load view karyawan/home.php
        $this->load->view("karyawan/home");
	}
}