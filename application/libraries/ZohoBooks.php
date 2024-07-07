<?php

use GuzzleHttp\Client;

class ZohoBooks {
    private $client;
    private $access_token;
    private $refresh_token;
    private $token_time;
    private $CI; 

    public function __construct() {
        $this->client = new Client();
        $this->CI =& get_instance(); 

        $this->loadTokensFromDatabase();
    }

 
    private function loadTokensFromDatabase()
    {
        // Load tokens securely from database
        $query = $this->CI->db->get_where('zoho_tokens', array('id' => 1)); 
        $row = $query->row();
        if ($row) {
            $this->access_token = $row->access_token;
            $this->refresh_token = $row->refresh_token;
            $this->token_time = $row->updated_at;
        }
    }

    

    public function isTokenExpired() {
        return empty($this->refresh_token) || empty($this->access_token) || is_access_token_expired($this->token_time);
    }

    private function request($method, $url, $params = [])
    {
        try {

            $response = $this->client->request($method, $url, [
                'query' => array_merge($params, ['organization_id' => ZOHO_ORG_ID]),
                'headers' => ['Authorization' => 'Zoho-oauthtoken ' . $this->access_token,
                             'X-Com-Zoho-Invoice-Organizationid' => ZOHO_ORG_ID
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return 0;
        }
    }

   
    public function getInvoices()
    {
        $page = 1;
        $perPage = 200; 
        $allInvoices = [];

        while (true) {

            // Fetch invoices for the current page
            $response = $this->request('GET', "https://www.zohoapis.in/books/v3/invoices", [
                'page' => $page,
                'per_page' => $perPage
            ]);

            if(!$response)
            {
                return 0;
            }

            
    
            // Check if invoices are returned
            if (empty($response['invoices'])) {
                break;
            }
    
            // Merge the fetched invoices with the existing list
            $allInvoices = array_merge($allInvoices, $response['invoices']);
    
            // Increment the page number for the next iteration
            $page++;
        }
    
        return $allInvoices;
    }

    public function getInvoice($invoice_id)
    {
        $response = $this->request('GET', "https://www.zohoapis.in/books/v3/invoices/".$invoice_id);

        return $response;
    }

    public function getCustomers() {
        return $this->request('GET', "https://www.zohoapis.com/crm/v2/contacts");
    }

    public function getExpenses() {
        return $this->request('GET', "https://www.zohoapis.com/crm/v2/expenses");
    }

}

?>