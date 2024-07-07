<?php

	class Zoho_model extends CI_Model
	{
		

		public function saveToken($data)
		{

			$this->db->from('zoho_tokens');
			$query = $this->db->get();
			$result =  $query->row_array();

			if(empty($result))
			{
				$this->db->insert('zoho_tokens',$data);
				return true;
			}
			else
			{
				$this->db->where('id', $result['id']);
				$this->db->update('zoho_tokens', $data);
			}
			
		}

		public function getToken()
		{
			$this->db->from('zoho_tokens');
			$query = $this->db->get();
			return $query->row_array();
		}


	}

?>