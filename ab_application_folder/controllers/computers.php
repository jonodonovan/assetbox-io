<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Computers extends CI_Controller
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

		//load and setup pagination
	    $this->load->library('pagination');

        $config['base_url'] = '/computers/index';
        $config['total_rows'] = $this->db->where('company_id', $this->session->userdata('company_id'))->get('computer_history')->num_rows();
        $config['per_page'] = 8;
        $config['num_links'] = 9;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        //load and setup table library
        $this->load->library('table');

        $this->table->set_heading('Action', 'Ticket', 'Tag', 'Tracking', 'Serial', 'Model', 'User', 'Reason', 'Agent', 'Date');

        $this->db->order_by("date_created", "desc");
        $this->db->select("action_type, ticket_num,, asset_tag, tracking_num, serial_num, model, user_id, reason, added_by, date_created,");
		$this->db->where('company_id', $this->session->userdata('company_id'))->where('item_type !=', "mob");
        $rows = $this->db->get('computer_history', $config['per_page'], $this->uri->segment(3))->result_array();


        foreach ($rows as $count => $row)
        {

			if(strstr($row['serial_num'], 'acc'))
			{
				$rows[$count]['serial_num'] = "Accessory";
			}
			else
			{
				$rows[$count]['serial_num'] = anchor('itemprofile/index/c/'.$row['serial_num'],$row['serial_num']);
			}

			if ($rows[$count]['added_by'] != NULL)
			{

				$rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));
			}
        }

        $data['records'] = $rows;

        //pass navigation info
        $data['active_page'] = 'computers';

        //form dropdown options for action_type
        $data['action_type'] = array(
				'checkin'  => 'Check In',
				'checkout' => 'Check Out',
				'warranty' => 'Warranty Repair',
				'needsrepair' => 'Non-Warranty Repair',
				'repairin' => 'Repair In',
				'repairout' => 'Repair out',
				'decom' => 'Decommission',
				'recycle' => 'Recycle'
		);

        //form dropdown options
        $this->load->model('computer_make_dropdown_model');
        $data['make_dropdown'] = $this->computer_make_dropdown_model->get_makes();

        //form dropdown options
        $this->load->model('accessory_dropdown_model');
        $data['accessory_dropdown'] = $this->accessory_dropdown_model->get_makes();

        //pass the information to the view
        $data['main_content'] = 'computers_view';
        $this->load->view('layout/template', $data);

    }

    public function get_models($make_dropdown)
    {

	    $this->load->model('item_model_dropdown_model');

	    header('Content-Type: application/x-json; charset=utf-8');

	    echo(json_encode($this->item_model_dropdown_model->get_models($make_dropdown)));

    }

	function computer_add()
	{
		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('make_dropdown', 'Asset Type', 'trim|required');
		$this->form_validation->set_rules('model_id', 'Model', 'trim|required');
		$this->form_validation->set_rules('serial_num', 'Serial Number', 'trim|required');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');
		$this->form_validation->set_rules('user_id', 'User', 'trim');
		$this->form_validation->set_rules('reason', 'Reason', 'trim');

		//run form validation
		if (!$this->form_validation->run())
		{
			//validation failed send back home with error
			$this->message = '4';
			$this->index();

		} else { //validation passed, submit to DB

			$this->load->model('computer_model');


			if (!$query = $this->computer_model->computer_confirm_device())
			{
				//this is a differnet serial, ok to move forward
				if ($query = $this->computer_model->computer_add())
				{
					//succesfull add, set error
					$this->session->set_flashdata('message', 'Added');

				} else {

					//failed to add, set error
					$this->session->set_flashdata('messagebad', 'Failed to add');

				}

			} else {

				//failed to add, set
				$this->session->set_flashdata('messagebad', 'Serial number <b>'.$this->input->post('serial_num').'</b> has already been added - '.anchor('itemprofile/index/c/'.$this->input->post('serial_num'),'view profile'));
			}

			redirect('computers');
		}
	}

	function accessory_add()
	{
		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('action_type', 'Action', 'trim|required');
		$this->form_validation->set_rules('accessory_dropdown', 'Accessory', 'trim|required');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');
		$this->form_validation->set_rules('user_id', 'User', 'trim');
		$this->form_validation->set_rules('reason', 'Reason', 'trim');
		$this->form_validation->set_rules('tracking_num', 'Tracking', 'trim');


		//run form validation
		if (!$this->form_validation->run())
		{
			$this->message = '3';
			$this->index();

		} else { //validation passed, submit to DB

			$this->load->model('computer_model');

			if ($query = $this->computer_model->accessory_add())
			{
				//submit passed and this is a new item

				$this->session->set_flashdata('message', 'Added');

			} else {

				$this->session->set_flashdata('messagebad', 'Failed to add');

			}

			redirect('computers');
		}
	}

	function serialnumber_action()
	{

		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('action_type', 'Action', 'trim|required');
		$this->form_validation->set_rules('serial_num', 'Serial Number', 'trim|required');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');
		$this->form_validation->set_rules('tracking_num', 'Tracking', 'trim');

		//run form validation
		if ($this->form_validation->run() == FALSE)
		{
			$this->index(); //failed validation

		} else { //validation passed, submit to DB

			$this->load->model('computer_model');

			if (!$query = $this->computer_model->computer_confirm_device())
			{
				//passed
				$this->session->set_flashdata('messagebad', 'Please add the computer first! - '.anchor('#add_computer','click to add', array('class' => 'accordion-toggle','data-toggle' => 'collapse', 'data-parent' => '#accordion')));
				redirect('computers');

			}

			if (!$query = $this->computer_model->computer_check_status())
			{

				if ($query = $this->computer_model->computer_serialedit())
				{
					//submit passed and this is a new item

					$this->session->set_flashdata('message', 'Computer Updated');
					redirect('computers');

				} else {

					$this->session->set_flashdata('messagebad', 'Failed to add');
					redirect('computers');

				}

			} else {

				$this->session->set_flashdata('messagebad', 'Serial number  <b>'.$this->input->post('serial_num').'</b> already in the status <b>"'.$this->input->post('action_type').'"</b> - '. anchor('itemprofile/index/c/'.$this->input->post('serial_num'),'view profile?'));
				redirect('computers');

			}

			redirect('computers');
		}

	}

	public function itemadd()
    {

		$tech = $this->session->userdata('username');

		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('action_type', 'Action', 'trim|alpha|required');
		$this->form_validation->set_rules('serial_num', 'Serial', 'trim|required');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');
		$this->form_validation->set_rules('user_id', 'User', 'trim');
		$this->form_validation->set_rules('reason', 'Reason', 'trim');
		$this->form_validation->set_rules('tracking_num', 'Tracking Number', 'trim');

		//run form validation
		if ($this->form_validation->run() == FALSE)
		{

			$this->index(); //failed validation

		} else { //validation passed, submit to DB

			$this->load->model('item_model');

			if ($query = $this->item_model->add_item())
			{
				//submit passed and this is a new item

				$this->session->set_flashdata('message', 'Added');

			} else {

				$this->session->set_flashdata('message', 'Item Updated');

			}

			redirect('computers');
		}
	}

	function actionedit_byasset()
    {

		// load form validation
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('action_type', 'Action', 'trim|xss_clean|alpha|required');
		$this->form_validation->set_rules('atag', 'Asset Tag', 'trim|xss_clean|required');
		$this->form_validation->set_rules('reason', 'Reason', 'trim|xss_clean');

		//run form validation
		if ($this->form_validation->run() == FALSE)
		{

			$this->index(); //failed validation

		} else { //validation passed, submit to DB

			$this->load->model('computer_model');

			if($query = $this->computer_model->check_assettag())
			{

				if ($query = $this->computer_model->actionedit_byasset())
				{
					//submit passed and this is a new item
					$this->session->set_flashdata('message', 'Added');

				} else {

					$this->session->set_flashdata('message', 'Item Updated');

				}

				redirect('computers');

			} else {

				$this->session->set_flashdata('messagebad', 'Asset Tag not found');
				redirect('computers');

			}
		}
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

            $data['query'] = $this->search_model->get_search();

            $data['search_query'] = $this->input->post('search', TRUE);

	        //pass navigation info
	        $data['active_page'] = 'computers';

            //pass menu info
            $data['sub_active_page'] = 'search';

            $data['main_content'] = 'search_view';
            $this->load->view('layout/template', $data);
        }
    }
}