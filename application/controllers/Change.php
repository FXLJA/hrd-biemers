<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Change extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("change_model");
    }

    public function index()
    {
        $data["change"] = $this->change_model->getByNik();
        $this->load->view("change_password_page", $data);
    }

    public function update()
    {
        $nik = $this->input->post('nik');
        if (!isset($nik)) redirect('change');
       
        $change = $this->change_model;
        $validation = $this->form_validation;
        $validation->set_rules($change->rules());

        if ($validation->run()) {
            $change->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["change"] = $change->getByNik($nik);
        if (!$data["change"]) show_404();
        
        $this->load->view("change_password_page", $data);
    }
}
?>