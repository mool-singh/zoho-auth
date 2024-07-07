<?php

use GuzzleHttp\Client;

class Zoho extends MY_Controller {
    public function __construct() {
        parent::__construct();
		$this->auth_check();
        $this->load->model('Zoho_model','zoho_model');
        $this->load->library('Zohobooks');
    }

    //  request for new refresh
    public function requestToken()
    {
        $token_data = $this->zoho_model->getToken();
       
        if(empty($token_data) || empty($token_data['refresh_token']))
        {   
                $url = ZOHO_ACCOUNT_URL.'oauth/v2/auth';
            
                $params = [
                    'response_type' => 'code',
                    'client_id' => ZOHO_CLIENT_ID,
                    'scope' => 'ZohoBooks.invoices.READ,ZohoBooks.contacts.READ,ZohoBooks.expenses.READ',
                    'redirect_uri' => base_url(ZOHO_REDIRECT_URI),
                    'prompt' => 'consent'
                ];
        
                $url = $url . '?' . http_build_query($params);

               

                $this->load->view('includes/header',);
                $this->load->view('zoho/token',compact('url'));
                $this->load->view('includes/footer', []);

        }
        elseif(is_access_token_expired($token_data['updated_at']) || empty($token_data['access_token']))
        {
            $result =   $this->accessToken($token_data['refresh_token']);

            if($result)
            {
                $this->session->set_flashdata('success', "Authorization complete. You can now access and fetch data.");
            
			    return redirect(base_url('dashboard'));
            }
            else
            {
                $data = ['access_token' => '','refresh_token' =>'','updated_at' =>null];
                $this->zoho_model->saveToken($data);
                $this->session->set_flashdata('error', "Refresh token expired, Please grant permission again.");
                return redirect(base_url('request-token'));
            }
           
        }
        else
        {
            $this->session->set_flashdata('error', "Invalid request");
            return redirect(base_url('dashboard'));
        }
        
    }

 
    // Auth redirect uri; Capture save token and generate access token based on that
    public function captureRefreshToken()
    {   
       
        $code = $this->input->get('code');

       if(empty($code))
       {
            $this->session->set_flashdata('error', "The authorization request was not accepted or was incorrect. Please give it another go");
			return redirect(base_url('request-token'));
       }
       else
       {     
            $data = ['refresh_token' => $code];
            $this->zoho_model->saveToken($data);

           $access_code =  $this->accessToken($code);
           
           if($access_code)
           {
                $this->session->set_flashdata('success', "Authorization complete. You can now access and fetch data.");
                return redirect(base_url('dashboard'));
           }
           else
           {
                $this->session->set_flashdata('error', "An error occurred while generating the access code. Please try again.n");
                return redirect(base_url('request-token'));
           }
       }
    }


    private function accessToken($code) {

        $client = new Client();

        try {
            $response = $client->request('POST', ZOHO_ACCOUNT_URL.'oauth/v2/token', [
                'form_params' => [
                    'code' => $code,
                    'client_id' => ZOHO_CLIENT_ID,
                    'client_secret' => ZOHO_CLIENT_SECRET,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => base_url(ZOHO_REDIRECT_URI)
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $access_token = $data['access_token'];

            if(empty($access_token))
            {
                return 0;
            }

            $token_data = ['access_token' => $access_token,'updated_at' => date('Y-m-d H:i:s')];
            
            $this->zoho_model->saveToken($token_data);
           
            return 1;
            
        } catch (\Throwable $th) {
            return 0;
        }


        
    }

}



?>