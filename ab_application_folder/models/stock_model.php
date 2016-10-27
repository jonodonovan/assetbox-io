<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model
{
	function get_tempdevices_notebook()
	{

		$this->db->select("serial_num, action_type, user_id, date_updated");

		$this->db->where('temp_device =', 1)->where('item_type =', "pcn");

		$query = $this->db->get('computer');

		return $query->result_array();
	}

	function get_tempdevices_aircard()
	{

		$this->db->select("serial_num, action_type, user_id, date_created");

		$this->db->where('temp_device =', 1)->where('item_type =', "aircard");

		$query = $this->db->get('computer');

		return $query->result_array();
	}

	function get_tempdevices_projector()
	{

		$this->db->select("serial_num, action_type, user_id, date_created");

		$this->db->where('temp_device =', 1)->where('item_type =', "projector");

		$query = $this->db->get('computer');

		return $query->result_array();
	}
}