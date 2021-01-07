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
        $img = $this->post('img');

        if ($email == null || $password == null || $nama == null || $jk == null || $tgl == null || $id_department == null || $img == null){
            $this->response( [
                'status' => false,
                'message' => 'nama, email, jenis_kelamin, tgl_lahir, id_department, password, img are required'
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
                'img' => $img
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
        $id_user = $this->put('id_user');
        $id_operator = $this->put('id_operator');

        $email = $this->put('email');
        $password = $this->put('password');
        $nama = $this->put('nama');
        $jk = $this->put('jenis_kelamin');
        $tgl = $this->put('tgl_lahir');
        $id_department = $this->put('id_department');
        $img = $this->put('img');

        if ($id_user == null || $id_operator == null || $email == null || $password == null || $nama == null || $jk == null || $tgl == null || $id_department == null || $img == null){
            $this->response( [
                'status' => false,
                'message' => 'id_user, id_operator, nama, email, jenis_kelamin, tgl_lahir, id_department, password, img are required'
            ], 400);
        }
        else {
            $datauser = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $this->Admin_model->updateUserData($id_user, $datauser);
            $dataoperator = [
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'tgl_lahir' => $tgl,
                'id_departemen' => $id_department,
                'img' => $img
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
        $id_user = $this->delete('id_user');
        $id_operator = $this->delete('id_operator');

        if ($id_user == null || $id_operator == null){
            $this->response( [
                'status' => false,
                'message' => 'id_user, id_operator are required'
            ], 400);
        }
        else {
            $user = $this->Admin_model->deleteUserData($id_user);
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

}