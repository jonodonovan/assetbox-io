<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Software extends CI_Controller
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

/*******************************************/
/*******************************************/

	    //get software device history and pagination
	    $this->load->model('software_model');
	    $data['software_history'] = $this->software_model->get_history();

/*******************************************/
/*******************************************/

        //form dropdown options for action_type
        $data['action_type'] = array(
				'stockadd'  => 'Add stock',
				'stockremove'  => 'Remove stock',
				'install'  => 'Install',
				'uninstall' => 'Uninstall'
		);

        //form dropdown options
        $this->load->model('software_manufacturer_dropdown_model');
        $data['manufacturer_dropdown'] = $this->software_manufacturer_dropdown_model->get_manufacturers();

        //form dropdown options
        $this->load->model('software_computer_dropdown_model');
        $data['computer_dropdown'] = $this->software_computer_dropdown_model->get_computers();

/*******************************************/
/*******************************************/

		//pass success or failed message
		$data['message'] = $this->session->flashdata('message');

		//pass success or failed message
		$data['messagebad'] = $this->session->flashdata('messagebad');

/*******************************************/
/*******************************************/

        //pass navigation info
        $data['active_page'] = 'software';

        //pass the information to the view
        $data['main_content'] = 'software_view';
        $this->load->view('layout/template', $data);

    }

/*******************************************/
/*******************************************/

	public function itemadd()
    {

 		if ($this->input->post('manufacturer_dropdown') == "" && $this->input->post('sw_name') === "Unknown")
 		{
 			$this->session->set_flashdata('messagebad', 'Please select a Manufacturer and Software Name from the dropdowns');
 			redirect('software');

 		} elseif ($this->input->post('sw_name') === "Unknown" || $this->input->post('sw_name') === "Please Select") {

 			$this->session->set_flashdata('messagebad', 'Please select a Software Name');
 			redirect('software');

 		}

 		if ($this->input->post('action_type') == "install" && $this->input->post('computer') == "")
 		{

 			$this->session->set_flashdata('messagebad', 'A Computer Serial Number is needed for a Install action');
 			redirect('software');

 		} elseif ($this->input->post('action_type') == "uninstall" && $this->input->post('computer') == ""){

 			$this->session->set_flashdata('messagebad', 'A Computer Serial Number is needed for a Uninstall action');
 			redirect('software');

 		}

		// load form validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bad">', '</div>');
		$this->form_validation->set_message('required', 'Items in RED are required');

		// set validation rules
		$this->form_validation->set_rules('action_type', 'Action Type', 'trim');
		$this->form_validation->set_rules('manufacturer_dropdown', 'Manufacturer', 'trim|required');
		$this->form_validation->set_rules('sw_name', 'Software Title', 'trim|required');
		$this->form_validation->set_rules('computer_dropdown', 'Computer', 'trim');
		$this->form_validation->set_rules('license_num', 'License Number', 'trim');
		$this->form_validation->set_rules('ticket_num', 'Ticket Number', 'trim');


		//run form validation
		if ($this->form_validation->run() == FALSE)
		{
			//failed validation
			$this->index();

		//validation passed, move on
		} else {

			//load the model
			$this->load->model('software_model');


			switch ($this->input->post('action_type'))
			{

			    case "install":

					//license? YES
					if (!$this->input->post('license_num') == '') //YES
					{
						//check if license is installed
						if ($query = $this->software_model->check_software_license())
						{
							//license was found, error
							//message and redirect
							$this->session->set_flashdata('messagebad', 'Software License already used');
							redirect('software');

						//license not found, move on
						} else {

							//submit to DB
							$this->software_model->software_submit();
							$this->session->set_flashdata('message', 'Software added to computer successfully');
							redirect('software');

						}

					//license? NO
					} else {

						if ($query = $this->software_model->check_software_name())
						{
							//name found, error
							$this->session->set_flashdata('messagebad', 'Software by the same name is already installed on this computer');
							redirect('software');

						} else {

							//submit to DB
							$this->software_model->software_submit_no_license();
							$this->session->set_flashdata('message', 'Software added to computer successfully');
							redirect('software');
						}
					}

	        	break;

			    case "uninstall":

					//license? YES
					if (!$this->input->post('license_num') == '') //YES
					{
						//check if license is installed
						if (!$query = $this->software_model->uninstall_software_license())
						{
							//license was found, error
							//message and redirect
							$this->session->set_flashdata('messagebad', 'Software license not found for this computer');
							redirect('software');

						//license not found, move on
						} else {

							//submit to DB
							$this->software_model->software_submit();
							$this->session->set_flashdata('message', 'Software removed from computer successfully');
							redirect('software');

						}

					//license? NO
					} else {

						if (!$query = $this->software_model->check_software_name()) //false
						{
							//name found, error
							$this->session->set_flashdata('messagebad', 'Software by this name was not found on this computer');
							redirect('software');

						} else {

							//submit to DB
							$this->software_model->software_submit();
							$this->session->set_flashdata('message', 'Software removed from computer successfully');
							redirect('software');
						}
					}

			    break;

			    case "stockadd":

			    	if (!$this->input->post('license_num') == "") //check to see if license was even submitted
			    	{
						//check if license already added/in stock
						if ($query = $this->software_model->check_software_license_for_stockadd())
						{
							//license was found, error
							//message and redirect
							$this->session->set_flashdata('messagebad', 'The software license has already been added');
							redirect('software');

						//license not found, continue
						} else {

							//submit to DB
							$this->software_model->software_submit();
							$this->session->set_flashdata('message', 'Software added successfully');
							redirect('software');
						}

			    	} else {

						//submit to DB
						$this->software_model->software_submit();
						$this->session->set_flashdata('message', 'Software added successfully');
						redirect('software');

			    	}

			    break;

			    case "stockremove":

			    	//check for license
					if (!$this->input->post('license_num') == "") //YES
					{

			    		//license yes
			    		//is license being used, in install status
						if ($query = $this->software_model->stockremove_check_license_use())
						{

		    				//if yes
			    			//error - please uninstall software with license xxxx first
							$this->session->set_flashdata('messagebad', 'Uninstall the software with license <b>'.$this->input->post('license_num').'</b> first');
							redirect('software');

						} else {

				    		//license yes
			    			//is license being used, in stock remove status
							if ($query = $this->software_model->stockremove_check_license_already_removed())
							{
			    				//if yes
				    			//error
								$this->session->set_flashdata('messagebad', 'Software already set to stock remove');
								redirect('software');

							} else {

				    			//if no
				    			//set to stock remove
				    			$this->software_model->software_submit();
								$this->session->set_flashdata('message', 'Software removed from stock');
								redirect('software');

							}
						}

					} else {

			    		//licence no
			    		//check software db for a matching title with no license that is either a status of removed or stock add
			    		if ($query = $this->software_model->stockremove_check_title())
		    			{
		    				//if found set status to removed
		    				$this->software_model->software_submit();
							$this->session->set_flashdata('message', 'Software removed from stock');
							redirect('software');

		    			} else {

		    				//if not found
			    			//error - no software found that can be stock removed - link to software in stock
							$this->session->set_flashdata('messagebad', 'No software found that can be set to stock remove');
							redirect('software');

						}
					}

			    break;
			}
		}
	}

/*******************************************/
/*******************************************/

    public function get_software_names($manufacturer)
    {

	    $this->load->model('software_name_dropdown_model');

	    header('Content-Type: application/x-json; charset=utf-8');

	    echo(json_encode($this->software_name_dropdown_model->get_names($manufacturer)));

    }

    public function search()
    {
		// load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('search', 'search', 'trim|xss_clean|alpha_numeric');

        if($this->form_validation->run() == FALSE) {

            $this->index();

        } else {

            $this->load->model('search_model');

            $data['query'] = $this->search_model->get_software_search();

            $data['search_query'] = $this->input->post('search', TRUE);

			//settings for popup box
			$data['atts'] = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

			//settings for blank link
			$data['atts_blank'] = array(
				'target' => '_blank'
            );

	        //pass navigation info
	        $data['active_page'] = 'software';

            //pass menu info
            $data['sub_active_page'] = 'search';

            $data['main_content'] = 'search_view';
            $this->load->view('layout/template', $data);
        }
    }

    function overview ()
    {

	    $this->load->model('software_model');

	    $data['query'] = $this->software_model->software_overview();


		$data['detail_value'] = $head_var;

			//settings for popup box
			$data['atts'] = array(
	          'width'      => '800',
	          'height'     => '600',
	          'scrollbars' => 'yes',
	          'status'     => 'yes',
	          'resizable'  => 'yes',
	          'screenx'    => '0',
	          'screeny'    => '0'
	        );

		//pass menu info
	    $data['active_page'] = 'software';

	    $data['main_content'] = 'software_overview_view';
	    $this->load->view('layout/template', $data);
    }
}