<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Software_manufacturer_dropdown_model extends CI_Model
{
	function get_manufacturers()
	{
		$this->db->select('id, manufacturer_name');
		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('software_manufacturers');

		$manufacturers = array();


		if($query->result())
		{
		  $manufacturers[''] = 'Please Select';

			foreach ($query->result() as $manufacturer)
			{
				$manufacturers[$manufacturer->id] = $manufacturer->manufacturer_name;
			}
			return $manufacturers;
		}
		else
		{
			return FALSE;
		}
	}
}