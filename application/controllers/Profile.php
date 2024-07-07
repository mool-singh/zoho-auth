<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->auth_check();
        $this->load->model('Zoho_model','zoho_model');
        $this->load->model('Invoice_model','invoice_model');
    }

	public function dashboard()
	{
		
		$invoices = $this->invoice_model->totalInvoices();
		$token_data = $this->zoho_model->getToken();

		$token_status = !empty($token_data) || empty($token_data['access_token']) || empty($token_data['access_token']) || is_access_token_expired($token_data['updated_at']) ? 0 :1;

		$name =  $this->session->userdata('name');


		
		$title = "Dashboard";
		
		$this->load->view('includes/header', compact('title'));
        $this->load->view('profile/dashboard',compact('title','name','token_status','invoices'));
        $this->load->view('includes/footer', []);
	}
	
	

}
