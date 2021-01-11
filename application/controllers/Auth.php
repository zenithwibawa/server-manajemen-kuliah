<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController {

    function __construct(){
        parent::__construct();
        $this->load->model('Auth_model');
    }

    // REST_Controller::HTTP_OK = 200
    // REST_Controller::HTTP_NOT_FOUND = 404
    // REST_Controller::HTTP_BAD_REQUEST = 400

    public function login_get(){ // for login check
        $email = $this->get('email');
        $password = $this->get('password');

        $user = $this->Auth_model->getLogin($email)->row_array();
        if ($user == null){
            $this->response( [
                'status' => false,
                'message' => 'account not found'
            ], 404);
        }
        else {
            if ($user['status'] == 0){
                $this->response( [
                    'status' => false,
                    'message' => 'account is not activated'
                ], 400);
            }
            else {
                if (password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];
                    $this->response( [
                        'status' => true,
                        'data' => $data
                    ], 200);
                }
                else {
                    $this->response( [
                        'status' => false,
                        'message' => 'wrong password'
                    ], 400);
                }
            }
        }
    }

    public function checkemail_get(){
        $email = $this->get('email');
        $id_user = $this->get('id_user');

        if ($email == null){
            $this->response( [
                'status' => false,
                'message' => 'email is required'
            ], 400);
        }
        else {
            if ($id_user == null){ // for insert data
                $userdata = $this->Auth_model->checkEmail($email, $id_user=null)->row_array();
                if ($userdata){
                    $this->response( [
                        'status' => false,
                        'message' => 'email already used'
                    ], 400);
                }
                else {
                    $this->response( [
                        'status' => true,
                        'message' => 'email is unique'
                    ], 200);
                }
            }
            else { // for update data
                $userdata = $this->Auth_model->checkEmail($email, $id_user)->row_array();
                if ($userdata['email'] == $email){
                    $this->response( [
                        'status' => true,
                        'message' => 'update same email with the current email'
                    ], 200);
                }
                else {
                    $userdata = $this->Auth_model->checkEmail($email, $id_user=null)->row_array();
                    if ($userdata){
                        $this->response( [
                            'status' => false,
                            'message' => 'email already used'
                        ], 400);
                    }
                    else {
                        $this->response( [
                            'status' => true,
                            'message' => 'email is unique'
                        ], 200);
                    }
                }
            }
        }
    }

}