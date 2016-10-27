<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Computer_model extends CI_Model
{
    function check_assettag()
    {
        //check
        $q = $this->db
                ->where('asset_tag', $this->input->post('atag'))
                ->where('company_id', $this->session->userdata('company_id'))
                ->limit(1)->get('computer');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }

    }

    function computer_add()
    {

        //ID change to name
        if ($this->input->post('make_dropdown') == 1)
        {
            $make_var = "Laptop";
            $type_var = "pcn";
            $serial_var = str_replace(" ",'',$this->input->post('serial_num'));
        }
        elseif ($this->input->post('make_dropdown') == 2)
        {
            $make_var = "Desktop";
            $type_var = "pcn";
            $serial_var = str_replace(" ",'',$this->input->post('serial_num'));
        }
        else
        {
            $make_var = "Unknown";
            $type_var = "unknown";
            $serial_var = "unk";
        }

        $action = "add";

        $insert = "";

        //build array for item db insert
        $new_item_insert_data = array(
            'action_type' => $action,
            'type_var' => $type_var,
            'make' => $make_var,
            'model' => $this->input->post('model_id'),
            'serial_num' => $serial_var,
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_created' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert data
        $insert = $this->db->insert('computer', $new_item_insert_data);
        $insert_id = $this->db->insert_id();

        //build array for history db
        $new_item_insert_history = array(
            'item_id' => $insert_id,
            'action_type' => $action,
            'type_var' => $type_var,
            'make' => $make_var,
            'model' => $this->input->post('model_id'),
            'serial_num' => $serial_var,
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

        return $insert2;

    }

    function accessory_add()
    {

        $serial_var = uniqid('acc', false);
        $make_var = "Accessory";
        $type_var = "acc";
        $insert = "";

        //build array for item db insert
        $new_item_insert_data = array(
            'action_type' => $this->input->post('action_type'),
            'type_var' => $type_var,
            'make' => $make_var,
            'model' => $this->input->post('accessory_dropdown'),
            'serial_num' => $serial_var,
            'ticket_num' => $this->input->post('ticket_num'),
            'user_id' => $this->input->post('user_id'),
            'reason' => $this->input->post('reason'),
            'tracking_num' => $this->input->post('tracking_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_created' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert data
        $insert = $this->db->insert('computer', $new_item_insert_data);
        $insert_id = $this->db->insert_id();

        //build array for history db
        $new_item_insert_history = array(
            'item_id' => $insert_id,
            'action_type' => $this->input->post('action_type'),
            'type_var' => $type_var,
            'make' => $make_var,
            'model' => $this->input->post('accessory_dropdown'),
            'serial_num' => $serial_var,
            'ticket_num' => $this->input->post('ticket_num'),
            'user_id' => $this->input->post('user_id'),
            'reason' => $this->input->post('reason'),
            'tracking_num' => $this->input->post('tracking_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

        return $insert2;

    }

    function computer_confirm_device()
    {

        $serial_num = $this->input->post('serial_num');

        //check to see if the serial number already exists
        $this->db->where('serial_num', $serial_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('computer');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }

    function computer_check_status()
    {

        $action_type = $this->input->post('action_type');

        //check to see if the serial number already exists
        $this->db->where('action_type', $action_type);
        $this->db->where('serial_num', $this->input->post('serial_num'));
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('computer');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }


    function computer_serialedit()
    {

        $ser_num = str_replace(" ",'',$this->input->post('serial_num'));

        $this->db->select('id, model, asset_tag');
        $this->db->where('serial_num', $ser_num);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('computer');
        $model = $query->row()->model;
        $asset_tag = $query->row()->asset_tag;
        $item_id = $query->row()->id;

        $insert = "";

        //build array for item db insert
        $new_item_insert_data = array(
            'action_type' => $this->input->post('action_type'),
            'serial_num' => $ser_num,
            'ticket_num' => $this->input->post('ticket_num'),
            'tracking_num' => $this->input->post('tracking_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_created' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert data
        $update = $this->db->where('serial_num', $this->input->post('serial_num'))->where('company_id', $this->session->userdata('company_id'))->update('computer', $new_item_insert_data);

        //build array for history db
        $new_item_insert_history = array(
            'item_id' => $item_id,
            'model' => $model,
            'asset_tag' => $asset_tag,
            'action_type' => $this->input->post('action_type'),
            'serial_num' => $ser_num,
            'ticket_num' => $this->input->post('ticket_num'),
            'tracking_num' => $this->input->post('tracking_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

        return $insert2;

    }


    function actionedit_byasset()
	{

        $assetnum = $this->input->post('atag');

        $this->db->select('serial_num, id');
        $this->db->where('asset_tag', $assetnum);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('computer');
        $serial_num = $query->row()->serial_num;
        $item_id = $query->row()->id;


        //if row found
        //build array for item db insert
        $new_item_insert_data = array(
            'action_type' => $this->input->post('action_type'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_created' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
        );

        //insert data
        $update = $this->db->where('asset_tag', $assetnum)->where('company_id', $this->session->userdata('company_id'))->update('computer', $new_item_insert_data);

        //build array for history db
        $new_item_insert_history = array(
            'item_id' => $item_id,
            'serial_num' => $serial_num,
            'action_type' => $this->input->post('action_type'),
            'asset_tag' => $assetnum ,
            'reason' => $this->input->post('reason'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert2 = $this->db->insert('computer_history', $new_item_insert_history);

        return $insert2;

    }
}
