<?php 

class Auth_model extends CI_Model{
    
    public function getUser($email){
        return $this->db->get_where('user', ['email' => $email]);
    }

}