<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_software_name_dropdown_model extends CI_Model
{
	function get_models()
	{
		$this->db->select('id, software_name');
		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('software_names');

		$makes = array();


		if($query->result())
		{
		  $makes[''] = 'Please Select';

			foreach ($query->result() as $make)
			{
				$makes[$make->id] = $make->software_name;
			}
			return $makes;
		}
		else
		{
			return FALSE;
		}
	}
}