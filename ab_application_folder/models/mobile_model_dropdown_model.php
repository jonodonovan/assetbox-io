<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model_dropdown_model extends CI_Model
{
	function get_models($mobile_make = null)
	{
		$this->db->select('id, model_name');
		$this->db->order_by('model_name', 'ASC');

		if($mobile_make != NULL)
		{
			$this->db->where('make_id', $mobile_make);
		}

		$query = $this->db->where('company_id', $this->session->userdata('company_id'))->get('mobile_models');

		$mobile_models = array();

		if($query->result())
		{
			$mobile_models[''] = 'Please Select';

			foreach ($query->result() as $mobile_model)
			{
				$mobile_models[$mobile_model->id] = $mobile_model->model_name;
			}

		return $mobile_models;

		}
		else
		{
	  		return FALSE;
		}
	}
}