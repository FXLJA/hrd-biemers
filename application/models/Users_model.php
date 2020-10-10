<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	private $_table = "users";
	private $_table_karyawan = "dt_karyawan";

    public function getAll()
    {
        $this->db->select('users.*, dt_karyawan.active');
        $this->db->from('users');
        $this->db->join('dt_karyawan', 'users.nik = dt_karyawan.nik');
        return $this->db->get()->result();
    }

    public function getAllNik()
    {
        $this->db->select('dt_karyawan.nik');
        $this->db->from('dt_karyawan');
        $this->db->join('users', 'dt_karyawan.nik = users.nik', 'left');
        $this->db->where('users.nik', NULL);
        return $this->db->get()->result();
    }

    public function getByNik($nik)
    {
        $this->db->select('users.*, dt_karyawan.active');
        $this->db->from('users');
        $this->db->join('dt_karyawan', 'users.nik = dt_karyawan.nik');
        $this->db->where('users.nik', $nik);
        return $this->db->get()->row();
    }
    
    public function getSearch()
    {
        $keyword = $this->input->get('keyword');

        $this->db->select('users.*, dt_karyawan.active');
        $this->db->from('users');
        $this->db->join('dt_karyawan', 'users.nik = dt_karyawan.nik');
        $this->db->like('users.nik', $keyword);
        
        return $this->db->get()->result();
    }

    public function rules()
    {
        return [
            ['field' => 'nik',
            'label' => 'Nik',
            'rules' => 'required'],
            
            ['field' => 'level',
            'label' => 'Level',
            'rules' => 'required']
        ];
    }

    public function save()
    {
        $post = $this->input->post();

        $this->nik          = $post["nik"];
        $this->password     = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->level 	    = $post["level"];

		$this->db->update($this->_table_karyawan, array('active'=>1), array('nik' => $this->input->post('nik')));
 		 		
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        $this->level     	= $post["level"];

        $this->db->update($this->_table_karyawan, array('active'=>$this->input->post('active')), 
        	array('nik' => $this->input->post('nik')));

        return $this->db->update($this->_table, $this, array('nik' => $this->input->post('nik')));
    }

    public function delete($nik)
    {
        $this->db->update($this->_table_karyawan, array('active'=>0), array('nik' => $nik));
        return $this->db->delete($this->_table, array("nik" => $nik));
    }

}
?>