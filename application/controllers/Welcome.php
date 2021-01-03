<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Welcome extends RestController {

    function __construct(){
        parent::__construct();
    }

    public function index_get(){
        $this->response( [
            'status' => true,
        ], 200);
    }

}