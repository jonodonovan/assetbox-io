<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_passwordreset_model extends CI_Model
{

   	function add_temp_key($key)
    {

    	$data = array(

    		'email'		=> $this->input->post('email'),
    		'key'		=> $key,
    		'ip' 		=> $this->input->ip_address()

		);

		$query = $this->db->insert('users_passwordreset', $data);

		if ($query)
		{

			return TRUE;

		} else {

			return FALSE;

		}
	}

	function check_key($key)
	{

		$this->db->where('key', $key);
		$this->db->where('activated', 0);
		$query = $this->db->get('users_passwordreset');

		if ($query->num_rows() == 1)
		{

			return TRUE;

		} else {

			return FALSE;

		}
	}

	function double_check()
	{

		$key1 = $this->input->post('key');
		$email1 = $this->input->post('email');

		$this->db->where('key', $key1);
		$this->db->where('email', $email1);
		$query = $this->db->get('users_passwordreset');

		if ($query->num_rows() == 1)
		{

			return TRUE;

		} else {

			return FALSE;

		}
	}

	function change_pass()
	{
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('users');

		if ($query->num_rows() == 1)
		{
	    	$data = array(

	    		'email'		=> $this->input->post('email'),
	    		'password' 	=> $this->encrypt->sha1($this->input->post('password')),
	    		'ip' 		=> $this->input->ip_address()
			);

			$query = $this->db->where('email', $this->input->post('email'))->update('users', $data);

			if ($query)
			{
				$this->db->where('key', $this->input->post('key'));
				$this->db->update('users_passwordreset', array('activated' => 1));
			}

		} else {

			$data = array(

				'email' 	=> $this->input->post('email'),
				'password' 	=> $this->encrypt->sha1($this->input->post('password')),
				'user_type'	=> 0,
				'ip' 		=> $this->input->ip_address()
			);

			$add_success = $this->db->insert('users', $data);

			$insert_id = $this->db->insert_id();

			$this->db->where('email', $this->input->post('email'));
			$add_company_id = $this->db->update('users', array('company_id' => $insert_id));

			if ($add_company_id)
			{
				$this->db->where('key', $this->input->post('key'));
				$this->db->update('users_passwordreset', array('activated' => 1));
			}
		}
	}
}