<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model_dropdown_model extends CI_Model
{
	function get_models($make_dropdown)
	{
		$this->db->select('id, model_name');
		$this->db->order_by('model_name', 'ASC');

		if($make_dropdown != NULL)
		{
			$this->db->where('make_id', $make_dropdown);
		}

		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('computer_models');

		$models = array();

		if($query->result())
		{
			$models[''] = '';

			foreach ($query->result() as $model)
			{
				$models[$model->id] = $model->model_name;
			}

		return $models;

		}
		else
		{
	  		return FALSE;
		}
	}
}