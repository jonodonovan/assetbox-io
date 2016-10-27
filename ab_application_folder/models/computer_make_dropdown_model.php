<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Computer_make_dropdown_model extends CI_Model
{
	function get_makes()
	{
		$this->db->select('id, make_name');
		$this->db->where('id <', 4 );
		$query = $this->db->get('computer_makes');

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

	function get_makes2()
	{
		$this->db->select('id, make_name');
		$query = $this->db->get('computer_makes');

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