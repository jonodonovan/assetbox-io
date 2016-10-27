<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_make_dropdown_model extends CI_Model
{
	function get_makes()
	{
		$this->db->select('id, make_name');
		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('mobile_makes');

		$makes = array();


		if($query->result())
		{
		  $makes[''] = 'Please Select';

			foreach ($query->result() as $make)
			{
				$makes[$make->id] = $make->make_name;
			}
			return $makes;
		}
		else
		{
			return FALSE;
		}
	}
}