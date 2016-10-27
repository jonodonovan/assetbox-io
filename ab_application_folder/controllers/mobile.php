<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller
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

    public function index()
    {

		if(isset($this->message))
		{
			$data['block'] = $this->message;
		} else {

            $data['block'] = '';
        }

/*******************************************/
/*******************************************/

	    //get software device history and pagination
	    $this->load->model('mobile_model');
	    $data['mobile_history'] = $this->mobile_model->get_history();

/*******************************************/
/*******************************************/

        //form dropdown options for action_type
        $data['action_type'] = array(
				'checkin'  => 'Check In',
				'checkout' => 'Check Out',
				'needsrepair' => 'Needs Repair',
				'repairin' => 'Repair In',
				'repairout' => 'Repair out',
				'recycle' => 'Recycle'
		);

        //form dropdown options
        $this->load->model('mobile_make_dropdown_model');
        $data['mobile_make_dropdown'] = $this->mobile_make_dropdown_model->get_makes();

/*******************************************/
/*******************************************/

		//pass success or failed message
		$data['message'] = $this->session->flashdata('message');

		//pass success or failed message
		$data['messagebad'] = $this->session->flashdata('messagebad');

/*******************************************/
/*******************************************/

        //pass navigation info
        $data['active_page'] = 'mobile';

        //pass the information to the view
        $data['main_content'] = 'mobile_view';
        $this->load->view('layout/template', $data);

    }

/*******************************************/
/*******************************************/

	public function mobilecheck()
    {

		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('action_type', 'Action Type', 'trim|required');
		$this->form_validation->set_rules('device_id', 'Device ID', 'trim|required');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');
		$this->form_validation->set_rules('tracking_num', 'Tracking Number', 'trim');

		//run form validation
		if ($this->form_validation->run() == FALSE)
		{

			$this->index(); //failed validation

		} else { //validation passed, submit to DB

			$this->load->model('mobile_model');

			if (!$query = $this->mobile_model->mobile_confirm_device())
			{
				//passed
				$this->session->set_flashdata('messagebad', 'Please add the device first!');
				redirect('mobile');

			}

			if (!$query = $this->mobile_model->mobile_confirm_status())
			{

				if ($query = $this->mobile_model->mobilecheck_add())
				{
					//submit passed and this is a new item
					$this->session->set_flashdata('messagebad', 'Failed');

				} else {

					$this->session->set_flashdata('message', 'Item Updated');

				}

			} else {

				$this->session->set_flashdata('messagebad', 'Device is already in this status');
			}

			redirect('mobile');
		}
	}


	public function deviceadd()
    {


		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('mobile_make_dropdown', 'Make', 'trim|required');
		$this->form_validation->set_rules('mobile_model_dropdown', 'Model', 'trim|required');
		$this->form_validation->set_rules('device_id', 'Device ID', 'trim|required');

		//run form validation
		if (!$this->form_validation->run())
		{
			$this->message = '2';
			$this->index(); //failed validation

		} else { //validation passed, submit to DB

			$this->load->model('mobile_model');

			if ($query = $this->mobile_model->device_check())
			{
				//passed
				$this->session->set_flashdata('messagebad', 'Device is already in system');
				redirect('mobile');

			} else {

				if ($query = $this->mobile_model->deviceadd())
				{
					//submit passed and this is a new item

					$this->session->set_flashdata('messagebad', 'Not Added');

				} else {

					$this->session->set_flashdata('message', 'Added');

				}

				redirect('mobile');
			}
		}
	}

/*******************************************/
/*******************************************/

    public function get_models($mobile_make)
    {

	    $this->load->model('mobile_model_dropdown_model');

	    header('Content-Type: application/x-json; charset=utf-8');

	    echo(json_encode($this->mobile_model_dropdown_model->get_models($mobile_make)));

    }

    public function search()
    {
        // load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('search', 'search', 'trim');

        if($this->form_validation->run() == FALSE) {

            $this->index();

        } else {

            $this->load->model('search_model');

            $data['query'] = $this->search_model->get_mobile_search();

            $data['search_query'] = $this->input->post('search', TRUE);

            //pass navigation info
            $data['active_page'] = 'mobile';

            //pass menu info
            $data['sub_active_page'] = 'search';

            $data['main_content'] = 'search_view';
            $this->load->view('layout/template', $data);
        }
    }
}