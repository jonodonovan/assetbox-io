<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model
{
	function get_search()
	{

		if ($this->input->post('search') == '')
		{
			$this->db->where('company_id', $this->session->userdata('company_id'));
			$this->db->limit(100);
			$this->db->order_by('date_created', 'DESC');
			$query = $this->db->get_where('computer_history');
			return $query->result();
		}

		$match = $this->input->post('search');

		$this->db->having('company_id =', $this->session->userdata('company_id'));
		$this->db->like('asset_tag', $match);
		$this->db->or_like('ticket_num', $match);
		$this->db->or_like('tracking_num', $match);
		$this->db->or_like('action_type', $match);
		$this->db->or_like('serial_num', $match);
		$this->db->or_like('part_num', $match);
		$this->db->or_like('make', $match);
		$this->db->or_like('model', $match);
		$this->db->or_like('user_id', $match);
		$this->db->or_like('reason', $match);
		$this->db->or_like('date_created', $match);
		$this->db->limit(100);
		$this->db->order_by('date_created', 'DESC');
		$query = $this->db->get_where('computer_history');
		return $query->result();
	}

	function get_software_search()
	{

		if ($this->input->post('search') == '')
		{
			$this->db->where('company_id', $this->session->userdata('company_id'));
			$this->db->limit(100);
			$this->db->order_by('date_created', 'DESC');
			$query = $this->db->get_where('software_history');
			return $query->result();
		}

		$match = $this->input->post('search');

		$this->db->having('company_id =', $this->session->userdata('company_id'));
		$this->db->like('action_type', $match);
		$this->db->or_like('manufacturer', $match);
		$this->db->or_like('name', $match);
		$this->db->or_like('license', $match);
		$this->db->or_like('computer_ser', $match);
		$this->db->or_like('price', $match);
		$this->db->limit(100);
		$this->db->order_by('date_created', 'DESC');
		$query = $this->db->get_where('software_history');
		return $query->result();
	}

	function get_mobile_search()
	{

		if ($this->input->post('search') == '')
		{
			$this->db->where('company_id', $this->session->userdata('company_id'));
			$this->db->limit(100);
			$this->db->order_by('date_created', 'DESC');
			$query = $this->db->get_where('mobile_history');
			return $query->result();
		}

		$match = $this->input->post('search');

		$this->db->having('company_id =', $this->session->userdata('company_id'));
		$this->db->like('action_type', $match);
		$this->db->or_like('make', $match);
		$this->db->or_like('model', $match);
		$this->db->or_like('number', $match);
		$this->db->or_like('device_id', $match);
		$this->db->or_like('price', $match);
		$this->db->or_like('location', $match);
		$this->db->or_like('user_id', $match);
		$this->db->limit(100);
		$this->db->order_by('date_created', 'DESC');
		$query = $this->db->get_where('mobile_history');
		return $query->result();
	}

	function stock_detail ($value)
	{

		//check the value
        if ($value == "computers-in-stock")
		{
			$this->db->order_by("model", "desc");
			$this->db->select("action_type, ticket_num, tracking_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id', $this->session->userdata('company_id'))
						->where('type_var', "pcn")
						->where('action_type !=', "checkout")
						->where('action_type !=', "computer deleted")
						->where('action_type !=', "recycle")
						->where('action_type !=', "repairout")
						->where('action_type !=', "needsrepair")
						->where('action_type !=', "audit_missing")
						->where('action_type !=', "stockout")
						->where('action_type !=', "warranty")
						->where('action_type !=', "removed")
						->where('action_type !=', "lost_stolen");
			$query = $this->db->get('computer');
			return $query->result();
        }
		elseif ($value == "assets-needing-warranty-repair")
		{
			$this->db->order_by("model", "desc");
			$this->db->select("ticket_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id =', $this->session->userdata('company_id'));
			$this->db->where('type_var =', "pcn");
			$this->db->where('action_type =', "warranty");
			$query = $this->db->get('computer');
			return $query->result();
        }
		elseif ($value == "assets-needing-nonwarranty-repair")
		{
			$this->db->order_by("model", "desc");
			$this->db->select("ticket_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id =', $this->session->userdata('company_id'));
			$this->db->where('type_var =', "pcn");
			$this->db->where('action_type =', "needsrepair");
			$query = $this->db->get('computer');
			return $query->result();
		}
		elseif ($value == "assets-out-for-repair")
		{
			$this->db->order_by("model", "desc");
			$this->db->select("ticket_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id =', $this->session->userdata('company_id'));
			$this->db->where('type_var =', "pcn");
			$this->db->where('action_type =', "repairout");
			$query = $this->db->get('computer');
			return $query->result();
		}
		elseif ($value == "assets-ready-for-recycling")
		{
			$this->db->order_by("model", "desc");
			$this->db->select("action_type, ticket_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id =', $this->session->userdata('company_id'));
			$this->db->where('type_var =', "pcn");
			$this->db->where('action_type =', "recycle");
			$this->db->or_where('action_type =', "decom");
			$query = $this->db->get('computer');
			return $query->result();
        }
		elseif ($value == "removed-assets")
		{
			$this->db->order_by("model", "desc");
			$this->db->select("ticket_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id =', $this->session->userdata('company_id'));
			$this->db->where('type_var =', "pcn");
			$this->db->where('action_type =', "removed");
			$query = $this->db->get('computer');
			return $query->result();

        } elseif ($value == "computers-on-loan") {

		//load and setup table library
        $this->load->library('table');

        $tmpl = array (
                    'table_open'	=> '<table id="myTable" class="tablesorter">',
                    'table_close'	=> '</table>'
              );

        $this->table->set_template($tmpl);

        $this->table->set_heading('Return Date', 'Action', 'Ticket', 'Model', 'Serial', 'User', 'Location', 'Agent', 'reason', 'Date Updated');


			$this->db->order_by("date_updated", "desc");
			$this->db->select("temp_date, action_type, ticket_num, model, serial_num, user_id, location, added_by, reason, date_updated");
			$this->db->where('company_id', $this->session->userdata('company_id'))
			          ->where('temp_date !=', '0000-00-00');
			$rows = $this->db->get('computer')->result_array();

	        foreach ($rows as $count => $row)
	        {

	            if ($rows[$count]['serial_num'] != '')
	            {
	                $rows[$count]['serial_num'] = anchor('itemprofile/index/c/'.$row['serial_num'],$row['serial_num']);
	            }

	            if ($rows[$count]['added_by'] != NULL)
	            {
	                $rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));
	            }
	        }

			return $rows;

        } elseif ($value == "computers-not-in-stock") {

		//load and setup table library
        $this->load->library('table');

        $tmpl = array (
                    'table_open'	=> '<table id="myTable" class="tablesorter">',
                    'table_close'	=> '</table>'
              );

        $this->table->set_template($tmpl);

        $this->table->set_heading('Action', 'Ticket', 'Tracking', 'Serial', 'Part', 'Model', 'User', 'Agent', 'reason', 'Date Updated');


			$this->db->order_by("model", "desc");
			$this->db->select("action_type, ticket_num, tracking_num, serial_num, part_num, model, user_id, added_by, reason, date_created");
			$this->db->where('company_id', $this->session->userdata('company_id'))
				->where('type_var =', "pcn")
				->where('action_type !=', "add")
				->where('action_type !=', "checkin")
				->where('action_type !=', "recycle")
				->where('action_type !=', "repairin")
				->where('action_type !=', "needsrepair")
				->where('action_type !=', "audit_missing")
				->where('action_type !=', "stockin")
				->where('action_type !=', "warranty")
				->where('action_type !=', "removed")
				->where('action_type !=', "computer deleted")
				->where('action_type !=', "lost_stolen");
			$rows = $this->db->get('computer')->result_array();

	        foreach ($rows as $count => $row)
	        {

	            if ($rows[$count]['serial_num'] != '')
	            {
	                $rows[$count]['serial_num'] = anchor('itemprofile/index/c/'.$row['serial_num'],$row['serial_num']);
	            }

	            if ($rows[$count]['added_by'] != NULL)
	            {
	                $rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));
	            }
	        }

			return $rows;
        }
	}

	function software_detail ($value)
	{

		//check the value
        if ($value == "software-in-stock")
		{

		//load and setup table library
        $this->load->library('table');

        $tmpl = array (
                    'table_open'	=> '<table id="myTable" class="tablesorter">',
                    'table_close'	=> '</table>'
              );

        $this->table->set_template($tmpl);

        $this->table->set_heading('Action','Manufacturer', 'Software Name', 'License', 'Computer Serial', 'Agent', 'Date', '');


			$this->db->order_by("name", "desc");
			$this->db->select("action_type, manufacturer, name, license, computer_ser, added_by, date_created, sw_code");
			$this->db->where('company_id', $this->session->userdata('company_id'))
			          ->where('action_type !=', "stock remove")
			          ->where('action_type !=', "install")
			          ->where('action_type !=', "license deleted");
			$rows = $this->db->get('software')->result_array();

	        foreach ($rows as $count => $row)
	        {

	            if ($rows[$count]['computer_ser'] != '')
	            {
	                $rows[$count]['computer_ser'] = anchor('itemprofile/index/c/'.$row['computer_ser'],$row['computer_ser']);
	            }

	            if ($rows[$count]['license'] != '')
	            {
	                $rows[$count]['license'] = anchor('itemprofile/index/s/'.$row['sw_code'],$row['license']);
	            }

	            if ($rows[$count]['added_by'] != NULL)
	            {
	                $rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));
	            }

	            $rows[$count]['sw_code'] = "";
	        }

			return $rows;
        }
		//check the value
        elseif ($value == "software-installed")
		{
			$this->db->order_by("name", "desc");
			$this->db->select("action_type, manufacturer, name, license, computer_ser, added_by, date_created");
			$this->db->where('company_id', $this->session->userdata('company_id'))
						->where('action_type !=', "stock add")
						->where('action_type !=', "computer deleted")
						->where('action_type !=', "uninstall")
						->where('action_type !=', "edit")
						->where('action_type !=', "license deleted");
			$query = $this->db->get('software');
			return $query->result();
        }
	}

	function mobile_detail ($value)
	{

		//check the value
        if ($value == "mobile-in-stock")
		{
			$this->db->order_by("date_created", "desc");
			$this->db->select("action_type, device_id, number, make, model, ticket_num, user_id, reason, tracking_num, added_by, date_created");
			$this->db->where('company_id', $this->session->userdata('company_id'))
						->where('action_type !=', "checkout")
						->where('action_type !=', "repair out")
						->where('action_type !=', "recycle")
						->where('action_type !=', "decommision")
						->where('action_type !=', "removed")
						->where('action_type !=', "edit");
			$query = $this->db->get('mobile');
			return $query->result();
        }
        elseif ($value == "mobile-needs-repair")
        {
			$this->db->order_by("date_created", "desc");
			$this->db->select("action_type, device_id, number, make, model, ticket_num, user_id, reason, tracking_num, added_by, date_created");
			$this->db->where('company_id', $this->session->userdata('company_id'))
						->where('action_type', "needsrepair");
			$query = $this->db->get('mobile');
			return $query->result();

        }
        elseif ($value == "mobile-recycle")
        {

			$this->db->order_by("date_created", "desc");
			$this->db->select("action_type, device_id, number, make, model, ticket_num, user_id, reason, tracking_num, added_by, date_created");
			$this->db->where('company_id', $this->session->userdata('company_id'))
						->where('action_type', "recycle");
			$query = $this->db->get('mobile');
			return $query->result();

        } elseif ($value == "mobiles-on-loan") {

		//load and setup table library
        $this->load->library('table');

        $tmpl = array (
                    'table_open'	=> '<table id="myTable" class="tablesorter">',
                    'table_close'	=> '</table>'
              );

        $this->table->set_template($tmpl);

        $this->table->set_heading('Return Date', 'Action', 'Ticket', 'Model', 'Device', 'User', 'Location', 'Agent', 'reason', 'Date Updated');


			$this->db->order_by("date_created", "desc");
			$this->db->select("temp_date, action_type, ticket_num, model, device_id, user_id, location, added_by, reason, date_updated");
			$this->db->where('company_id', $this->session->userdata('company_id'))
			          ->where('temp_date !=', '0000-00-00');
			$rows = $this->db->get('mobile')->result_array();

	        foreach ($rows as $count => $row)
	        {

	            if ($rows[$count]['device_id'] != '')
	            {
	                $rows[$count]['device_id'] = anchor('itemprofile/index/m/'.$row['device_id'],$row['device_id']);
	            }

	            if ($rows[$count]['added_by'] != NULL)
	            {
	                $rows[$count]['added_by'] = substr($row['added_by'], 0, strpos($row['added_by'], "@"));
	            }
	        }

			return $rows;
        }
	}

	function accessories_detail ()
	{

		//load and setup table library
        $this->load->library('table');

        $tmpl = array (
                    'table_open'	=> '<table id="myTable" class="tablesorter">',
                    'table_close'	=> '</table>'
              );

        $this->table->set_template($tmpl);

        $this->table->set_heading('Action','Ticket Number', 'Model', 'User', 'Agent','Reason', 'Date');

		$this->db->order_by("model", "desc");
		$this->db->select("action_type, ticket_num, model, user_id, added_by, reason, date_created");
		$this->db->where('company_id =', $this->session->userdata('company_id'));
		$this->db->where('type_var =', "acc");
		$this->db->where('action_type =', "checkin");
		$rows = $this->db->get('computer')->result_array();
		return $rows;
	}
}