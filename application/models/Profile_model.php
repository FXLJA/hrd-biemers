<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    private $_table_data = "dt_karyawan";

    public function getByNik()
    {   
        $nik = $_SESSION['nik'];
        return $this->db->get_where($this->_table_data, ["nik" => $nik])->row();
    }
}
?>