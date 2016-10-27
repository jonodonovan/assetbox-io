<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Computers_temp extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();

		//check if logged in
		if (!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}


	function computer_add()
	{



		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('make', 'Asset Type', 'trim|required');
		$this->form_validation->set_rules('model_id', 'Model', 'trim|required');
		$this->form_validation->set_rules('serial_num', 'Serial', 'trim|required');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');
		$this->form_validation->set_rules('user_id', 'User', 'trim');
		$this->form_validation->set_rules('reason', 'Reason', 'trim');


		//run form validation
		if ($this->form_validation->run() == FALSE)
		{

			$this->session->set_flashdata('selector', '4');
	        redirect('computers');

		} else { //validation passed, submit to DB

			$this->load->model('computer_model');

			if ($query = $this->computer_model->computer_add())
			{
				//submit passed and this is a new item

				$this->session->set_flashdata('message', 'Added');

			} else {

				$this->session->set_flashdata('messagebad', 'Failed to add');

			}

			redirect('computers');
		}
	}
}