<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model
{
	public function get_make_dropdown()
	{
		$result = $this->db->select('make_name')->order_by('id', 'DESC')->get('computer_makes')->result_array();

		$dropdown = array();
		foreach ($result as $r)
		{
			$dropdown[$r['make_name']] = $r['make_name'];
		}
		return $dropdown;
	}

	public function get_model_dropdown()
	{
		$result = $this->db->select('model_name')->order_by('model_name', 'DESC')->get('item_models')->result_array();

		$dropdown = array();
		foreach ($result as $r)
		{
			$dropdown[$r['model_name']] = $r['model_name'];
		}
		return $dropdown;
	}

	public function get_region_dropdown()
	{
		$result = $this->db->select('region')->get('user_regions')->result_array();

		$dropdown = array();
		foreach ($result as $r)
		{
			$dropdown[$r['region']] = $r['region'];
		}
		return $dropdown;
	}

	public function get_office_dropdown()
	{
		$result = $this->db->select('office_name')->get('user_offices')->result_array();

		$dropdown = array();
		foreach ($result as $r)
		{
			$dropdown[$r['office_name']] = $r['office_name'];
		}
		return $dropdown;
	}
}