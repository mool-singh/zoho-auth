<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

	public function login()
	{
		$user_id = (int) $this->session->userdata('id');

		if($user_id)
		{
			return redirect(base_url('dashboard'));
		}

		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$errors = $this->form_validation->error_array();
				
				echo json_encode(['status' => 0,'errors' =>$errors,'msg' => 'Form validation failed, Please check your data']);
				die;
			}
			else
			{

				$errors = [];

				$this->load->model('auth_model', 'auth_model');

				$email = $this->input->post('email');

				$result = $this->auth_model->emailExists($email);

			

				if(empty($result))
				{
					$errors['email'] = "Sorry, we couldn't find an account associated with that email address. Please double-check your email or sign up for a new account.";
				}
				elseif(!password_verify($this->input->post('password'),$result['password']))
				{
					$errors['password'] = "The password you entered is incorrect";
				}
				elseif($result['status'] == 0)
				{
					$errors['email'] = "Your account has been banned or restricted. Please contact support for further assistance.";
				}
				else
				{
					$this->session->set_userdata('id', $result['id']);
					$this->session->set_userdata('name', $result['name']);
					$this->session->set_userdata('mobile', $result['mobile']);
					$this->session->set_userdata('email', $result['email']);

					echo json_encode(['status' => 1,'msg' => "Welcome back! You've successfully logged in. We're glad to have you here!"]);
					die;
				}

				
				echo json_encode(['status' => 0,'errors' =>$errors,'msg' => 'Unable to login, Please check your information']);
				die;
				
			}
			
		}

		$this->load->view('includes/auth/header', []);
        $this->load->view('auth/login');
        $this->load->view('includes/auth/footer', []);
	}

	public function logout()
	{
		$this->auth_check();

	
		$data =['id','name','email','mobile'];
		$this->session->unset_userdata($data);

		$this->session->set_flashdata('success', "You have been successfully logged out.");
		return redirect(base_url('login'));

	}

}
