<?php 

class Auth_model extends CI_Model {
    
    public function getLogin($email){
        return $this->db->get_where('user', ['email' => $email]);
    }

}