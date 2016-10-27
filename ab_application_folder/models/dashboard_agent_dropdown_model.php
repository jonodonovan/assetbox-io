<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_agent_dropdown_model extends CI_Model
{
	function get_agents()
	{
		$this->db->select('id, email');
		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->where('is_agent', '1')->get('users');

		$makes = array();


		if($query->result())
		{
		  $makes[''] = 'Please Select';

			foreach ($query->result() as $make)
			{
				$makes[$make->id] = $make->email;
			}
			return $makes;
		}
		else
		{
			return FALSE;
		}
	}
}