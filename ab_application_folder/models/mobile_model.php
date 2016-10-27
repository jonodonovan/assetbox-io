<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model extends CI_Model
{
	function get_history()
	{
		//load and setup pagination
	    $this->load->library('pagination');

        $config['base_url'] = '/mobile/index';
        $config['total_rows'] = $this->db->where('company_id', $this->session->userdata('company_id'))->get('mobile_history')->num_rows();
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

        $this->table->set_heading('Action','Ticket','Tracking','Device ID','Model','Number','Reason','Agent', 'Date');

		//get table information
		$this->db->order_by("date_created", "desc");
		$this->db->select("action_type, ticket_num, tracking_num, device_id, model, number, reason, added_by, date_created");

		$this->db->where('company_id =', $this->session->userdata('company_id'));

		$rows = $this->db->get('mobile_history', $config['per_page'], $this->uri->segment(3))->result_array();

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

    function mobile_confirm_device()
    {

        $device_num = $this->input->post('device_id');

        //check to see if the serial number already exists
        $this->db->where('device_id', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('mobile');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }

    function mobile_confirm_status()
    {

        //check to see if the serial number already exists
        $this->db->where('device_id', $this->input->post('device_id'));
        $this->db->where('action_type', $this->input->post('action_type'));
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('mobile');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }


    function mobilecheck_add()
	{
        $device_num = $this->input->post('device_id');

        //check to see if the serial number already exists
        $this->db->where('device_id', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('mobile');

        if ($q->num_rows == 1)
        {

            $this->db->select('make, model');
            $this->db->where('device_id', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('mobile');
            $make = $query->row()->make;
            $model = $query->row()->model;


            if ($this->input->post('user_id') == '')
            {
                $this->db->select('user_id');
                $this->db->where('device_id', $device_num);
                $this->db->where('company_id', $this->session->userdata('company_id'));
                $this->db->limit(1);
                $query = $this->db->get('mobile');
                $user_id = $query->row()->user_id;

            } else {

                $user_id = $this->input->post('user_id');
            }

            if ($this->input->post('phone_num') == '')
            {
                $this->db->select('number');
                $this->db->where('device_id', $device_num);
                $this->db->where('company_id', $this->session->userdata('company_id'));
                $this->db->limit(1);
                $query = $this->db->get('mobile');
                $number = $query->row()->number;

            } else {

                $number = $this->input->post('phone_num');
            }

            $insert = "";

            //something found, query db for id based off of serial number
            $this->db->select('id');
            $this->db->where('device_id', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('mobile');
            //get the item id for the serial number above
            $item_id = $query->row()->id;

            //uppercase the user_id
            $upper_userid = strtoupper($user_id);

            //update the db
            $update_item_data = array(
                'action_type' => $this->input->post('action_type'),
                'number' => $number,
                'device_id' => $device_num,
                'make' => $make,
                'model' => $model,
                'ticket_num' => $this->input->post('ticket_num'),
                'user_id' => $upper_userid,
                'tracking_num' => $this->input->post('tracking_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'date_updated' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert updated data
            $update = $this->db->where('id', $item_id)->where('company_id', $this->session->userdata('company_id'))->update('mobile', $update_item_data);

            //build array for history db
            $new_item_insert_history = array(
                'item_id' => $item_id,
                'action_type' => $this->input->post('action_type'),
                'number' => $number,
                'make' => $make,
                'model' => $model,
                'device_id' => $device_num,
                'ticket_num' => $this->input->post('ticket_num'),
                'user_id' => $upper_userid,
                'tracking_num' => $this->input->post('tracking_num'),
                'company_id' => $this->session->userdata('company_id'),
                'added_by' => $this->session->userdata('email'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('mobile_history', $new_item_insert_history);

            return $insert;

        } else {

            //something not found
            //uppercase the user_id
            $upper_userid = strtoupper($this->input->post('user_id'));

            //build array for item db insert
            $new_item_insert_data = array(
                'action_type' => $this->input->post('action_type'),
                'device_id' => $device_num,
                'ticket_num' => $this->input->post('ticket_num'),
                'user_id' => $upper_userid,
                'tracking_num' => $this->input->post('tracking_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'date_updated' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert data
            $insert = $this->db->insert('mobile', $new_item_insert_data);
            $insert_id = $this->db->insert_id();

            //build array for history db
            $new_item_insert_history = array(
                'item_id' => $insert_id,
                'action_type' => $this->input->post('action_type'),
                'device_id' => $device_num,
                'ticket_num' => $this->input->post('ticket_num'),
                'user_id' => $upper_userid,
                'tracking_num' => $this->input->post('tracking_num'),
                'added_by' => $this->session->userdata('email'),
                'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
             );

            //insert history data
            $insert2 = $this->db->insert('mobile_history', $new_item_insert_history);

        }
    }


    function device_check()
    {

        $device_num = $this->input->post('device_id');

        //check to see if the serial number already exists
        $this->db->where('device_id', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('mobile');


        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }

    }

    function deviceadd()
    {

        $device_num = $this->input->post('device_id');

        $make_num = $this->input->post('mobile_make_dropdown');
        $this->db->select('make_name');
        $this->db->where('id', $make_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('mobile_makes');
        $make = $query->row()->make_name;

        $insert = "";

        //uppercase the user_id
        $upper_userid = strtoupper($user_id);

        //something not found
        //uppercase the user_id
        $upper_userid = strtoupper($this->input->post('user_id', TRUE));

        //build array for item db insert
        $new_item_insert_data = array(
            'action_type' => 'add',
            'make' => $make,
            'model' => $this->input->post('mobile_model_dropdown', TRUE),
            'device_id' => $device_num,
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert data
        $insert = $this->db->insert('mobile', $new_item_insert_data);
        $insert_id = $this->db->insert_id();

        //build array for history db
        $new_item_insert_history = array(
            'item_id' => $insert_id,
            'action_type' => 'add',
            'make' => $make,
            'model' => $this->input->post('mobile_model_dropdown', TRUE),
            'device_id' => $device_num,
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert2 = $this->db->insert('mobile_history', $new_item_insert_history);

    }



    function software_overview()
    {

        $this->db->order_by("name", "desc");
        $this->db->select("action_type, name, license, computer_ser, price, added_by, date_updated");
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get('software');
        return $query->result();
    }
}