<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
    }

    public function auth_check() {
        if (!$this->session->userdata('id')) {
            redirect('login');
        }
    }
}
