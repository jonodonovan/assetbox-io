<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*

	|
	|
	|	Asset (item) profile page setup
	|	Last updated: 20140907
	|
	|
	|

	*/



class Itemprofile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		session_start();

		//	Check if user is logged in

		if (!$this->session->userdata('logged_in'))
		{
			//	Not logged in, redirect

			redirect('login');

		}
	}

	public function index()
	{
		//	Validate if the profile belongs to logged in user

        $this->load->model('item_model');

        if(!$query = $this->item_model->company_check())
		{
            //	Validation failed, wrong company

            redirect('error404');

        }

        //	Get the serial number from URI

		$item_number = $this->uri->segment(4);
		$data['item_number'] = $item_number;

		//	Check if there is an edit submission

		if ($this->uri->segment(5) == 'edit')
		{

			// Check for computer.

			if ($this->uri->segment(3) == 'c')
			{

				//	Load form validation

		        $this->load->library('form_validation');

		        //	Set validation rules

		        $this->form_validation->set_rules('atag', 'Asset Tag', 'trim');

		        //	Check the asset tag/serial number

		        if ($query = $this->item_model->check_assettag())
	        	{

					//	Results are true

					$this->session->set_flashdata('messagebad', 'This asset tag is already used by another computer!');
					redirect('itemprofile/index/c/'.$item_number);

	        	} else {

	        		//	Results are false

	        		$this->form_validation->set_rules('action_type', 'Action', 'trim|required');
					$this->form_validation->set_rules('cpu', 'CPU', 'trim');
					$this->form_validation->set_rules('ram', 'RAM', 'trim');
					$this->form_validation->set_rules('hdd', 'HDD', 'trim');
					$this->form_validation->set_rules('os', 'OS', 'trim');
					$this->form_validation->set_rules('company', 'Company', 'trim');
			        $this->form_validation->set_rules('hostname', 'Hostname', 'trim');
			        $this->form_validation->set_rules('part_num', 'Part Number', 'trim');
			        $this->form_validation->set_rules('atag', 'Asset Tag', 'trim');
			        $this->form_validation->set_rules('user_id', 'user_id', 'trim');
			        $this->form_validation->set_rules('location', 'location', 'trim');
			        $this->form_validation->set_rules('reason', 'Reason', 'trim|required');
			        $this->form_validation->set_rules('purchased_date', 'Purchased Date', 'trim');
		        	$this->form_validation->set_rules('purchased_from', 'Purchased From', 'trim');
			        $this->form_validation->set_rules('support_name', 'Support Name', 'trim');
			        $this->form_validation->set_rules('support_number', 'Support Number', 'trim');
			        $this->form_validation->set_rules('scsd', 'Support Contract Start Date', 'trim');
			        $this->form_validation->set_rules('sced', 'Support Contract End Date', 'trim');
			        $this->form_validation->set_rules('price', 'Price', 'trim');
			        $this->form_validation->set_rules('temp_date', 'Temporary Use Date', 'trim');
			        $this->form_validation->set_rules('temp_notes', 'Temporary Use Notes', 'trim');

			        //	Run form validation

			        if($this->form_validation->run())
					{

			            if($query = $this->item_model->edit_computer_item())
						{
			                $this->session->set_flashdata('message', 'Item Updated');

			                //	Validation passes

			                redirect('itemprofile/index/c/'.$item_number);

			            } else {

							$this->session->set_flashdata('message', 'Failed to update');

							//	Validation failed

			                redirect('itemprofile/index/c/'.$item_number);

			            }
			        }
		        }

		    //	Not Computer, it's mobile.

	        } else if ($this->uri->segment(3) == 'm') {

	        	//	Load form validation

		        $this->load->library('form_validation');

		        //	Set validation rules

		        $this->form_validation->set_rules('device_id', 'Device ID', 'trim');
		        $this->form_validation->set_rules('ced', 'Contract End Date', 'trim');
		        $this->form_validation->set_rules('crd', 'Contract Recycle Date', 'trim');
		        $this->form_validation->set_rules('user', 'User', 'trim');
		        $this->form_validation->set_rules('phone_num', 'Phone Number', 'trim');
		        $this->form_validation->set_rules('location', 'Location', 'trim');
		        $this->form_validation->set_rules('price', 'Price', 'trim');
		        $this->form_validation->set_rules('reason', 'Reason', 'trim|required');
		        $this->form_validation->set_rules('temp_date', 'Temporary Use Date', 'trim');
		        $this->form_validation->set_rules('temp_notes', 'Temporary Use Notes', 'trim');

		        //	Run form validation

		        if($this->form_validation->run())
				{

		            $this->load->model('item_model');

		            if($query = $this->item_model->edit_mobile_item())
					{
		                $this->session->set_flashdata('message', 'Item Updated');

		                //	Validation passes

		                redirect('itemprofile/index/m/'.$item_number);

		            } else {

						$this->session->set_flashdata('message', 'Failed to update');

						//	Validation failed

		                redirect('itemprofile/index/m/'.$item_number);

		            }
		        }

	        } else if ($this->uri->segment(3) == 's') {

				//	Load form validation

		        $this->load->library('form_validation');

		        //	Set validation rules

		        $this->form_validation->set_rules('purchased_date', 'Purchased Date', 'trim');
		        $this->form_validation->set_rules('purchased_from', 'Purchased From', 'trim');
		        $this->form_validation->set_rules('csd', 'Contract Start Date', 'trim');
		        $this->form_validation->set_rules('ced', 'Contract End Date', 'trim');
		        $this->form_validation->set_rules('support_name', 'Support Name', 'trim');
		        $this->form_validation->set_rules('support_number', 'Support Number', 'trim');
		        $this->form_validation->set_rules('scsd', 'Support Contract Start Date', 'trim');
		        $this->form_validation->set_rules('sced', 'Support Contract End Date', 'trim');
		        $this->form_validation->set_rules('price', 'Price', 'trim');
		        $this->form_validation->set_rules('device_id', 'License Number', 'trim');
		        $this->form_validation->set_rules('reason', 'Reason', 'trim|required');

		        //	Run form validation

		        if($this->form_validation->run())
				{

		            $this->load->model('item_model');

		            if($query = $this->item_model->edit_software_item())
					{
		                $this->session->set_flashdata('message', 'Item Updated');

		                //	Validation passes

		                redirect('itemprofile/index/s/'.$item_number);

		            } else {

						$this->session->set_flashdata('message', 'Failed to update');

						//	Validation failed

		                redirect('itemprofile/index/s/'.$item_number);

		            }
		        }

	        }
		}

		//load and setup pagination
        $this->load->library('pagination');

		if ($this->uri->segment(3) == "c"){

			$config['base_url'] = '/itemprofile/index/c/' . $item_number;
			$config['total_rows'] = $this->db->where('serial_num', $item_number)->get('computer_history')->num_rows();

		} elseif ($this->uri->segment(3) == "m") {

			$config['base_url'] = '/itemprofile/index/m/' . $item_number;
			$config['total_rows'] = $this->db->where('device_id', $item_number)->get('mobile_history')->num_rows();

		} elseif ($this->uri->segment(3) == "s") {

			$config['base_url'] = '/itemprofile/index/s/' . $item_number;
			$config['total_rows'] = $this->db->where('sw_code', $item_number)->get('software_history')->num_rows();

		}

		$config['uri_segment'] = 5;
        $config['per_page'] = 5;
        $config['num_links'] = 9;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        //load and setup table library
        $this->load->library('table');

		if ($this->uri->segment(3) == "c")
		{

	    	/*

	    	|
			|
			| START Computer Page Setup
			|
			|

	    	*/

	        //check to see if the serial number already exists
	        $this->db->select('action_type');
	        $this->db->where('serial_num', $item_number);
	        $this->db->where('company_id', $this->session->userdata('company_id'));

	        $q = $this->db->get('computer');

	        if ($q->row()->action_type === "computer deleted")
	        {
	            $data['is_deleted'] = "yes";

	        } else {

	            $data['is_deleted'] = "no";
	        }

	        //form dropdown options for action_type
	        $data['action_type'] = array(
					'checkin'  => 'Check In',
					'checkout' => 'Check Out',
					'warranty' => 'Warranty Repair',
					'needsrepair' => 'Non-Warranty Repair',
					'repairin' => 'Repair In',
					'repairout' => 'Repair out',
					'decom' => 'Decommission',
					'edit' => 'Edit',
					'recycle' => 'Recycle'
			);

			//query db for history table
			$this->db->order_by('id', 'desc');
			$this->db->where('serial_num', $item_number);
			$this->db->where('company_id', $this->session->userdata('company_id'));
			$this->db->select('action_type, ticket_num, user_id, reason, added_by, date_created');
			$rows = $this->db->get('computer_history', $config['per_page'], $this->uri->segment(5))->result_array();

			foreach ($rows as $count => $row)
			{

				if ($rows[$count]['added_by'] != NULL)
				{

				$rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));

				}
			}

			$data['records'] = $rows;

			//query db for software table
			$this->db->order_by('id', 'desc');
			$this->db->where('computer_ser', $item_number)->where('action_type', 'install');
			$this->db->select('manufacturer, name, license, added_by, date_created');
			$sw_rows = $this->db->get('software')->result_array();

			foreach ($sw_rows as $count_sw => $row)
			{
				if ($sw_rows[$count_sw]['added_by'] != NULL)
				{

					$sw_rows[$count_sw]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));
				}

				if ($sw_rows[$count_sw]['license'])
				{
					$sw_rows[$count_sw]['license'] = anchor('itemprofile/index/s/'.$row['license'],$row['license']);
				}
			}

			$data['sw_records'] = $sw_rows;

			//query for form data
			$this->db->select('cpu, ram, hdd, os, company, asset_tag, part_num, make, model, user_id, hostname, action_type, location, price, purchased_date, purchased_from, support_name, support_number, scsd, sced, temp_date, temp_notes');
			$this->db->where('serial_num', $item_number);
			$this->db->limit(1);
			$query = $this->db->get('computer');

			//echo $item_serial;
			$part_num = $query->row()->part_num;
			$serial_num =  $query->row()->serial_num;
			//die();

			$data['action_type_set'] = $query->row()->action_type;
			$data['atag'] = $query->row()->asset_tag;
			$data['hostname'] = $query->row()->hostname;
			$data['cpu'] = $query->row()->cpu;
			$data['ram'] = $query->row()->ram;
			$data['hdd'] = $query->row()->hdd;
			$data['os'] = $query->row()->os;
			$data['company'] = $query->row()->company;
			$data['part_num'] = $part_num;
			$data['model'] = $query->row()->model;
			$data['make'] = $query->row()->make;
			$data['user_id'] = $query->row()->user_id;
			$data['location'] = $query->row()->location;
			$data['purchased_date'] = $query->row()->purchased_date;
			$data['purchased_from'] = $query->row()->purchased_from;
			$data['support_name'] = $query->row()->support_name;
			$data['support_number'] = $query->row()->support_number;
			$data['scsd'] = $query->row()->scsd;
			$data['sced'] = $query->row()->sced;
			$data['price'] = $query->row()->price;
			$data['temp_date'] = $query->row()->temp_date;
			$data['temp_notes'] = $query->row()->temp_notes;

	        //pass navigation info
    		$data['active_page'] = 'computers';

	    	/*

	    	|
			|
			| END Computer Page Setup
			|
			|

	    	*/

		} else if ($this->uri->segment(3) == "m") {

	    	/*

	    	|
			|
			| START Mobile Page Setup
			|
			|

	    	*/

	        //check to see if the serial number already exists
	        $this->db->select('action_type');
	        $this->db->where('device_id', $item_number);
	        $this->db->where('company_id', $this->session->userdata('company_id'));

	        $q = $this->db->get('mobile');

	        if ($q->row()->action_type === "mobile deleted")
	        {
	            $data['is_deleted'] = "yes";

	        } else {

	            $data['is_deleted'] = "no";
	        }

			//query db for table
			$this->db->order_by('id', 'desc');
			$this->db->where('device_id', $item_number);
			$this->db->where('company_id', $this->session->userdata('company_id'));
			$this->db->select('action_type, number, ticket_num, user_id, reason, added_by, date_created');
			$rows = $this->db->get('mobile_history', $config['per_page'], $this->uri->segment(5))->result_array();

			foreach ($rows as $count => $row)
			{

				if ($rows[$count]['added_by'] != NULL)
				{

				$rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));

				}
			}

			$data['mobile_records'] = $rows;

			//query for form data
			$this->db->select('ced, crd, user_id, number, location, price, make, model, temp_date, temp_notes');
			$this->db->where('device_id', $item_number);
			$this->db->limit(1);
			$query = $this->db->get('mobile');

			$data['ced'] = $query->row()->ced;
			$data['crd'] = $query->row()->crd;
			$data['user_id'] = $query->row()->user_id;
			$data['number'] = $query->row()->number;
			$data['location'] = $query->row()->location;
			$data['price'] = $query->row()->price;
			$data['make'] = $query->row()->make;
			$data['model'] = $query->row()->model;
			$data['temp_date'] = $query->row()->temp_date;
			$data['temp_notes'] = $query->row()->temp_notes;

	        //pass navigation info
	        $data['active_page'] = 'mobile';

	    	/*

	    	|
			|
			| END Mobile Page Setup
			|
			|

	    	*/


		} else if ($this->uri->segment(3) == "s") {

			/*

	    	|
			|
			| START Software Page Setup
			|
			|

	    	*/

	        //check to see if the serial number already exists
	        $this->db->select('action_type');
	        $this->db->where('sw_code', $item_number);
	        $this->db->where('company_id', $this->session->userdata('company_id'));

	        $q = $this->db->get('software');

	        if ($q->row()->action_type === "license deleted")
	        {
	            $data['is_deleted'] = "yes";

	        } else {

	            $data['is_deleted'] = "no";
	        }

			//	Get software data

			$this->db->order_by('id', 'desc');
			$this->db->where('sw_code', $item_number);
			$this->db->where('company_id', $this->session->userdata('company_id'));
			$this->db->select('action_type, license, reason, added_by, date_created');
			$rows = $this->db->get('software_history', $config['per_page'], $this->uri->segment(5))->result_array();

			foreach ($rows as $count => $row)
			{

				if ($rows[$count]['added_by'] != NULL)
				{

				$rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));

				}
			}

			$data['software_records'] = $rows;

			//query for form data
			$this->db->select('license, ced, csd, manufacturer, name, purchased_date, purchased_from, price, support_name, support_number, scsd, sced, computer_ser');
			$this->db->where('sw_code', $item_number);
			$this->db->limit(1);
			$query = $this->db->get('software');

			$data['license'] = $query->row()->license;
			$data['csd'] = $query->row()->csd;
			$data['csd'] = $query->row()->csd;
			$data['ced'] = $query->row()->ced;
			$data['manufacturer'] = $query->row()->manufacturer;
			$data['name'] = $query->row()->name;

			$data['purchased_date'] = $query->row()->purchased_date;
			$data['purchased_from'] = $query->row()->purchased_from;
			$data['support_name'] = $query->row()->support_name;
			$data['support_number'] = $query->row()->support_number;
			$data['scsd'] = $query->row()->scsd;
			$data['sced'] = $query->row()->sced;
			$data['price'] = $query->row()->price;
			$data['computer_ser'] = $query->row()->computer_ser;

	        //pass navigation info
	        $data['active_page'] = 'software';

	    	/*

	    	|
			|
			| END Software Page Setup
			|
			|

	    	*/

		}

		//pass success or failed message
		$data['message'] = $this->session->flashdata('status');

		//pass success or failed message
		$data['messagebad'] = $this->session->flashdata('messagebad');

		//pass menu info
		$data['main_content'] = 'itemprofile_view';
		$this->load->view('layout/template', $data);
	}

	function del_computer()
	{

		$this->load->model('itemprofile_model');

		if(!$query = $this->itemprofile_model->check_user())
		{
			$this->session->set_flashdata('messagebad', 'Failed');
			redirect('computers');

		} else {

			if ($query = $this->itemprofile_model->del_computer())
			{

				$this->session->set_flashdata('message', 'Computer deleted');
				redirect('computers');

			} else {

				$this->session->set_flashdata('messagebad', 'Failed to delete');
				redirect('computers');

			}

		}
	}
	function del_license()
	{

		$this->load->model('itemprofile_model');

		if(!$query = $this->itemprofile_model->check_user_software())
		{
			$this->session->set_flashdata('messagebad', 'Failed at check');
			redirect('software');

		} else {

			if ($query = $this->itemprofile_model->del_license())
			{

				$this->session->set_flashdata('message', 'License deleted');
				redirect('software');

			} else {

				$this->session->set_flashdata('messagebad', 'Failed to delete');
				redirect('software');

			}

		}
	}

	function del_mobile()
	{

		$this->load->model('itemprofile_model');

		if(!$query = $this->itemprofile_model->check_user_mobile())
		{
			$this->session->set_flashdata('messagebad', 'Failed');
			redirect('mobile');

		} else {

			if ($query = $this->itemprofile_model->del_mobile())
			{

				$this->session->set_flashdata('message', 'Mobile deleted');
				redirect('mobile');

			} else {

				$this->session->set_flashdata('messagebad', 'Failed to delete');
				redirect('mobile');

			}

		}
	}
}