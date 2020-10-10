<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_model extends CI_Model
{
    private $_table = "dt_karyawan";


    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getByNik($nik)
    {
        return $this->db->get_where($this->_table, ["nik" => $nik])->row();
    }

    public function getSearch()
    {
        $keyword = $this->input->get('keyword');

        $this->db->like('nik', $keyword);
        $this->db->or_like('fullname', $keyword);
        $this->db->or_like('department', $keyword);
        
        return $this->db->get($this->_table)->result();
    }

    public function rules()
    {
        return [
            ['field' => 'nik',
            'label' => 'Nik',
            'rules' => 'required'],

            ['field' => 'fullname',
            'label' => 'Full Name',
            'rules' => 'required'],
            
            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required'],

            ['field' => 'phone',
            'label' => 'Phone',
            'rules' => 'required'],

            ['field' => 'department',
            'label' => 'Department',
            'rules' => 'required'],

            ['field' => 'position',
            'label' => 'Position',
            'rules' => 'required']
        ];
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nik          = $post["nik"];
        $this->photo        = $this->_uploadPhoto();
        $this->fullname     = $post["fullname"];
        $this->gender       = $post["gender"];
        $this->religion     = $post["religion"];
        $this->address      = $post["address"];
        $this->email        = $post["email"];
        $this->phone        = $post["phone"];
        $this->department   = $post["department"];
        $this->position     = $post["position"];
        $this->active       = $post["active"];
        return $this->db->insert($this->_table, $this);
    }
 
    private function _uploadPhoto()
    {
        $config['upload_path']          = './img/karyawan/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $this->input->post('nik');
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            return $this->upload->data("file_name");
        }
        
        return "no_image.png";
    }

    public function update()
    {
        $post = $this->input->post();

        if (!empty($_FILES["photo"]["name"])) 
        {
            $this-> _deletePhoto($this->input->post('nik'));
            $this->photo = $this->_uploadPhoto();
        } 
        else 
        {
            $this->photo = $post["old_image"];
        }
        $this->fullname     = $post["fullname"];
        $this->gender       = $post["gender"];
        $this->religion     = $post["religion"];
        $this->address      = $post["address"];
        $this->email        = $post["email"];
        $this->phone        = $post["phone"];
        $this->department   = $post["department"];
        $this->position     = $post["position"];

        return $this->db->update($this->_table, $this, array('nik' => $this->input->post('nik')));
    }

    private function _deletePhoto($nik)
    {
        $manage = $this->getByNik($nik);
        if ($manage->photo != "no_image.png") {
            $filename = explode(".", $manage->photo)[0];
            return array_map('unlink', glob(FCPATH."img/karyawan/$filename.*"));
        }
    }

    public function delete($nik)
    {
        $this-> _deletePhoto($nik);
        return $this->db->delete($this->_table, array("nik" => $nik));
    }
         
}
?>