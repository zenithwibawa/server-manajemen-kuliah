<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Admin extends RestController {

    function __construct(){
        parent::__construct();
        $this->load->model('Admin_model');
    }

    // REST_Controller::HTTP_OK = 200
    // REST_Controller::HTTP_NOT_FOUND = 404
    // REST_Controller::HTTP_BAD_REQUEST = 400

    public function userdata_get(){
        $email = $this->get('email');

        if ($email == null){
            $this->response( [
                'status' => false,
                'message' => 'email is required'
            ], 400);
        }
        else {
            $userdata = $this->Admin_model->getAdminData($email)->row_array();
            if ($userdata == null){
                $this->response( [
                    'status' => false,
                    'message' => 'account not found'
                ], 404);
            }
            else {
                $this->response( [
                    'status' => true,
                    'data' => $userdata
                ], 200);
            }
        }
    }

    public function operatordata_get(){
        $id = $this->get('id_operator');

        if ($id == null){
            $operatordata = $this->Admin_model->getOperatorData()->result_array();
        }
        else {
            $operatordata = $this->Admin_model->getOperatorData($id)->row_array();
        }

        if ($operatordata == null){
            $this->response( [
                'status' => false,
                'message' => 'operator not found'
            ], 404);
        }
        else {
            $this->response( [
                'status' => true,
                'data' => $operatordata
            ], 200);
        }
    }

    public function operatordata_post(){
        $email = $this->post('email');
        $password = $this->post('password');
        $nama = $this->post('nama');
        $jk = $this->post('jenis_kelamin');
        $tgl = $this->post('tgl_lahir');
        $id_department = $this->post('id_department');

        if ($email == null || $password == null || $nama == null || $jk == null || $tgl == null || $id_department == null){
            $this->response( [
                'status' => false,
                'message' => 'nama, email, jenis_kelamin, tgl_lahir, id_department, password are required'
            ], 400);
        }
        else {
            $datauser = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 'Operator',
                'date_created' => date('d-m-Y H:i:s'),
                'status' => 1 // should be 0 before activation
            ];
            $this->Admin_model->addUserData($datauser);
            $id = $this->Admin_model->getUserData($email)->row_array();
            $dataoperator = [
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'tgl_lahir' => $tgl,
                'id_departemen' => $id_department,
                'id_user' => $id['id_user'],
                'img' => 'http://localhost/server-manajemen-kuliah/assets/img/user.png'
            ];
            $insert = $this->Admin_model->addOperatorData($dataoperator);
            if ($insert){
                $this->response( [
                    'status' => true,
                    'message' => 'data user & operator successfuly added'
                ], 200);
            }
            else {
                $this->response( [
                    'status' => false,
                    'message' => 'data failed to added'
                ], 400);
            }
        }
    }

    public function operatordata_put(){
        $id_operator = $this->put('id_operator');

        $email = $this->put('email');
        $password = $this->put('password');
        $nama = $this->put('nama');
        $jk = $this->put('jenis_kelamin');
        $tgl = $this->put('tgl_lahir');
        $id_department = $this->put('id_department');

        if ($id_operator == null || $email == null || $password == null || $nama == null || $jk == null || $tgl == null || $id_department == null){
            $this->response( [
                'status' => false,
                'message' => 'id_operator, nama, email, jenis_kelamin, tgl_lahir, id_department, password are required'
            ], 400);
        }
        else {
            $id_user = $this->Admin_model->getOperatorData($id_operator)->row_array();
            $datauser = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $this->Admin_model->updateUserData($id_user['id_user'], $datauser);
            $dataoperator = [
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'tgl_lahir' => $tgl,
                'id_departemen' => $id_department
            ];
            $insert = $this->Admin_model->updateOperatorData($id_operator, $dataoperator);
            if ($insert){
                $this->response( [
                    'status' => true,
                    'message' => 'data user & operator successfuly updated'
                ], 200);
            }
            else {
                $this->response( [
                    'status' => false,
                    'message' => 'data failed to updated'
                ], 400);
            }
        }
    }

    public function operatordata_delete(){
        $id_operator = $this->delete('id_operator');

        if ($id_operator == null){
            $this->response( [
                'status' => false,
                'message' => 'id_operator is required'
            ], 400);
        }
        else {
            $id_user = $this->Admin_model->getOperatorData($id_operator)->row_array();
            $user = $this->Admin_model->deleteUserData($id_user['id_user']);
            $operator = $this->Admin_model->deleteOperatorData($id_operator);
            if ($user && $operator){
                $this->response( [
                    'status' => true,
                    'message' => 'data user & operator successfuly deleted'
                ], 200);
            }
            else {
                $this->response( [
                    'status' => false,
                    'message' => 'data failed to deleted'
                ], 400);
            }
        }
    }

    public function department_get(){
        $id_department = $this->get('id_department');

        if ($id_department == null){
            $departmentdata = $this->Admin_model->getDepartmentData()->result_array();
        }
        else {
            $departmentdata = $this->Admin_model->getDepartmentData($id_department)->row_array();
        }
        
        if ($departmentdata == null){
            $this->response( [
                'status' => false,
                'message' => 'department not found'
            ], 404);
        }
        else {
            $this->response( [
                'status' => true,
                'data' => $departmentdata
            ], 200);
        }
    }

}