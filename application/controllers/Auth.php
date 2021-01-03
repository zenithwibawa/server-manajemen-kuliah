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
    public function user_get(){
        $email = $this->get('email');
        $password = $this->get('password');

        $user = $this->Auth_model->getUser($email)->row_array();
        if ($user == null){
            $this->response( [
                'status' => false,
                'message' => 'Account not found'
            ], 404);
        }
        else {
            if ($user['status'] == 0){
                $this->response( [
                    'status' => false,
                    'message' => 'Account is not activated'
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
                        'message' => 'Wrong password'
                    ], 400);
                }
            }
        }
    }

    // public function test_post(){
    //     $data = [
    //         'password' => password_hash('mhs', PASSWORD_DEFAULT)
    //     ];
    //     $this->db->update('user', $data, array('id_user' => 3));
    // }

}