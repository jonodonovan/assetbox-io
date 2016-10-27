<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
    	//$this->load->model('upload_model');
        //$this->load->library('csvimport');
		session_start();

		//check if logged in and have access
		if (!$this->session->userdata('logged_in'))
		{

			redirect('login');

		} elseif ($this->session->userdata('is_agent') == 1) {

			redirect('computers');

		}
	}

	function index()
	{

        // for upload center, disabled until needed
		// $data['addressbook'] = $this->upload_model->get_addressbook();

        //pass navigation info
        $data['active_page'] = 'settings';
        $data['sub_active_page'] = '';

        //pass the information to the view
        $data['main_content'] = 'settings_view';
        $this->load->view('layout/template', $data);
	}

	function importcsv()
	{
        $data['addressbook'] = $this->upload_model->get_addressbook();
        $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = realpath(APPPATH. '../uploads/');
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload())
        {

        	$this->session->set_flashdata('messagebad', $this->upload->display_errors());

	        $data['main_content'] = 'settings_view';
	        $this->load->view('layout/template', $data);

        } else {

            $file_data = $this->upload->data();
            $path = realpath(APPPATH. '../uploads');

            $file_path =  $path.'/'.$file_data['file_name'];

            if ($this->csvimport->get_array($file_path))
            {
                $csv_array = $this->csvimport->get_array($file_path);

                foreach ($csv_array as $row) {

                    $insert_data = array(
                        'email'=>$row['email'],
                        'user_type'=>$row['user_type'],
                        'company_id'=>$row['company_id'],
                        'company_name'=>$row['company_name'],
                    );

                    if($row['email'] === NULL)
                    {
		                $this->session->set_flashdata('messagebad', 'No, email column bad.');
		                redirect('dashboard/profile');

                    } else if($row['user_type'] === NULL) {
                    	$this->session->set_flashdata('messagebad', 'No, user type column bad.');
		                redirect('dashboard/profile');

                    } else if($row['company_id'] === NULL) {
                    	$this->session->set_flashdata('messagebad', 'No, company id column bad.');
		                redirect('dashboard/profile');

                    } else if($row['company_name'] === NULL) {
                    	$this->session->set_flashdata('messagebad', 'No, company name column bad.');
		                redirect('dashboard/profile');
                    }

                    $this->upload_model->insert_csv($insert_data);
                    //echo "<pre>"; print_r($insert_data);
                }

                $this->session->set_flashdata('message', 'Csv Data Imported Succesfully');
                redirect('dashboard/profile');


            } else {

	        	$this->session->set_flashdata('messagebad', 'hello');

		        $data['main_content'] = 'settings_view';
		        $this->load->view('layout/template', $data);

            }
        }
    }




	public function profile()
	{

		$data['del_tech'] = array(
		'name'        => 'del_tech',
		'id'          => 'del_tech',
		'value'       => 'del_tech',
		'checked'     => FALSE,
		);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'profile';

        //pass the information to the view
        $data['main_content'] = 'dashboard_profile_view';
        $this->load->view('layout/template', $data);

	}

	public function email()
	{

		$data['del_tech'] = array(
		'name'        => 'del_tech',
		'id'          => 'del_tech',
		'value'       => 'del_tech',
		'checked'     => FALSE,
		);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'email';

        //pass the information to the view
        $data['main_content'] = 'dashboard_email_view';
        $this->load->view('layout/template', $data);

	}

	public function company()
	{

		$data['del_tech'] = array(
		'name'        => 'del_tech',
		'id'          => 'del_tech',
		'value'       => 'del_tech',
		'checked'     => FALSE,
		);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'company';

        //pass the information to the view
        $data['main_content'] = 'dashboard_company_view';
        $this->load->view('layout/template', $data);

	}

	public function agents()
	{

		// tech dropdown
        $this->load->model('dashboard_agent_dropdown_model');
        $data['list_agents'] = $this->dashboard_agent_dropdown_model->get_agents();


		$data['del_agent'] = array(
		'name'        => 'del_agent',
		'id'          => 'del_agent',
		'value'       => 'del_agent',
		'checked'     => FALSE,
		);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'agent';

        //pass the information to the view
        $data['main_content'] = 'dashboard_agent_view';
        $this->load->view('layout/template', $data);

	}

	public function computer_models()
	{

        //form dropdown options
        $this->load->model('computer_make_dropdown_model');
        $data['make_dropdown'] = $this->computer_make_dropdown_model->get_makes2();

		// tech dropdown
        $this->load->model('dashboard_model_dropdown_model');
        $data['list_models'] = $this->dashboard_model_dropdown_model->get_models();

		$data['del_model'] = array('name' => 'del_model', 'id' => 'del_model', 'value' => 'del_model', 'checked' => FALSE);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'models';

        //pass the information to the view
        $data['main_content'] = 'dashboard_models_view';
        $this->load->view('layout/template', $data);

	}

	public function software_manufacturers()
	{

        //form dropdown options
        $this->load->model('software_manufacturer_dropdown_model');
        $data['manufacturer_dropdown'] = $this->software_manufacturer_dropdown_model->get_manufacturers();

		$data['del_manufacturer'] = array('name' => 'del_manufacturer', 'id' => 'del_manufacturer', 'value' => 'del_manufacturer', 'checked' => FALSE);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'swmanu';

        //pass the information to the view
        $data['main_content'] = 'dashboard_swmanufacturer_view';
        $this->load->view('layout/template', $data);

	}

	public function software_names()
	{

        //form dropdown options
        $this->load->model('software_manufacturer_dropdown_model');
        $data['manufacturer_dropdown'] = $this->software_manufacturer_dropdown_model->get_manufacturers();

		// tech dropdown
        $this->load->model('dashboard_software_name_dropdown_model');
        $data['list_swnames'] = $this->dashboard_software_name_dropdown_model->get_models();

		$data['del_name'] = array('name' => 'del_name', 'id' => 'del_name', 'value' => 'del_name', 'checked' => FALSE);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'swname';

        //pass the information to the view
        $data['main_content'] = 'dashboard_swname_view';
        $this->load->view('layout/template', $data);

	}


	public function edit_your_name()
	{

        // load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|alpha');

        //run form validation
        if ($this->form_validation->run())
		{

			$this->load->model('dashboard_model');

			if ($query = $this->dashboard_model->edit_your_name())
			{
				$session_array = array('name' => $this->input->post('name'));
				$this->session->set_userdata($session_array);
				$this->session->set_flashdata('message', 'Name has been updated');
				redirect('dashboard/profile');
			}
		}

		$this->profile();
	}

	public function edit_your_email()
	{

        // load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('alt_email', 'Alternative Email', 'trim|xss_clean|valid_email');

        //run form validation
        if ($this->form_validation->run())
		{

			$this->load->model('dashboard_model');

			if ($query = $this->dashboard_model->edit_your_alt_email())
			{
				$session_array = array('alt_email' => $this->input->post('alt_email'));
				$this->session->set_userdata($session_array);
				$this->session->set_flashdata('message', 'alternate email address updated');
				redirect('dashboard/email');
			}
		}

		$this->email();

	}

	public function edit_company_name()
	{

        // load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('cname', 'Company Name', 'trim|xss_clean');

        //run form validation
        if ($this->form_validation->run())
		{

			$this->load->model('dashboard_model');

			if ($query = $this->dashboard_model->edit_your_company_name())
			{

				$session_array = array('company_name' => $this->input->post('cname'));
				$this->session->set_userdata($session_array);
				$this->session->set_flashdata('message', 'Company name updated');
				redirect('dashboard/company');
			}
		}

		$this->company();

	}

	public function manage_agents()
	{

        // load form validation
        $this->load->library('form_validation');

        if ($this->input->post('del_agent'))
        {

        	if ($this->input->post('list_agents') == null)
        	{

        		$this->form_validation->set_message('required', 'No agent was selected');
        		$this->form_validation->set_rules('list_agents', 'list_agents', 'required');

		        if ($this->form_validation->run())
				{

				}

				$this->agents();
        	}

			$this->load->model('dashboard_model');

			if ($query = $this->dashboard_model->del_agent())
			{

				$this->session->set_flashdata('message', 'Agent deleted');
				redirect('dashboard/agents');

			}
        }

        	elseif ($this->input->post('list_agents'))

        {

			$this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');

	        if ($this->form_validation->run())
			{
				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->update_agent_password())
				{

					$this->session->set_flashdata('message', 'Agent updated');
					redirect('dashboard/agents');

				}
			}

			$this->agents();

    	}

        // set validation rules
        $this->form_validation->set_rules('email', 'email', 'required|trim|xss_clean|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');

        //run form validation
        if ($this->form_validation->run())
		{

			$this->load->model('dashboard_model');

			if ($query = $this->dashboard_model->add_agent())
			{

				$this->session->set_flashdata('message', 'Agent added');
				redirect('dashboard/agents');

			}
		}

		$this->agents();

	}

	public function manage_models()
	{


        // load form validation
        $this->load->library('form_validation');

        if ($this->input->post('del_model'))
        {

        	if ($this->input->post('list_models') == null)
        	{

        		$this->session->set_flashdata('messagebad', 'No model was selected');
        		redirect('dashboard/computer_models');

        	} else {

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->del_model())
				{

					$this->session->set_flashdata('message', 'Model deleted');
					redirect('dashboard/computer_models');

				}
        	}

    	} elseif (!$this->input->post('del_model') && $this->input->post('make_dropdown') == '' || $this->input->post('number') == '') {

    		$this->session->set_flashdata('messagebad', 'No selection was made');
    		redirect('dashboard/computer_models');

    	} else {

	        // set validation rules
	        $this->form_validation->set_rules('make_dropdown', 'Asset Type', 'required|trim|xss_clean|alpha_numeric');
	        $this->form_validation->set_rules('number', 'Model Number', 'required|trim|xss_clean');

	        //run form validation
	        if ($this->form_validation->run())
			{

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->add_model())
				{

					$this->session->set_flashdata('message', 'Model added');
					redirect('dashboard/computer_models');

				}
			}

			$this->models();

    	}
	}

	public function manage_swmanufacturers()
	{

        // load form validation
        $this->load->library('form_validation');

        if ($this->input->post('del_manufacturer'))
        {

        	if ($this->input->post('manufacturer_dropdown') == null)
        	{

        		$this->session->set_flashdata('messagebad', 'No manufacturer was selected');
        		redirect('dashboard/software_manufacturers');

        	} else {

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->del_manufacturer())
				{

					$this->session->set_flashdata('message', 'Manufacturer deleted');
					redirect('dashboard/software_manufacturers');

				}
        	}

    	} elseif (!$this->input->post('manuname') && !$this->input->post('del_manufacturer') && $this->input->post('manufacturer_dropdown') == '') {

    		$this->session->set_flashdata('messagebad', 'No selection was made');
    		redirect('dashboard/software_manufacturers');

    	} else {

	        // set validation rules
	        $this->form_validation->set_rules('manuname', 'Manufacturer Name', 'required|trim|xss_clean');

	        //run form validation
	        if ($this->form_validation->run())
			{

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->add_manufacturer())
				{

					$this->session->set_flashdata('message', 'Manufacturer added');
					redirect('dashboard/software_manufacturers');

				}
			}

			$this->software_manufacturers();

    	}
	}

	public function manage_swnames()
	{

        // load form validation
        $this->load->library('form_validation');

        if ($this->input->post('del_name'))
        {

        	if ($this->input->post('list_swnames') == null)
        	{

        		$this->session->set_flashdata('messagebad', 'No software title was selected');
        		redirect('dashboard/software_names');

        	} else {

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->del_swname())
				{

					$this->session->set_flashdata('message', 'Software title deleted');
					redirect('dashboard/software_names');

				}
        	}

    	} elseif (!$this->input->post('swname') && !$this->input->post('del_name') && $this->input->post('manufacturer_dropdown') == '') {

    		$this->session->set_flashdata('messagebad', 'No selection was made');
    		redirect('dashboard/software_names');

    	} else {

	        // set validation rules
	        $this->form_validation->set_rules('manufacturer_dropdown', 'Manufacturer', 'required|trim|xss_clean');
	        $this->form_validation->set_rules('swname', 'Software Title', 'required|trim|xss_clean');

	        //run form validation
	        if ($this->form_validation->run())
			{

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->add_swname())
				{

					$this->session->set_flashdata('message', 'Software title added');
					redirect('dashboard/software_names');

				}
			}

			$this->software_names();

    	}
	}

	public function mobile_makes()
	{

        //form dropdown options
        $this->load->model('mobile_make_dropdown_model');
        $data['manufacturer_dropdown'] = $this->mobile_make_dropdown_model->get_makes();

		$data['del_manufacturer'] = array('name' => 'del_manufacturer', 'id' => 'del_manufacturer', 'value' => 'del_manufacturer', 'checked' => FALSE);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'swmanu';

        //pass the information to the view
        $data['main_content'] = 'dashboard_mobilemakes_view';
        $this->load->view('layout/template', $data);

	}

	public function mobile_models()
	{

        //form dropdown options
        $this->load->model('mobile_make_dropdown_model');
        $data['manufacturer_dropdown'] = $this->mobile_make_dropdown_model->get_makes();

		// tech dropdown
        $this->load->model('dashboard_mobile_model_dropdown_model');
        $data['list_swnames'] = $this->dashboard_mobile_model_dropdown_model->get_models();

		$data['del_name'] = array('name' => 'del_name', 'id' => 'del_name', 'value' => 'del_name', 'checked' => FALSE);

        //pass navigation info
        $data['active_page'] = 'dashboard';
        $data['sub_active_page'] = 'swname';

        //pass the information to the view
        $data['main_content'] = 'dashboard_mobilemodels_view';
        $this->load->view('layout/template', $data);

	}

	public function manage_mobilemakes()
	{

        // load form validation
        $this->load->library('form_validation');

        if ($this->input->post('del_manufacturer'))
        {

        	if ($this->input->post('manufacturer_dropdown') == null)
        	{

        		$this->session->set_flashdata('messagebad', 'No manufacturer was selected');
        		redirect('dashboard/mobile_makes');

        	} else {

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->del_mobilemanufacturer())
				{

					$this->session->set_flashdata('message', 'Manufacturer deleted');
					redirect('dashboard/mobile_makes');

				}
        	}

    	} elseif (!$this->input->post('manuname') && !$this->input->post('del_manufacturer') && $this->input->post('manufacturer_dropdown') == '') {

    		$this->session->set_flashdata('messagebad', 'No selection was made');
    		redirect('dashboard/mobile_makes');

    	} else {

	        // set validation rules
	        $this->form_validation->set_rules('manuname', 'Manufacturer Number', 'required|trim|xss_clean');

	        //run form validation
	        if ($this->form_validation->run())
			{

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->add_mobilemanufacturer())
				{

					$this->session->set_flashdata('message', 'Manufacturer added');
					redirect('dashboard/mobile_makes');

				}
			}

			$this->models();

    	}
	}

	public function manage_mobilemodels()
	{

        // load form validation
        $this->load->library('form_validation');

        if ($this->input->post('del_name'))
        {

        	if ($this->input->post('list_swnames') == null)
        	{

        		$this->session->set_flashdata('messagebad', 'No model was selected');
        		redirect('dashboard/mobile_models');

        	} else {

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->del_mobilemodel())
				{

					$this->session->set_flashdata('message', 'Model deleted');
					redirect('dashboard/mobile_models');

				}
        	}

    	} elseif (!$this->input->post('swname') && !$this->input->post('del_name') && $this->input->post('manufacturer_dropdown') == '') {

    		$this->session->set_flashdata('messagebad', 'No selection was made');
    		redirect('dashboard/mobile_models');

    	} else {

	        // set validation rules
	        $this->form_validation->set_rules('manufacturer_dropdown', 'Manufacturer', 'required|trim|xss_clean');
	        $this->form_validation->set_rules('swname', 'Model', 'required|trim|xss_clean');

	        //run form validation
	        if ($this->form_validation->run())
			{

				$this->load->model('dashboard_model');

				if ($query = $this->dashboard_model->add_mobilemodel())
				{

					$this->session->set_flashdata('message', 'Model added');
					redirect('dashboard/mobile_models');

				}
			}

			$this->models();

    	}
	}
}