<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Computer_action_dropdown_model extends CI_Model
{
	function get_actions()
	{
		$this->db->select('id, action_name');
		$query = $this->db->get('computer_actions');

		$makes = array();


		if($query->result())
		{
		  $makes[''] = 'Please Select';

			foreach ($query->result() as $make)
			{
				$makes[$make->id] = $make->action_name;
			}
			return $makes;
		}
		else
		{
			return FALSE;
		}
	}
}