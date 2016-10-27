<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_mobile_model_dropdown_model extends CI_Model
{
	function get_models()
	{
		$this->db->select('id, model_name');
		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('mobile_models');

		$makes = array();


		if($query->result())
		{
		  $makes[''] = 'Please Select';

			foreach ($query->result() as $make)
			{
				$makes[$make->id] = $make->model_name;
			}
			return $makes;
		}
		else
		{
			return FALSE;
		}
	}
}