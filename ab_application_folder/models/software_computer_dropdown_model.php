<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Software_computer_dropdown_model extends CI_Model
{
	function get_computers()
	{
		$this->db->select('id, serial_num');
		$this->db->order_by('serial_num', 'ASC');
		$query = $this->db->where('company_id', $this->session->userdata('company_id'))
						  ->where('make !=', "Accessory")
						  ->where('action_type !=', "recycle")
						  ->where('action_type !=', "remove")
						  ->where('action_type !=', "computer deleted")
						  ->get('computer');

		$computers = array();


		if($query->result())
		{
		  $computers[''] = 'Please Select';

			foreach ($query->result() as $computer)
			{
				$computers[$computer->serial_num] = $computer->serial_num;
			}
			return $computers;
		}
		else
		{
			return FALSE;
		}
	}
}