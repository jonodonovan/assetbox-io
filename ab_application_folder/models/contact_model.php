<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{

	function submit()
	{

		$email = $this->input->post('email');
		$message = $this->input->post('message');
		$ip = $this->input->ip_address();

		$insert = array(
		'email'		=> $email,
		'message'	=> $message,
		'ip'		=> $ip
		);

		//insert data
		$doit = $this->db->insert('contact', $insert);

		return $doit;

	}
}