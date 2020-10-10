<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends CI_Model
{
    private $_table = "users";
    private $_table_data = "dt_karyawan";

    public function doLogin(){
		$post = $this->input->post();
       
        // cari user berdasarkan nik
        $user = $this->db->get_where($this->_table, ["nik" => $post["nik"]])->row();
        $kry = $this->db->get_where($this->_table_data, ["nik" => $post["nik"]])->row();

        $arrdata = array(
                    'nik'       => $kry->nik,
                    'photo'     => $kry->photo,
                    'fullname'  => $kry->fullname,
                    'level'     => $user->level
                );
                
        $this->session->set_userdata($arrdata);

        // jika user terdaftar
        if($user){
            // cek active tidaknya karyawan
            $cek_active = $this->db->get_where($this->_table_data, ["nik" => $post["nik"],"active" => 1])->row();

            if($cek_active)
            {
                // periksa password-nya
                $isPasswordTrue = password_verify($post["password"], $user->password);
                // periksa level-nya
                $isHR   = $user->level == "HR";
                $isNHR  = $user->level == "NHR";

                // jika password benar dan dia HR
                if($isPasswordTrue && $isHR){ 
                    // login sukses yay!
                    $this->session->set_userdata(['user_logged' => $user]);

                    $this->_updateLastLogin($user->nik);

                    if(!empty($post["remember"])) {
                        setcookie ("loginNik", $post["nik"], time()+ (10 * 365 * 24 * 60 * 60));  
                        setcookie ("loginPass", $post["password"],  time()+ (10 * 365 * 24 * 60 * 60));
                    } 
                    else {
                        setcookie ("loginNik",""); 
                        setcookie ("loginPass","");
                    }
                    return true;
                }

                if($isPasswordTrue && $isNHR){ 
                    // login sukses yay!
                    $this->session->set_userdata(['user_logged' => $user]);

                    $this->_updateLastLogin($user->nik);

                    if(!empty($post["remember"])) {
                        setcookie ("loginNik", $post["nik"], time()+ (10 * 365 * 24 * 60 * 60));  
                        setcookie ("loginPass", $post["password"],  time()+ (10 * 365 * 24 * 60 * 60));
                    } 
                    else {
                        setcookie ("loginNik",""); 
                        setcookie ("loginPass","");
                    }
                    return true;
                }
            }
        }
        // login gagal
		return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($nik){
        $sql = "UPDATE {$this->_table} SET last=now() WHERE nik={$nik}";
        $this->db->query($sql);
    }

}

?>