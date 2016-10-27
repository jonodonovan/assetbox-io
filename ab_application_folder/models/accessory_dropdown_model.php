<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accessory_dropdown_model extends CI_Model
{
	function get_makes()
	{
		$this->db->select('model_name');
		$this->db->where('make_id', '5');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$query = $this->db->get('computer_models');

		$makes = array();


		if($query->result())
		{
		  $makes[''] = 'Please Select';

			foreach ($query->result() as $make)
			{
				$makes[$make->model_name] = $make->model_name;
			}
			return $makes;
		}
		else
		{
			return FALSE;
		}
	}
}