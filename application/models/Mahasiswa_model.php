<?php 

class Mahasiswa_model extends CI_Model {

    public function getMahasiswaData($email){
        $this->db->select('a.*, b.*');
        $this->db->from('user a, mhs b');
        $this->db->where('a.id_user = b.id_user');
        $this->db->where('a.email = "'.$email.'"');
        return $this->db->get();
    }

}