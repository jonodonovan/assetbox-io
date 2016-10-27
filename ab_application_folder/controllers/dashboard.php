<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();

		//check if logged in and have access
		if (!$this->session->userdata('logged_in'))
		{

			redirect('login');

		} elseif ($this->session->userdata('is_agent') == 1) {

			redirect('computers');

		}
	}

	public function index()
	{
		/***********************
		****Get Information******
		***********************/

        $this->load->model('report_model');

		// computers not in stock
        $query = $this->report_model->get_computers_not_in_stock_info();
		$data['comp_out_count'] = $query['comp_out_count'];
        $data['comp_out_rows'] = $query['comp_out_rows'];

		//get information - computers
        $query = $this->report_model->get_computer_info();
		$data['computer_count'] = $query['computer_count'];
        $data['computer_rows'] = $query['computer_rows'];

		//get information - software
        $query = $this->report_model->get_software_info();
		$data['software_count'] = $query['software_count'];
        $data['software_rows'] = $query['software_rows'];

		//get information - mobile
        $query = $this->report_model->get_mobile_info();
		$data['mobile_count'] = $query['mobile_count'];
        $data['mobile_rows'] = $query['mobile_rows'];

		//get information total actions in history
        $data['us_total_actions'] = $this->report_model->get_total_actionhistory();

		//get information total number of computers tracked
        //$data['total_computers'] = $this->report_model->get_total_computers();
		$query = $this->report_model->get_total_computers();
		$data['us_total_computers'] = $query['us_total_computers'];
        $data['us_computer_rows'] = $query['us_computerrows'];

		//get information total number of accessories tracked
        //$data['total_computers'] = $this->report_model->get_total_computers();
		$query = $this->report_model->get_total_acc();
		$data['us_total_accs'] = $query['us_total_accs'];
        $data['us_acc_rows'] = $query['us_accrows'];

		//get information total number of software names tracked
        //$data['total_computers'] = $this->report_model->get_total_computers();
		$query = $this->report_model->get_total_swnames();
		$data['us_total_swnames'] = $query['us_total_swnames'];
        $data['us_acc_rows'] = $query['us_accrows'];

		//get information total number of mobile tracked
        //$data['total_computers'] = $this->report_model->get_total_computers();
		$query = $this->report_model->get_total_mobile();
		$data['us_total_mobile'] = $query['us_total_mobile'];
        $data['us_acc_rows'] = $query['us_accrows'];

		//get information total actions in history for one week
        $data['us_total_actions_oneweek'] = $this->report_model->get_actions_oneweek();

		//get information total actions in history for four weeks
        $data['us_total_actions_fourweek'] = $this->report_model->get_actions_fourweek();

		//get information total actions in history for one month
        $data['us_total_actions_onemonth'] = $this->report_model->get_actions_onemonth();

		//computers - comp_temp - computers on loan
        $query = $this->report_model->get_temp_comps();
		$data['comp_temp_count'] = $query['comp_temp_count'];
        $data['comp_temp_rows'] = $query['comp_temp_rows'];

		//mobile - ced - contract ending dates
        $query = $this->report_model->get_topreasons2();
		$data['ced_count'] = $query['us_total_reasons2'];
        $data['ced_rows'] = $query['us_reasonrows2'];

		//mobile - crd - contract renewal dates
        $query = $this->report_model->get_topreasons3();
		$data['crd_count'] = $query['us_total_reasons3'];
        $data['crd_rows'] = $query['us_reasonrows3'];

		//mobile - mobile_temp - mobiles on loan
        $query = $this->report_model->get_temp_mobiles();
		$data['mobile_temp_count'] = $query['mobile_temp_count'];
        $data['mobile_temp_rows'] = $query['mobile_temp_rows'];

		//software - led - licenses ending dates
        $query = $this->report_model->get_led();
		$data['led_count'] = $query['led_count'];
        $data['led_rows'] = $query['led_rows'];

		//software - sed - support ending dates
        $query = $this->report_model->get_sed();
		$data['sed_count'] = $query['sed_count'];
        $data['sed_rows'] = $query['sed_rows'];

		/***********************
		****Stock Information******
		***********************/

	    //Computers in Stock
	    $total_amount_pcn = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('type_var =', "pcn")
	          ->where('action_type !=', "checkout")
	          ->where('action_type !=', "recycle")
	          ->where('action_type !=', "repairout")
	          ->where('action_type !=', "needsrepair")
	          ->where('action_type !=', "audit_missing")
	          ->where('action_type !=', "stockout")
	          ->where('action_type !=', "warranty")
	          ->where('action_type !=', "removed")
	          ->where('action_type !=', "computer deleted")
	          ->where('action_type !=', "lost_stolen");
	    $stockrows = $this->db->get('computer')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];
	      $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
	    }

	    $data['total_amount_pcn'] = $total_amount_pcn;
	    $data['stockrecords_pcn'] = $stockrows;

	/*******************************************/
	/*******************************************/

	    //Computers needing warranty repairs
	    $total_amount_pri = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('type_var =', "pcn")
	          ->where('action_type =', "warranty");
	    $stockrows = $this->db->get('computer')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];
	      $total_amount_pri = ($total_amount_pri + $stockrow['total']);

	    }

	    $data['total_amount_pri'] = $total_amount_pri;
	    $data['stockrecords_pri'] = $stockrows;

	/*******************************************/
	/*******************************************/

	    //Computers needing non-warranty repairs
	    $total_amount_rpn = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('type_var =', "pcn")
	          ->where('action_type =', "needsrepair");
	    $stockrows = $this->db->get('computer')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];
	      $total_amount_rpn = ($total_amount_rpn + $stockrow['total']);

	    }

	    $data['total_amount_rpn'] = $total_amount_rpn;
	    $data['stockrecords_pcn_needsrepair'] = $stockrows;

	/*******************************************/
	/*******************************************/

	    //Computers out for repair
	    $total_amount_ofr = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('type_var =', "pcn")
	          ->where('action_type =', "repairout");
	    $stockrows = $this->db->get('computer')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];
	      $total_amount_ofr = ($total_amount_ofr + $stockrow['total']);

	    }

	    $data['total_amount_ofr'] = $total_amount_ofr;
	    $data['stockrecords_pcn_repairout'] = $stockrows;

	/*******************************************/
	/*******************************************/

	    //Decommissioned computers
	    $total_amount_frc = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('type_var =', "pcn")
	          ->where('action_type =', "recycle")
	          ->or_where('action_type =', "decom");
	    $stockrows = $this->db->get('computer')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];
	      $total_amount_frc = ($total_amount_frc + $stockrow['total']);

	    }

	    $data['total_amount_frc'] = $total_amount_frc;
	    $data['stockrecords_pcn_recycle'] = $stockrows;

	/*******************************************/
	/*******************************************/

	    //in stock accessories
	    $total_amount_acc = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('type_var =', "acc")
	          ->where('action_type !=', "checkout")
	          ->where('action_type !=', "recycle")
	          ->where('action_type !=', "repairout")
	          ->where('action_type !=', "needsrepair")
	          ->where('action_type !=', "audit_missing")
	          ->where('action_type !=', "stockout")
	          ->where('action_type !=', "warranty")
	          ->where('action_type !=', "removed")
	          ->where('action_type !=', "lost_stolen");
	    $stockrows = $this->db->get('computer')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];
	      $total_amount_acc = ($total_amount_acc + $stockrow['total']);

	    }

	    $data['total_amount_acc'] = $total_amount_acc;
	    $data['stockrecords_acc'] = $stockrows;

	/***********************
	****Software Stock Information******
	***********************/

	    //in Stock
	    $total_amount_pcn = 0;
	    $this->db->select('name, COUNT(id) AS total')->group_by('name')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('action_type !=', "stock remove")
	          ->where('action_type !=', "install")
	          ->where('action_type !=', "license deleted")
	          ->order_by('total', 'DESC')
	          ->limit(5);
	    $stockrows = $this->db->get('software')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['name'] = $stockrow['name'];

	    }

	    $this->db->select('name, COUNT(id) AS total')->group_by('name')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('action_type !=', "stock remove")
	          ->where('action_type !=', "install")
	          ->where('action_type !=', "license deleted")
	          ->order_by('total', 'DESC');

	    $stockrows2 = $this->db->get('software')->result_array();

	    foreach ($stockrows2 as $count => $stockrow)
	    {

	      $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
	    }

	    $data['total_amount_software'] = $total_amount_pcn;
	    $data['stockrecords_software'] = $stockrows;

	    //////////////////////////////////////////////////////////////////////
	    //Software Installed
	    $total_amount_pcn = 0;
	    $this->db->select('name, COUNT(id) AS total')->group_by('name')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('action_type', "install")
	          ->order_by('total', 'DESC')
	          ->limit(5);
	    $stockrows = $this->db->get('software')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['name'] = $stockrow['name'];

	    }

	    $this->db->select('name, COUNT(id) AS total')->group_by('name')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('action_type', "install")
	          ->order_by('total', 'DESC');

	    $stockrows2 = $this->db->get('software')->result_array();

	    foreach ($stockrows2 as $count => $stockrow)
	    {

	      $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
	    }

	    $data['total_amount_software_installed'] = $total_amount_pcn;
	    $data['stockrecords_software_installed'] = $stockrows;

	/***********************
	****Mobile Stock Information******
	***********************/

	    /////////////////////////////////////////////////////////////////////////////////
	    //MOBILE - IN STOCK
	    /////////////////////////////////////////////////////////////////////////////////
	    $total_amount_pcn = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
				->where('action_type !=', "checkout")
				->where('action_type !=', "repair out")
				->where('action_type !=', "recycle")
				->where('action_type !=', "decommision")
				->where('action_type !=', "removed")
	          ->order_by('total', 'DESC')
	          ->limit(5);
	    $stockrows = $this->db->get('mobile')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];

	    }

	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
			->where('action_type !=', "checkout")
				->where('action_type !=', "repair out")
				->where('action_type !=', "recycle")
				->where('action_type !=', "decommision")
				->where('action_type !=', "removed")
	          ->order_by('total', 'DESC');

	    $stockrows2 = $this->db->get('mobile')->result_array();

	    foreach ($stockrows2 as $count => $stockrow)
	    {

	      $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
	    }

	    $data['total_amount_mobile'] = $total_amount_pcn;
	    $data['stockrecords_mobile'] = $stockrows;

	    /////////////////////////////////////////////////////////////////////////////////
	    //MOBILE - NEEDS REPAIR
	    /////////////////////////////////////////////////////////////////////////////////
	    $total_amount_pcn = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
				->where('action_type', "needsrepair")
	          ->order_by('total', 'DESC')
	          ->limit(5);
	    $stockrows = $this->db->get('mobile')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];

	    }

	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
			->where('action_type', "needsrepair")
	          ->order_by('total', 'DESC');

	    $stockrows2 = $this->db->get('mobile')->result_array();

	    foreach ($stockrows2 as $count => $stockrow)
	    {

	      $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
	    }

	    $data['total_amount_mobile_needsrepair'] = $total_amount_pcn;
	    $data['stockrecords_mobile_needsrepair'] = $stockrows;

	    /////////////////////////////////////////////////////////////////////////////////
	    //MOBILE RECYCLE
	    /////////////////////////////////////////////////////////////////////////////////
	    $total_amount_pcn = 0;
	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
				->where('action_type', "recycle")
	          ->order_by('total', 'DESC')
	          ->limit(5);
	    $stockrows = $this->db->get('mobile')->result_array();

	    foreach ($stockrows as $count => $stockrow)
	    {

	      $stockrows[$count]['model'] = $stockrow['model'];

	    }

	    $this->db->select('model, COUNT(id) AS total')->group_by('model')
	          ->where('company_id =', $this->session->userdata('company_id'))
	          ->where('action_type', "recycle")
	          ->order_by('total', 'DESC');

	    $stockrows2 = $this->db->get('mobile')->result_array();

	    foreach ($stockrows2 as $count => $stockrow)
	    {

	      $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
	    }

	    $data['total_amount_mobile_recycle'] = $total_amount_pcn;
	    $data['stockrecords_mobile_recycle'] = $stockrows;

	/*******************************************/
	/*******************************************/

	    //activity quick look table
	    $this->load->library('table');
	    $tmpl = array (

	                'row_start'           => '<tr class="main">',
	                'row_end'             => '</tr>',
	                'cell_start'          => '<td>',
	                'cell_end'            => '</td>',

	                'row_alt_start'       => '<tr class="alt">',
	                'row_alt_end'         => '</tr>',
	                'cell_alt_start'      => '<td>',
	                'cell_alt_end'        => '</td>',

	          );
	    $this->table->set_template($tmpl);

	/*******************************************/
	/*******************************************/

			//pass navigation info
	    $data['active_page'] = 'computers';



		/***********************
		****Page setup******
		***********************/

		//activity quick look table
        $this->load->library('table');
        $tmpl = array (
                    'row_start'           => '<tr class="main">',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class="alt">',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',
              );
        $this->table->set_template($tmpl);


        //pass navigation info
        $data['active_page'] = 'dashboard';

        //pass the information to the view
        $data['main_content'] = 'dashboard_view';
        $this->load->view('layout/template', $data);
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
        $data['active_page'] = 'settings';
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
        $data['active_page'] = 'settings';
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
        $data['active_page'] = 'settings';
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
        $data['active_page'] = 'settings';
        $data['sub_active_page'] = 'agents';

        //pass the information to the view
        $data['main_content'] = 'dashboard_agent_view';
        $this->load->view('layout/template', $data);

	}

	public function computer_models()
	{

        //form dropdown options
        $this->load->model('computer_make_dropdown_model');
        $data['make_dropdown'] = $this->computer_make_dropdown_model->get_makes2();

		// dropdown
        $this->load->model('dashboard_model_dropdown_model');
        $data['list_models'] = $this->dashboard_model_dropdown_model->get_models();

		$data['del_model'] = array('name' => 'del_model', 'id' => 'del_model', 'value' => 'del_model', 'checked' => FALSE);

        //pass navigation info
        $data['active_page'] = 'settings';
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
        $data['active_page'] = 'settings';
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
        $data['active_page'] = 'settings';
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
        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');

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

	                $newdata = array(
	                        'ccheck'        => 1
	                        );

	                $this->session->set_userdata($newdata);

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

	                $newdata = array(
	                        'scheck'        => 1
	                        );

	                $this->session->set_userdata($newdata);

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
        $data['active_page'] = 'settings';
        $data['sub_active_page'] = 'momake';

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
        $data['active_page'] = 'settings';
        $data['sub_active_page'] = 'momodel';

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

	                $newdata = array(
	                        'mcheck'        => 1
	                        );

	                $this->session->set_userdata($newdata);

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

			$this->mobile_models();

    	}
	}

	public function detail()
	{

		$url_value = $this->uri->segment(3);
		$this->load->model('search_model');
		$data['active_page'] = 'dashboard';

		switch ($url_value)
		{

	        case "computers-in-stock";

	        	$data['query'] = $this->search_model->stock_detail($url_value);
	        	$data['detail_value'] = 'Computers in stock';
		        $data['main_content'] = 'stockpages/computers-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

			case "computers-warranty-repair";

				$data['detail_value'] = 'Computers in warranty repair';
		        $data['main_content'] = 'stockpages/software-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

	        case "computers-nonwarranty-repair";

	        	$data['detail_value'] = 'Computers in non-warranty repair';
		        $data['main_content'] = 'stockpages/software-installed';
		        $this->load->view('layout/template', $data);

	        break;

			case "computers-being-repaired";

				$data['detail_value'] = 'Computers being repaired';
		        $data['main_content'] = 'stockpages/software-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

	        case "computers-in-recycle";

	        	$data['detail_value'] = 'Computers for recycling';
		        $data['main_content'] = 'stockpages/software-installed';
		        $this->load->view('layout/template', $data);

	        break;

			case "software-in-stock";

				$data['query'] = $this->search_model->software_detail($url_value);
				$data['detail_value'] = 'Software in stock';
		        $data['main_content'] = 'stockpages/software-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

	        case "software-installed";

	        	$data['query'] = $this->search_model->software_detail($url_value);
	        	$data['detail_value'] = 'Software installed';
		        $data['main_content'] = 'stockpages/software-installed';
		        $this->load->view('layout/template', $data);

	        break;

			case "mobile-in-stock";

				$data['query'] = $this->search_model->mobile_detail($url_value);
				$data['detail_value'] = 'Mobile in stock';
		        $data['main_content'] = 'stockpages/mobile-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

	        case "mobile-needs-repair";

				$data['query'] = $this->search_model->mobile_detail($url_value);
				$data['detail_value'] = 'Mobile needs repair';
		        $data['main_content'] = 'stockpages/mobile-needs-repair';
		        $this->load->view('layout/template', $data);

	        break;

	        case "mobile-recycle";

				$data['query'] = $this->search_model->mobile_detail($url_value);
				$data['detail_value'] = 'Mobile recycle';
		        $data['main_content'] = 'stockpages/mobile-recycle';
		        $this->load->view('layout/template', $data);

	        break;

			case "mobiles-on-loan";

				$data['query'] = $this->search_model->mobile_detail($url_value);
		        $data['main_content'] = 'stockpages/mobiles-on-loan';
		        $this->load->view('layout/template', $data);

	        break;

	        case "accessories-in-stock";

				$data['query'] = $this->search_model->accessories_detail();
				$data['detail_value'] = 'Accessories In Stock';
		        $data['main_content'] = 'stockpages/accessories-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

			case "computers-on-loan";

				$data['query'] = $this->search_model->stock_detail($url_value);
		        $data['main_content'] = 'stockpages/computers-on-loan';
		        $this->load->view('layout/template', $data);

	        break;

	        case "computers-not-in-stock";

	        	$data['query'] = $this->search_model->stock_detail($url_value);
	        	$data['detail_value'] = 'Computers Not in Stock';
		        $data['main_content'] = 'stockpages/computers-not-in-stock';
		        $this->load->view('layout/template', $data);

	        break;

		}
	}

	public function upload_center()
	{

        //pass navigation info
        $data['active_page'] = 'settings';
        $data['sub_active_page'] = 'uploadcenter';

        //pass the information to the view
        $data['main_content'] = 'dashboard_uploadcenter_view';
        $this->load->view('layout/template', $data);

	}

	public function subscription()
	{

        //pass navigation info
        $data['active_page'] = 'settings';
        $data['sub_active_page'] = 'subscription';

        //pass the information to the view
        $data['main_content'] = 'dashboard_subscription_view';
        $this->load->view('layout/template', $data);

	}

	public function payment_process_month()
	{

		require_once('./config.php');

		$token  = $_POST['stripeToken'];

		$customer = Stripe_Customer::create(array(
		'email' => $this->session->userdata('email', TRUE),
		'plan' => 'onemonth27',
		'card'  => $token,
		'description' => $this->session->userdata('company_id', TRUE)
		));

        $newdatamonth = array(
                'plan'          => "onemonth"
                );

        $this->session->set_userdata($newdatamonth);

		$this->load->model('dashboard_model');

		//check
		if ($query = $this->dashboard_model->payment_update_account_onemonth())
		{
			//succesfull add, set message
			$this->session->set_flashdata('message', 'Thank you for your monthly subscription, your account has been updated');

		} else {

			//failed to add, set message
			$this->session->set_flashdata('messagebad', 'Thank you for your payment');

		}

		redirect('settings');

	}

	public function payment_process_year()
	{

		require_once('./config.php');

		$token  = $_POST['stripeToken'];

		$customer = Stripe_Customer::create(array(
		'email' => $this->session->userdata('email', TRUE),
		'plan' => 'oneyear500',
		'card'  => $token,
		'description' => $this->session->userdata('company_id', TRUE)
		));

        $newdatayear = array(
                'plan'          => "oneyear"
                );

        $this->session->set_userdata($newdatayear);

		$this->load->model('dashboard_model');

		//check
		if ($query = $this->dashboard_model->payment_update_account_oneyear())
		{
			//succesfull add, set message
			$this->session->set_flashdata('message', 'Thank you for your yearly subscription, your account has been updated');

		} else {

			//failed to add, set message
			$this->session->set_flashdata('messagebad', 'Thank you for your payment');

		}

		redirect('settings');

	}

	public function del_account()
	{

		// load form validation
	    $this->load->library('form_validation');

	    // set validation rules
	    $this->form_validation->set_rules('feedback', 'Feedback', 'required|trim');

	    //run form validation
	    if ($this->form_validation->run())
		{

			$this->load->model('dashboard_model');

			if ($this->dashboard_model->del_account())
			{

		        $newdata = array(
		        	'logged_in'     => FALSE,
		        );

		        $this->session->set_userdata($newdata);
		        $this->session->set_flashdata('message', 'Account has been updated, thank you.');
		        redirect('login');

			}
		}

		$this->session->set_flashdata('messagebad', 'Something went wrong, please try again');
		redirect('dashboard/subscription');
	}
}