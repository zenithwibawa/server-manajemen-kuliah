<?php 

class Admin_model extends CI_Model {
    
    public function getAdminData($email){ // especially for admin only
        return $this->db->get_where('user', ['email' => $email, 'role' => 'Admin']);
    }

    public function getOperatorData($id=null){
        if ($id == null) {
            $this->db->from('user a, operator b, departemen c');
            $this->db->where('a.id_user = b.id_user');
            $this->db->where('b.id_departemen = c.id_departemen');
            $this->db->group_by('id_operator');
            return $this->db->get();
        }
        else {
            $this->db->from('user a, operator b, departemen c');
            $this->db->where('a.id_user = b.id_user');
            $this->db->where('b.id_departemen = c.id_departemen');
            $this->db->where('b.id_operator = '.$id.'');
            return $this->db->get();
        }
    }

    public function getUserData($email){
        return $this->db->get_where('user', ['email' => $email]);
    }

    public function addUserData($datauser){
        return $this->db->insert('user', $datauser);
    }

    public function addOperatorData($dataoperator){
        return $this->db->insert('operator', $dataoperator);
    }

    public function updateUserData($id_user, $datauser){
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $datauser);
    }

    public function updateOperatorData($id_operator, $dataoperator){
        $this->db->where('id_operator', $id_operator);
        return $this->db->update('operator', $dataoperator);
    }

    public function deleteUserData($id_user){
        $this->db->where('id_user', $id_user);
        return $this->db->delete('user');
    }

    public function deleteOperatorData($id_operator){
        $this->db->where('id_operator', $id_operator);
        return $this->db->delete('operator');
    }

    public function getDepartmentData($id_department=null){
        if ($id_department == null){
            $this->db->group_by('fakultas');
            return $this->db->get('departemen');
        }
        else {
            return $this->db->get_where('departemen', ['id_departemen' => $id_department]);
        }
    }
    
}