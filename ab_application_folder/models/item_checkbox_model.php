<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_checkbox_model extends CI_Model
{

	function update_checked($checked_messages)
	{
		$edit = "repairout";

		foreach ($checked_messages as $item_id):

			$update_item_data = array(
			'action_type' => $edit
			);
			$update = $this->db->where('serial_num', $item_id)->update('computer', $update_item_data);

			//query db for id based off of serial number
			$this->db->select('id');
			$this->db->where("serial_num", $item_id);
			$this->db->limit(1);
			$query = $this->db->get('computer');
			//get the item id for the serial number above
			$item_id2 = $query->row()->id;


			//build array for history
            $new_item_insert_history = array(
                'item_id' => $item_id2,
                'serial_num' => $item_id,
                'action_type' => $edit,
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

		endforeach;
	}

	function update_checked_nowinstock($checked_messages)
	{
		$edit = "repairin";

		foreach ($checked_messages as $item_id):

			$update_item_data = array(
			'action_type' => $edit
			);
			$update = $this->db->where('serial_num', $item_id)->update('computer', $update_item_data);

			//query db for id based off of serial number
			$this->db->select('id');
			$this->db->where("serial_num", $item_id);
			$this->db->limit(1);
			$query = $this->db->get('computer');
			//get the item id for the serial number above
			$item_id2 = $query->row()->id;


			//build array for history
            $new_item_insert_history = array(
                'item_id' => $item_id2,
                'serial_num' => $item_id,
                'action_type' => $edit,
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

		endforeach;
	}

	function update_checked_removed($checked_messages)
	{
		$edit = "removed";

		foreach ($checked_messages as $item_id):

			$update_item_data = array(
			'action_type' => $edit
			);
			$update = $this->db->where('serial_num', $item_id)->update('computer', $update_item_data);

			//query db for id based off of serial number
			$this->db->select('id');
			$this->db->where("serial_num", $item_id);
			$this->db->limit(1);
			$query = $this->db->get('computer');
			//get the item id for the serial number above
			$item_id2 = $query->row()->id;


			//build array for history
            $new_item_insert_history = array(
                'item_id' => $item_id2,
                'serial_num' => $item_id,
                'action_type' => $edit,
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

		endforeach;
	}

	function update_checked_removed_mobile($checked_messages)
	{
		$edit = "removed";

		foreach ($checked_messages as $item_id):

			$update_item_data = array(
			'action_type' => $edit
			);
			$update = $this->db->where('device_id', $item_id)->update('mobile', $update_item_data);

			//query db for id based off of serial number
			$this->db->select('id, model');
			$this->db->where('device_id', $item_id);
			$this->db->limit(1);
			$query = $this->db->get('mobile');
			//get the item id for the serial number above
			$item_id2 = $query->row()->id;
			$item_model = $query->row()->model;


			//build array for history
            $new_item_insert_history = array(
                'item_id' => $item_id2,
                'device_id' => $item_id,
                'model' => $item_model,
                'action_type' => $edit,
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('mobile_history', $new_item_insert_history);

		endforeach;
	}
}