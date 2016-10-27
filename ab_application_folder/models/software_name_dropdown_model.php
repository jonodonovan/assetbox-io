<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Software_name_dropdown_model extends CI_Model
{
	function get_names($manufacturer_dropdown = null)
	{
		$this->db->select('id, software_name');
		$this->db->order_by('software_name', 'ASC');

		if($manufacturer_dropdown != NULL)
		{
			$this->db->where('manufacturer_id', $manufacturer_dropdown);
		}

		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('software_names');

		$sw_names = array();

		if($query->result())
		{
			$software_names[''] = 'Please Select';

			foreach ($query->result() as $sw_name)
			{
				$sw_names[$sw_name->id] = $sw_name->software_name;
			}

		return $sw_names;

		}
		else
		{
	  		return FALSE;
		}
	}
}