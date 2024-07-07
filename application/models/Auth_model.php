<?php

	class Auth_model extends CI_Model
	{
		public function emailExists($email,$id=0)
		{
			$this->db->from('users');
            $this->db->where('email',strtolower(trim($email)));

			if($id)
			{
				$this->db->where('id !=',$id);
			}

			$query = $this->db->get();

			return $query->row_array();
		}

		public function mobileExists($mobile,$id=0)
		{
			$this->db->from('users');
            $this->db->where('mobile',$mobile);

			if($id)
			{
				$this->db->where('id !=',$id);
			}

			$query = $this->db->get();

			return $query->row_array();
		}

		public function register($data)
		{
			$this->db->insert('users',$data);
			return true;
		}

		public function login($data)
		{
			$this->db->from('users');
            $this->db->where('email',$data['email']);
            $this->db->where('password',$data['password']);

			$query = $this->db->get();

			return $query->row_array();
		}

		public function verifyEmail($token)
		{
			$this->db->where('token', $token);
			$this->db->update('users', ['token' => '','email_verified_at' => date('Y-m-d H:i:s')]);
			return true;
		}

		public function userByToken($token)
		{
			$this->db->from('users');
            $this->db->where('token',$token);

			$query = $this->db->get();

			return $query->row_array();
		}

		public function generateNewToken($user_id)
		{
			$token = uniqid();
			$this->db->where('id', $user_id);
			$this->db->update('users', ['token' => $token]);
			


			$this->db->from('users');
            $this->db->where('id',$user_id);

			$query = $this->db->get();
			return $query->row_array();

		}

		public function resetPassword($new_password,$user_id)
		{
			$password = password_hash($new_password, PASSWORD_BCRYPT);
			$this->db->where('id', $user_id);
			$this->db->update('users', ['password' => $password,'token' =>'']);
		}

		public function userById($user_id)
		{
			$this->db->from('users');
            $this->db->where('id',$user_id);

			$query = $this->db->get();
			return $query->row_array();
		}

		public function updateProfile($data,$user_id)
		{
			$this->db->where('id', $user_id);
			$this->db->update('users', $data);
		}
	}

?>