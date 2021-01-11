<?php 

class Auth_model extends CI_Model {
    
    public function getLogin($email){
        return $this->db->get_where('user', ['email' => $email]);
    }

    public function checkEmail($email, $id_user=null){
        if ($id_user == null){
            return $this->db->get_where('user', ['email' => $email]);
        }
        else {
            return $this->db->get_where('user', ['id_user' => $id_user]);
        }
    }
    
}