<?php 

class Admin_model extends CI_Model {
    
    public function getAdminData($email){ // especially for admin only
        return $this->db->get_where('user', ['email' => $email, 'role' => 'Admin']);
    }

}