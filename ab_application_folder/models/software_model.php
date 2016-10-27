<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Software_model extends CI_Model
{
	function get_history()
	{
		//load and setup pagination
	    $this->load->library('pagination');

        $config['base_url'] = '/software/index';
        $config['total_rows'] = $this->db->where('company_id', $this->session->userdata('company_id'))->get('software_history')->num_rows();
        $config['per_page'] = 8;
        $config['num_links'] = 9;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '&laquo; first';
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

        $this->table->set_heading('Action','Ticket Number', 'Software Name', 'License', 'Computer Serial', 'Agent', 'Date', '');

		//get table information
		$this->db->order_by("date_created", "desc");
		$this->db->select("action_type, ticket_num, name, license, computer_ser, added_by, date_created, sw_code");
		$this->db->where('company_id =', $this->session->userdata('company_id'));
		$rows = $this->db->get('software_history', $config['per_page'], $this->uri->segment(3))->result_array();

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

    function check_software_license()
    {

        //check to see if the serial number already exists
        $q = $this->db->where('license', $this->input->post('license_num'))->where('action_type', 'install')->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }

    function check_software_license_for_stockadd()
    {

        //check to see if the serial number already exists
        $q = $this->db->where('license', $this->input->post('license_num'))->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }

    function uninstall_software_license()
    {
        //$this->input->post('computer')
        //check to see if the serial number already exists
        $q = $this->db->where('license', $this->input->post('license_num'))->where('computer_ser', $this->input->post('computer'))->where('action_type', 'install')->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }


    function check_software_license_add()
    {

        //check to see if the serial number already exists
        $q = $this->db->where('license', $this->input->post('license_num'))->where('action_type', 'software add')->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }

    function check_software_name()
    {

        //check to see if the serial number already exists
        $q = $this->db
                ->where('action_type', "install")
                ->where('computer_ser', $this->input->post('computer'))
                ->where('name', $this->input->post('sw_name'))
                ->where('company_id', $this->session->userdata('company_id'))
                ->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }

    function software_submit_no_license()
    {
        $manunum = $this->input->post('manufacturer_dropdown');

        $this->db->select('manufacturer_name');
        $this->db->where('id', $manunum);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('software_manufacturers');
        $manu = $query->row()->manufacturer_name;

        $new_item_insert_data = array(
            'action_type' => 'install',
            'manufacturer' => $manu,
            'name' => $this->input->post('sw_name'),
            'license' => $this->input->post('license_num'),
            'computer_ser' => $this->input->post('computer'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_created' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert data
        $update = $this->db->insert('software', $new_item_insert_data);
        $insert_id = $this->db->insert_id();

        //build array for history db
        $new_item_insert_history = array(
            'action_type' => 'install',
            'manufacturer' => $manu,
            'name' => $this->input->post('sw_name'),
            'license' => $this->input->post('license_num'),
            'computer_ser' => $this->input->post('computer'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert2 = $this->db->insert('software_history', $new_item_insert_history);

        return $insert2;

    }


    function software_submit()
	{
        $swcode = uniqid();
		$manunum = $this->input->post('manufacturer_dropdown');

        $this->db->select('manufacturer_name');
        $this->db->where('id', $manunum);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('software_manufacturers');
        $manu = $query->row()->manufacturer_name;

        $this->db->select('id, sw_code');
        $this->db->where('license', $this->input->post('license_num'));
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('software');
        $sw_code = $query->row()->sw_code;
        $item_id = $query->row()->id;

        if ($this->input->post('action_type') == 'install')
        {

	        //check to see if the serial number already exists
	        $q = $this->db->where('license', $this->input->post('license_num'))->limit(1)->get('software');

	        if ($q->num_rows == 1)
	        {
	        	//if row found
                //build array for item db insert
				$new_item_insert_data = array(
				    'action_type' => 'install',
				    'manufacturer' => $manu,
				    'name' => $this->input->post('sw_name'),
				    'license' => $this->input->post('license_num'),
                    'ticket_num' => $this->input->post('ticket_num'),
				    'computer_ser' => $this->input->post('computer'),
				    'added_by' => $this->session->userdata('email'),
				    'company_id' => $this->session->userdata('company_id'),
				    'date_created' => date("Y-m-d H:i:s"),
				    'ip' => $this->input->ip_address()
				);

				//insert data
				$update = $this->db->where('license', $this->input->post('license_num'))->where('name', $this->input->post('sw_name'))->where('company_id', $this->session->userdata('company_id'))->update('software', $new_item_insert_data);
				$insert_id = $this->db->insert_id();

	            //build array for history db
	            $new_item_insert_history = array(
	                'action_type' => 'install',
                    'sw_code' => $sw_code,
                    'item_id' => $item_id,
	                'manufacturer' => $manu,
	                'name' => $this->input->post('sw_name'),
	                'license' => $this->input->post('license_num'),
                    'ticket_num' => $this->input->post('ticket_num'),
	                'computer_ser' => $this->input->post('computer'),
	                'added_by' => $this->session->userdata('email'),
	                'company_id' => $this->session->userdata('company_id'),
	                'ip' => $this->input->ip_address()
	             );

	            //insert history data
	            $insert2 = $this->db->insert('software_history', $new_item_insert_history);

	            return $insert2;


	        } else {

	            //if row not found
	            //build array for item db insert
	            $new_item_insert_data = array(
	                'action_type' => $this->input->post('action_type'),
	                'manufacturer' => $manu,
	                'name' => $this->input->post('sw_name'),
	                'license' => $this->input->post('license_num'),
                    'ticket_num' => $this->input->post('ticket_num'),
	                'computer_ser' => $this->input->post('computer'),
	                'added_by' => $this->session->userdata('email'),
	                'company_id' => $this->session->userdata('company_id'),
	                'date_created' => date("Y-m-d H:i:s"),
	                'ip' => $this->input->ip_address()
	            );

	            //insert data
	            $update = $this->db->insert('software', $new_item_insert_data);
	            $insert_id = $this->db->insert_id();
	        }


            //build array for history db
            $new_item_insert_history = array(
                'action_type' => $this->input->post('action_type'),
                'sw_code' => $sw_code,
                'item_id' => $item_id,
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'computer_ser' => $this->input->post('computer'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
             );

            //insert history data
            $insert2 = $this->db->insert('software_history', $new_item_insert_history);

            return $insert2;



        } elseif ($this->input->post('action_type') == 'uninstall') {

            //update the db
            $update_item_data = array(
                'action_type' => $this->input->post('action_type'),
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'computer_ser' => $this->input->post('computer'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'date_created' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert updated data
            $update = $this->db->where('name', $this->input->post('sw_name'))->where('computer_ser', $this->input->post('computer'))->where('action_type', 'install')->where('company_id', $this->session->userdata('company_id'))->update('software', $update_item_data);

            //build array for history db
            $new_item_insert_history = array(
                'action_type' => $this->input->post('action_type'),
                'sw_code' => $sw_code,
                'item_id' => $item_id,
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'computer_ser' => $this->input->post('computer'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('software_history', $new_item_insert_history);

            return $insert;

        } elseif ($this->input->post('action_type') == 'stockadd') {

            //update the db
            $new_item_insert_data = array(
                'action_type' => 'stock add',
                'sw_code' => $swcode,
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'date_created' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert updated data
            $update = $this->db->insert('software', $new_item_insert_data);

            $this->db->select('id');
            $this->db->where('license', $this->input->post('license_num'));
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('software');
            $item_id_new = $query->row()->id;

            //build array for history db
            $new_item_insert_history = array(
                'action_type' => 'stock add',
                'item_id' => $item_id_new,
                'sw_code' => $swcode,
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('software_history', $new_item_insert_history);

            return $insert2;

        } elseif ($this->input->post('action_type') == 'stockremove' && $this->input->post('license_num') == "") {

            //update the db
            $new_item_insert_data = array(
                'action_type' => 'stock remove',
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'ticket_num' => $this->input->post('ticket_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'date_created' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert updated data
            $update = $this->db->where('action_type', 'uninstall')
                               ->or_where('action_type', 'stock add')
                               ->where('company_id', $this->session->userdata('company_id'))
                               ->where('name', $this->input->post('sw_name'))
                               ->limit(1)
                               ->update('software', $new_item_insert_data);

            //build array for history db
            $new_item_insert_history = array(
                'action_type' => 'stock remove',
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'ticket_num' => $this->input->post('ticket_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('software_history', $new_item_insert_history);

            return $insert2;

        } elseif ($this->input->post('action_type') == 'stockremove') {

            //update the db
            $new_item_insert_data = array(
                'action_type' => 'stock remove',
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'date_created' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert updated data
            $update = $this->db->where('license', $this->input->post('license_num'))
                               ->where('company_id', $this->session->userdata('company_id'))
                               ->update('software', $new_item_insert_data);

            //build array for history db
            $new_item_insert_history = array(
                'action_type' => 'stock remove',
                'sw_code' => $sw_code,
                'item_id' => $item_id,
                'manufacturer' => $manu,
                'name' => $this->input->post('sw_name'),
                'license' => $this->input->post('license_num'),
                'ticket_num' => $this->input->post('ticket_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('software_history', $new_item_insert_history);

            return $insert2;

        }
    }

    function software_overview()
    {

        $this->db->order_by("name", "desc");
        $this->db->select("action_type, name, license, computer_ser, price, added_by, date_updated");
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get('software');
        return $query->result();
    }

    function stockremove_check_license_use()
    {

        //check to see if the serial number already exists
        $q = $this->db->where('action_type', 'install')
                      ->where('license', $this->input->post('license_num'))
                      ->where('company_id', $this->session->userdata('company_id'))
                      ->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }

    }

    function stockremove_check_license_already_removed()
    {

        //check to see if the serial number already exists
        $q = $this->db->where('action_type', 'stock remove')
                      ->where('license', $this->input->post('license_num'))
                      ->where('company_id', $this->session->userdata('company_id'))
                      ->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }

    }

    function stockremove_check_title()
    {

        //check software db for a matching title with no license that is either a status of uninstalled or stock add
        $q = $this->db->where('action_type', 'uninstall')
                      ->or_where('action_type', 'stock add')
                      ->where('license', "")
                      ->where('company_id', $this->session->userdata('company_id'))
                      ->where('name', $this->input->post('sw_name'))
                      ->limit(1)->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }

    }
}