<?php 

class Operator_model extends CI_Model {

    public function getOperatorData($email){
        $this->db->select('a.*, b.*');
        $this->db->from('user a, operator b');
        $this->db->where('a.id_user = b.id_user');
        $this->db->where('a.email = "'.$email.'"');
        return $this->db->get();
    }

}