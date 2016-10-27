<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itemprofile_model extends CI_Model
{
	function check_user()
	{

        //check to see if the serial number already exists
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
    function check_user_software()
    {

        //check to see if the serial number already exists
        $this->db->where('license', $this->input->post('serial_num'));
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $q = $this->db->get('software');

        if ($q->num_rows == 1)
        {
            return true;

        } else {

            return false;
        }
    }
    function check_user_mobile()
    {

        //check to see if the serial number already exists
        $this->db->where('device_id', $this->input->post('item_number'));
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
    function del_computer()
    {

        $status = "computer deleted";

        $profile_edit = array(
            'action_type' => $status,
            'type_var' => "pcn",
            'serial_num' => $this->input->post('serial_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
         );

        //insert data
        $insert = $this->db->where('serial_num', $this->input->post('serial_num', TRUE))->update('computer', $profile_edit);


        $this->db->select('id, license');
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('computer');
        $item_id = $query->row()->id;
        $license = $query->row()->license;

        //insert into history
        $profile_edit2 = array(
            'item_id' => $item_id,
            'license' => $license,
            'action_type' => $status,
            'type_var' => "pcn",
            'serial_num' => $this->input->post('serial_num'),
            'added_by' => $this->session->userdata('email', TRUE),
            'company_id' => $this->session->userdata('company_id', TRUE),
            'ip' => $this->input->ip_address()
         );
        $insert2 = $this->db->insert('computer_history', $profile_edit2);

        $software_update = array(
            'action_type' => $status,
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
         );

        //insert data
        $insert3 = $this->db->where('computer_ser', $this->input->post('serial_num'))->update('software', $software_update);

        //insert into history
        $insert4 = $this->db->where('computer_ser', $this->input->post('serial_num'))->update('software_history', $software_update);

        return $insert2;

    }
    function del_license()
    {

        $this->db->select('id');
        $this->db->where('license', $this->input->post('serial_num'));
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('software');
        $item_id = $query->row()->id;

        $status = "license deleted";

        $profile_edit = array(
            'action_type' => $status,
            'license' => $this->input->post('serial_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'computer_ser' => "",
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
         );

        //insert data
        $insert = $this->db->where('license', $this->input->post('serial_num'))->update('software', $profile_edit);

        //insert into history
        $profile_edit2 = array(
            'action_type' => $status,
            'item_id' => $item_id,
            'license' => $this->input->post('serial_num'),
            'sw_code' => $this->input->post('swcode'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );
        $insert2 = $this->db->insert('software_history', $profile_edit2);

        return $insert2;

    }
    function del_mobile()
    {

        $this->db->select('id');
        $this->db->where('device_id', $this->input->post('serial_num'));
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->limit(1);
        $query = $this->db->get('mobile');
        $item_id = $query->row()->id;

        $status = "mobile deleted";

        $profile_edit = array(
            'action_type' => $status,
            'device_id' => $this->input->post('serial_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'date_updated' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address()
         );

        //insert data
        $insert = $this->db->where('device_id', $this->input->post('serial_num'))->update('mobile', $profile_edit);

        //insert into history
        $profile_edit2 = array(
            'action_type' => $status,
            'item_id' => $item_id,
            'device_id' => $this->input->post('serial_num'),
            'added_by' => $this->session->userdata('email'),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );
        $insert2 = $this->db->insert('mobile_history', $profile_edit2);

        return $insert2;

    }
}