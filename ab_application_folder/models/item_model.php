<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model
{
    function company_check()
    {

        if($this->uri->segment(3) === 'c')
        {

            //check to see if the page is for this company or not
            $q = $this->db->where('serial_num', $this->uri->segment(4))->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('computer');

            if ($q->num_rows == 1)
            {
                return true;

            } else {

                return false;
            }

        } else if($this->uri->segment(3) === 'm') {

            //check to see if the page is for this company or not
            $q = $this->db->where('device_id', $this->uri->segment(4))->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('mobile');

            if ($q->num_rows == 1)
            {
                return true;

            } else {

                return false;
            }

        } else if($this->uri->segment(3) === 's') {

            //check to see if the page is for this company or not
            $q = $this->db->where('sw_code', $this->uri->segment(4))->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('software');

            if ($q->num_rows == 1)
            {
                return true;

            } else {

                return false;
            }

        }
    }


    function add_item()
	{

        //ID change to name
        if ($this->input->post('make') == 1)
		{
            $make_var = "Laptop";
			$type_var = "pcn";
			$serial_var = $this->input->post('serial_num', TRUE);
        }
		elseif ($this->input->post('make') == 2)
		{
            $make_var = "Desktop";
			$type_var = "pcn";
			$serial_var = $this->input->post('serial_num', TRUE);
        }
		elseif($this->input->post('make') == 3)
		{
            $make_var = "Printer";
			$type_var = "pri";
			$serial_var = $this->input->post('serial_num', TRUE);
        }
		elseif($this->input->post('make') == 4)
		{
            $make_var = "Cisco";
			$type_var = "net";
			$serial_var = $this->input->post('serial_num', TRUE);
        }
		elseif($this->input->post('make') == 5)
		{
            $make_var = "Accessory";
			$type_var = "acc";
			$serial_var = uniqid('acc', false);
        }
		else
		{
            $make_var = "Unknown";
			$type_var = "unknown";
			$serial_var = "unkown";
        }

        //check to see if the serial number already exists
        $q = $this
                ->db
                ->where('serial_num', $serial_var)
                ->where('company_id', $this->session->userdata('company_id'))
                ->limit(1)
                ->get('computer');

        if ($q->num_rows == 1)
		{
            $insert = "";

            //something found, query db for id based off of serial number
            $this->db->select('id');
            $this->db->where('serial_num', $serial_var);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            //get the item id for the serial number above
            $item_id = $query->row()->id;

            //uppercase the user_id
            $upper_userid = strtoupper($this->input->post('user_id', TRUE));

            //update the db
            $update_item_data = array(
            'action_type' => $this->input->post('action_type', TRUE),
            'asset_tag' => $this->input->post('asset_tag', TRUE),
            'hostname' => $this->input->post('hostname', TRUE),
            'ticket_num' => $this->input->post('ticket_num', TRUE),
            'tracking_num' => $this->input->post('tracking_num', TRUE),
            'user_id' => $upper_userid,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
			'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
            );

            //insert updated data
            $update = $this->db->where('id', $item_id)->update('computer', $update_item_data);

            //clean part number
            $clean_partnum = str_replace("#ABA", "", $this->input->post('part_num', TRUE));

            //build array for history db
            $new_item_insert_history = array(
                'item_id' => $item_id,
                'asset_tag' => $this->input->post('asset_tag', TRUE),
                'hostname' => $this->input->post('hostname', TRUE),
                'ticket_num' => $this->input->post('ticket_num', TRUE),
                'tracking_num' => $this->input->post('tracking_num', TRUE),
                'serial_num' => $serial_var,
                'action_type' => $this->input->post('action_type', TRUE),
                'make' => $make_var,
                'model' => $this->input->post('model_id', TRUE),
                'part_num' => $clean_partnum,
                'user_id' => $upper_userid,
                'reason' => $this->input->post('reason', TRUE),
                'added_by' => $this->session->userdata('email'),
				'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
            );

            //insert history data
            $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

            return $insert;

        } else {

            //something not found
			//clean part number
            $clean_partnum = str_replace("#ABA", "", $this->input->post('part_num', TRUE));

            //uppercase the user_id
            $upper_userid = strtoupper($this->input->post('user_id', TRUE));

            //build array for item db insert
            $new_item_insert_data = array(
                'action_type' => $this->input->post('action_type', TRUE),
                'asset_tag' => $this->input->post('asset_tag', TRUE),
                'hostname' => $this->input->post('hostname', TRUE),
                'ticket_num' => $this->input->post('ticket_num', TRUE),
                'tracking_num' => $this->input->post('tracking_num', TRUE),
                'serial_num' => $serial_var,
                'part_num' => $clean_partnum,
                'make' => $make_var,
                'model' => $this->input->post('model_id', TRUE),
                'item_type' => $type_var,
                'user_id' => $upper_userid,
                'reason' => $this->input->post('reason', TRUE),
                'added_by' => $this->session->userdata('email'),
				'company_id' => $this->session->userdata('company_id'),
                'date_created' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address()
            );

            //insert data
            $insert = $this->db->insert('computer', $new_item_insert_data);
            $insert_id = $this->db->affected_rows();

            //build array for history db
            $new_item_insert_history = array(
                'item_id' => $insert_id,
                'asset_tag' => $this->input->post('asset_tag', TRUE),
                'hostname' => $this->input->post('hostname', TRUE),
                'ticket_num' => $this->input->post('ticket_num', TRUE),
                'tracking_num' => $this->input->post('tracking_num', TRUE),
                'serial_num' => $serial_var,
                'action_type' => $this->input->post('action_type', TRUE),
                'make' => $make_var,
                'model' => $this->input->post('model_id', TRUE),
                'part_num' => $clean_partnum,
                'user_id' => $upper_userid,
                'reason' => $this->input->post('reason', TRUE),
                'added_by' => $this->session->userdata('email'),
				'company_id' => $this->session->userdata('company_id'),
                'ip' => $this->input->ip_address()
             );

            //insert history data
            $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

            return $insert2;
        }
    }

    function edit_computer_item()
	{
        $device_num     = $this->input->post('serial_num');

        if ($this->input->post('purchased_date') != NULL)
        {
            $date_purchased = date('Y-m-d', strtotime($this->input->post('purchased_date')));
        }

        if ($this->input->post('scsd') != NULL)
        {
            $date_scsd = date('Y-m-d', strtotime($this->input->post('scsd')));
        }

        if ($this->input->post('sced') != NULL)
        {
            $date_sced = date('Y-m-d', strtotime($this->input->post('sced')));
        }

        if ($this->input->post('temp_date') != NULL)
        {
            $date_temp = date('Y-m-d', strtotime($this->input->post('temp_date')));
        }

        //  Temporary Use Notes
        if ($this->input->post('temp_notes') == '')
        {
            $this->db->select('temp_notes');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $tempnotes_info = $query->row()->temp_notes;

        } else {

            $tempnotes = $this->input->post('temp_notes');
        }

        //  CPU
        if ($this->input->post('cpu') == '')
        {
            $this->db->select('cpu');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $cpu_info = $query->row()->cpu;

        } else {

            $cpu_info = $this->input->post('cpu');
        }

        //  RAM
        if ($this->input->post('ram') == '')
        {
            $this->db->select('ram');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $ram_info = $query->row()->ram;

        } else {

            $ram_info = $this->input->post('ram');
        }

        //  HDD
        if ($this->input->post('hdd') == '')
        {
            $this->db->select('hdd');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $hdd_info = $query->row()->hdd;

        } else {

            $hdd_info = $this->input->post('hdd');
        }

        //  OS
        if ($this->input->post('os') == '')
        {
            $this->db->select('os');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $os_info = $query->row()->os;

        } else {

            $os_info = $this->input->post('os');
        }

        //  Company
        if ($this->input->post('company') == '')
        {
            $this->db->select('company');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $company_info = $query->row()->company;

        } else {

            $company_info = $this->input->post('company');
        }


        //  purchased from
        if ($this->input->post('purchased_from') == '')
        {
            $this->db->select('purchased_from');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $purchased_from = $query->row()->purchased_from;

        } else {

            $purchased_from = $this->input->post('purchased_from');
        }

        //  support name
        if ($this->input->post('support_name') == '')
        {
            $this->db->select('support_name');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $support_name = $query->row()->support_name;

        } else {

            $support_name = $this->input->post('support_name');
        }

        //  support number
        if ($this->input->post('support_number') == '')
        {
            $this->db->select('support_number');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $support_number = $query->row()->support_number;

        } else {

            $support_number = $this->input->post('support_number');
        }

        //  price
        if ($this->input->post('price') == '')
        {
            $this->db->select('price');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $price = $query->row()->price;

        } else {

            $price = $this->input->post('price');
        }

        //asset tag
        if ($this->input->post('atag') == '')
        {
            $this->db->select('asset_tag');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $atag = $query->row()->asset_tag;

        } else {

            $atag = $this->input->post('atag');
        }

        //part number
        if ($this->input->post('part_num') == '')
        {
            $this->db->select('part_num');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $part_num = $query->row()->part_num;

        } else {

            $part_num = $this->input->post('part_num');
        }

        //user name
        if ($this->input->post('user_id') == '')
        {
            $this->db->select('user_id');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $user_id = $query->row()->user_id;

        } else {

            $user_id = $this->input->post('user_id');
        }

        //hostname
        if ($this->input->post('hostname') == '')
        {
            $this->db->select('hostname');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $hostname = $query->row()->hostname;

        } else {

            $hostname = $this->input->post('hostname');
        }

        //location
        if ($this->input->post('location') == '')
        {
            $this->db->select('location');
            $this->db->where('serial_num', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('computer');
            $location = $query->row()->location;

        } else {

            $location = $this->input->post('location');
        }

        //
        $this->db->select('make, model');
        $this->db->where('serial_num', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('computer');
        $make = $query->row()->make;
        $model = $query->row()->model;

        //query db for id based off of serial number
        $this->db->select('id');
        $this->db->where('serial_num', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('computer');
        //get the item id for the serial number above
        $item_id = $query->row()->id;

        $edit = $this->input->post('action_type', TRUE);

        //uppercase the user_id
        $upper_userid = strtoupper($this->input->post('user_id', TRUE));

        //update the db
        $update_item_data = array(
            'action_type' => $edit,
            'asset_tag' => $atag,
            'user_id' => $upper_userid,
            'serial_num' => $device_num,
            'part_num' => $part_num,
            'hostname' => $hostname,
            'cpu' => $cpu_info,
            'ram' => $ram_info,
            'hdd' => $hdd_info,
            'os' => $os_info,
            'company' => $company_info,
            'location' => $location,
            'purchased_date' => $date_purchased,
            'scsd' => $date_scsd,
            'sced' => $date_sced,
            'purchased_from' => $purchased_from,
            'support_name' => $support_name,
            'support_number' => $support_number,
            'price' => $price,
            'temp_date' => $date_temp,
            'temp_notes' => $tempnotes,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert updated data
        $update = $this->db->where('id', $item_id)->where('company_id', $this->session->userdata('company_id'))->update('computer', $update_item_data);

        //build array for history db
        $new_item_insert_history = array(
            'action_type' => $edit,
            'asset_tag' => $atag,
            'item_id' => $item_id,
            'make' => $make,
            'model' => $model,
            'user_id' => $upper_userid,
            'serial_num' => $device_num,
            'part_num' => $part_num,
            'hostname' => $hostname,
            'cpu' => $cpu_info,
            'ram' => $ram_info,
            'hdd' => $hdd_info,
            'os' => $os_info,
            'company' => $company_info,
            'location' => $location,
            'purchased_date' => $date_purchased,
            'scsd' => $date_scsd,
            'sced' => $date_sced,
            'purchased_from' => $purchased_from,
            'support_name' => $support_name,
            'support_number' => $support_number,
            'price' => $price,
            'temp_date' => $date_temp,
            'temp_notes' => $tempnotes,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
        );

        //insert history data
        $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

        return $insert2;

    }

    function edit_mobile_item()
    {

        $device_num = $this->input->post('device_id');

        if ($this->input->post('ced') != NULL)
        {
            $date_ced = date('Y-m-d', strtotime($this->input->post('ced')));
        }

        if ($this->input->post('crd') != NULL)
        {
            $date_crd = date('Y-m-d', strtotime($this->input->post('crd')));
        }

        if ($this->input->post('temp_date') != NULL)
        {
            $date_temp = date('Y-m-d', strtotime($this->input->post('temp_date')));
        }

        //  Temporary Use Notes
        if ($this->input->post('temp_notes') == '')
        {
            $this->db->select('temp_notes');
            $this->db->where('device_id', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('mobile');
            $tempnotes_info = $query->row()->temp_notes;

        } else {

            $tempnotes = $this->input->post('temp_notes');
        }

        //user name
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

        //mobile number
        if ($this->input->post('number') == '')
        {
            $this->db->select('number');
            $this->db->where('device_id', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('mobile');
            $number = $query->row()->number;

        } else {

            $number = $this->input->post('number');
        }

        //price
        if ($this->input->post('price') == '')
        {
            $this->db->select('price');
            $this->db->where('device_id', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('mobile');
            $price = $query->row()->price;

        } else {

            $price = $this->input->post('price');
        }

        //location
        if ($this->input->post('location') == '')
        {
            $this->db->select('location');
            $this->db->where('device_id', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('mobile');
            $location = $query->row()->location;

        } else {

            $location = $this->input->post('location');
        }

        //
        $this->db->select('make, model');
        $this->db->where('device_id', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('mobile');
        $make = $query->row()->make;
        $model = $query->row()->model;

        //query db for id based off of serial number
        $this->db->select('id, ced, crd, user_id, number');
        $this->db->where('device_id', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('mobile');
        //get the item id for the serial number above
        $item_id = $query->row()->id;

        $edit = 'edit';

        //uppercase the user_id
        $upper_userid = strtoupper($this->input->post('user_id', TRUE));

        //update the db
        $update_item_data = array(
            'ced' => $date_ced,
            'crd' => $date_crd,
            'user_id' => $upper_userid,
            'number' => $number,
            'price' => $price,
            'device_id' => $device_num,
            'location' => $location,
            'temp_date' => $date_temp,
            'temp_notes' => $tempnotes,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert updated data
        $update = $this->db->where('id', $item_id)->update('mobile', $update_item_data);

        //build array for history db
        $new_item_insert_history = array(
            'action_type' => $edit,
            'item_id' => $item_id,
            'ced' => $date_ced,
            'crd' => $date_crd,
            'make' => $make,
            'model' => $model,
            'user_id' => $upper_userid,
            'number' => $number,
            'price' => $price,
            'temp_date' => $date_temp,
            'temp_notes' => $tempnotes,
            'device_id' => $device_num,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
        );

        //insert history data
        $insert2 = $this->db->insert('mobile_history', $new_item_insert_history);

        return $insert2;

    }

    /*

    |
    |
    | START Software
    |
    |

    */

    function edit_software_item()
    {

        $device_num = $this->input->post('device_id');

        if ($this->input->post('ced') != NULL)
        {
            $date_ced = date('Y-m-d', strtotime($this->input->post('ced')));
        }

        if ($this->input->post('csd') != NULL)
        {
            $date_csd = date('Y-m-d', strtotime($this->input->post('csd')));
        }

        if ($this->input->post('purchased_date') != NULL)
        {
            $date_purchased = date('Y-m-d', strtotime($this->input->post('purchased_date')));
        }

        if ($this->input->post('scsd') != NULL)
        {
            $date_scsd = date('Y-m-d', strtotime($this->input->post('scsd')));
        }

        if ($this->input->post('sced') != NULL)
        {
            $date_sced = date('Y-m-d', strtotime($this->input->post('sced')));
        }

        //  purchased from
        if ($this->input->post('purchased_from') == '')
        {
            $this->db->select('purchased_from');
            $this->db->where('sw_code', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('software');
            $purchased_from = $query->row()->purchased_from;

        } else {

            $purchased_from = $this->input->post('purchased_from');
        }

        //  support name
        if ($this->input->post('support_name') == '')
        {
            $this->db->select('support_name');
            $this->db->where('sw_code', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('software');
            $support_name = $query->row()->support_name;

        } else {

            $support_name = $this->input->post('support_name');
        }

        //  support number
        if ($this->input->post('support_number') == '')
        {
            $this->db->select('support_number');
            $this->db->where('sw_code', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('software');
            $support_number = $query->row()->support_number;

        } else {

            $support_number = $this->input->post('support_number');
        }

        //  price
        if ($this->input->post('price') == '')
        {
            $this->db->select('price');
            $this->db->where('sw_code', $device_num);
            $this->db->where('company_id', $this->session->userdata('company_id'));
            $this->db->limit(1);
            $query = $this->db->get('software');
            $price = $query->row()->price;

        } else {

            $price = $this->input->post('price');
        }

        //
        $this->db->select('manufacturer, name');
        $this->db->where('sw_code', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('software');
        $manufacturer = $query->row()->manufacturer;
        $name = $query->row()->name;

        //query db for id based off of serial number
        $this->db->select('id, manufacturer, name, computer_ser, license');
        $this->db->where('sw_code', $device_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('software');
        //get the item id for the serial number above
        $item_id = $query->row()->id;
        $manufacturer = $query->row()->manufacturer;
        $name = $query->row()->name;
        $computer_ser = $query->row()->computer_ser;
        $license = $query->row()->license;

        $edit = 'edit';

        //update the db
        $update_item_data = array(
            'action_type' => $edit,
            'ced' => $date_ced,
            'csd' => $date_csd,
            'purchased_date' => $date_purchased,
            'scsd' => $date_scsd,
            'sced' => $date_sced,
            'purchased_from' => $purchased_from,
            'support_name' => $support_name,
            'support_number' => $support_number,
            'price' => $price,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert updated data
        $update = $this->db->where('id', $item_id)->update('software', $update_item_data);

        //build array for history db
        $new_item_insert_history = array(
            'action_type' => $edit,
            'item_id' => $item_id,
            'ced' => $date_ced,
            'csd' => $date_csd,
            'purchased_date' => $date_purchased,
            'scsd' => $date_scsd,
            'sced' => $date_sced,
            'manufacturer' => $manufacturer,
            'name' => $name,
            'computer_ser' => $computer_ser,
            'price' => $price,
            'license' => $license,
            'sw_code' => $this->input->post('device_id'),
            'purchased_from' => $purchased_from,
            'support_name' => $support_name,
            'support_number' => $support_number,
            'price' => $price,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
        );

        //insert history data
        $insert2 = $this->db->insert('software_history', $new_item_insert_history);

        return $insert2;

    }

    /*

    |
    |
    | END Software
    |
    |

    */

    function check_assettag()
    {

        $q = $this->db->where('asset_tag', $this->input->post('atag'))->where('company_id', $this->session->userdata('company_id'))->limit(1)->get('computer');

        if($q->num_rows == 1)
        {

            $q2 = $this->db->where('asset_tag', $this->input->post('atag'))->where('serial_num', $this->input->post('serial_num'))->limit(1)->get('computer');

            if($q2->num_rows == 1)
            {

                return false;

            } else {

                return true;

            }


        } else {

            return false;

        }

    }
}
