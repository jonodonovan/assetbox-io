<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temporaryhw_model extends CI_Model
{

	function get_tempdevices_notebook()
	{

		$this->db->select("serial_num, action_type, user_id, date_updated");

		$this->db->where('temp_device =', 1)->where('item_type =', "pcn");

		$query = $this->db->get('items')->result_array();

		foreach ($query as $key => $row )
		{

			$data = array(
              'name' => $row['serial_num'],
              'class' => 'user_id',
              'value' => '',
            );

		    //add new columns with a value
		    $query[$key]['extra_column'] = form_input($data);
		    $query[$key]['extra_column2'] = form_submit(array('name' => 'submit', 'class' => 'form', 'value' => 'Update'));

			if ($row['user_id'] != NULL)
			{

    			$id = $row['user_id'];

	            $q = $this->db->select('name')
	            				->where('xid', $id)
	            				->limit(1)->get('employees');

				if ($q->num_rows == 1)
				{

					$query[$key]['user_id'] = form_label($row['user_id'],$row['user_id'], array('title' => $q->row()->name, 'class' => 'useridlink'));

				}
			}
		}

		return $query;
	}

	function get_tempdevices_aircard()
	{

		$this->db->select("serial_num, action_type, user_id, date_created");

		$this->db->where('temp_device =', 1)->where('item_type =', "aircard");

		$query = $this->db->get('items');

		return $query->result_array();
	}

	function get_tempdevices_projector()
	{

		$this->db->select("serial_num, action_type, user_id, date_created");

		$this->db->where('temp_device =', 1)->where('item_type =', "projector");

		$query = $this->db->get('items');

		return $query->result_array();
	}


}