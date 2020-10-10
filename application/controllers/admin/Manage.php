<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("manage_model");
    }

    public function index()
    {
        $data["manage"] = $this->manage_model->getAll();
        $this->load->view("admin/manage/data_karyawan", $data);
    }

    public function search()
    {
    	$data["manage"] = $this->manage_model->getSearch();
        $this->load->view("admin/manage/data_karyawan", $data);
    }

    public function add()
    {
    	$manage = $this->manage_model;
        $validation = $this->form_validation;
        $validation->set_rules($manage->rules());

        if ($validation->run()) {
            $manage->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
    	$this->load->view('admin/manage/new_karyawan');
    }

    public function edit($nik = null)
    {
        if (!isset($nik)) redirect('admin/manage');
       
        $manage = $this->manage_model;
        $validation = $this->form_validation;
        $validation->set_rules($manage->rules());
        
        if ($validation->run()) {
            $manage->update();
            $this->session->set_flashdata('success', 'Berhasil update');
        }

        $data["manage"] = $manage->getByNik($nik);
        if (!$data["manage"]) show_404();
        
        $this->load->view("admin/manage/edit_karyawan", $data);
    }

  	public function delete($nik=null)
    {
        if (!isset($nik)) show_404();
        
        if ($this->manage_model->delete($nik)) {
            redirect(site_url('admin/manage'));
        }
    }
}
?>