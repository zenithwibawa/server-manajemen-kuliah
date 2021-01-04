<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Operator extends RestController {

    function __construct(){
        parent::__construct();
        $this->load->model('Operator_model');
    }

    // REST_Controller::HTTP_OK = 200
    // REST_Controller::HTTP_NOT_FOUND = 404
    // REST_Controller::HTTP_BAD_REQUEST = 400

    public function userdata_get(){
        $email = $this->get('email');

        if ($email == null){
            $this->response( [
                'status' => false,
                'message' => 'Email is required'
            ], 400);
        }
        else {
            $userdata = $this->Operator_model->getOperatorData($email)->row_array();
            if ($userdata == null){
                $this->response( [
                    'status' => false,
                    'message' => 'Account not found'
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

}