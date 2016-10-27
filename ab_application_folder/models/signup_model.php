<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup_model extends CI_Model
{

    public function add_temp_user($registration_key)
    {

    	$data = array(

    		'email'		=> $this->input->post('email'),
    		'password' 	=> $this->encrypt->sha1($this->input->post('password')),
    		'key'		=> $registration_key,
    		'ip' 		=> $this->input->ip_address()

		);

		$query = $this->db->insert('users_temp', $data);

		if ($query)
		{

			return TRUE;

		} else {

			return FALSE;

		}
	}

	public function check_key($registration_key)
	{

		$this->db->where('key', $registration_key);
		$this->db->where('activated', 0);
		$query = $this->db->get('users_temp');

		if ($query->num_rows() == 1)
		{

			return TRUE;

		} else {

			return FALSE;

		}
	}

	public function activate_user($registration_key)
	{

		$this->db->where('key', $registration_key);
		$this->db->where('activated', 0);
		$temp_user = $this->db->get('users_temp');

		if ($temp_user)
		{

			$row = $temp_user->row();

			$data = array(

					'email' 	=> $row->email,
					'password' 	=> $row->password,
					'user_type'	=> 0,
					'date_created' => date("Y-m-d H:i:s"),
					'ip' 		=> $this->input->ip_address()
				);

			$add_success = $this->db->insert('users', $data);

			$insert_id = $this->db->insert_id();

			$this->db->where('email', $row->email);
			$add_company_id = $this->db->update('users', array('company_id' => $insert_id));

			if ($add_success)
			{

				$this->db->where('key', $registration_key);
				$this->db->update('users_temp', array('activated' => 1));
			}
		}
	}
}