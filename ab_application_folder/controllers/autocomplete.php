<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller{

	public function index()
	{

	}

	public function get_employees() 
	{

		$q = $this->input->get('term', TRUE);

		$this->load->model('autocomplete_model');
	    $this->autocomplete_model->get_employees($q);
	}

	public function get_partnumbers() 
	{

		$q = $this->input->get('term', TRUE);

		$this->load->model('autocomplete_model');
	    $this->autocomplete_model->get_partnum($q);
	}
}