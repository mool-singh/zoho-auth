<?php

class Invoice_model extends CI_Model {
    public function save($data) {
        $this->db->insert('invoices', $data);
    }

    public function get_all()
    {
        $wh =array();


        $SQL ='SELECT * FROM invoices ';

        if(!empty($_GET['search']['value'])){

            $searchable = ['invoices.customer_name','invoices.invoice_no','invoices.customer_name','invoices.total_amount','invoices.services'];

            if(!empty($searchable))
            {
                $search_string = '';

                foreach($searchable as $key =>  $search_column)
                {
                    if($key > 0)
                    {
                        $search_string .=" OR ";
                    }
                    $search_string .= $search_column." like '%".$_GET['search']['value']."%'";
                }

                $wh[] = $search_string;
            }
        }	

        if(count($wh)>0)
        {
            $WHERE = implode(' and ',$wh);
            
            return $this->datatable->LoadJson($SQL,$WHERE,'','OR');
        }
        else
        {
            return $this->datatable->LoadJson($SQL);
        }

    }

    public function insertInvoices($invoices)
    {
        if(!empty($invoices))
        {
            $chunks = array_chunk($invoices,1000);

            foreach($chunks as $chunk)
            {
                $this->db->insert_batch('invoices', $chunk);
            }
        }
    }

    public function updateInvoices($invoices)
    {
        if(!empty($invoices))
        {
            $chunks = array_chunk($invoices,1000);

            foreach($chunks as $chunk)
            {
                $this->db->update_batch('invoices', $chunk,'zoho_invoice_id');
            }
        }
    }

    public function isExists($invoice_id)
    {
         $exists = $this->db->where('zoho_invoice_id', $invoice_id)->get('invoices')->row_array();

         return $exists;
    }


    public function get_invoice($invoice_id)
    {
        $exists = $this->db->where('id', $invoice_id)->get('invoices')->row_array();

        return $exists;
    }

    public function totalInvoices()
    {
        return $this->db->count_all('invoices');
    }
    
}

?>