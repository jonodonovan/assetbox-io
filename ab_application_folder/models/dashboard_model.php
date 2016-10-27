<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function edit_your_name()
	{
        $profile_edit = array(
            'name' => $this->input->post('name'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->where('email', $this->session->userdata('email'))->update('users', $profile_edit);

        return $insert;
    }

    function edit_your_alt_email()
    {
        $profile_edit = array(
            'alternative_email' => $this->input->post('alt_email'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->where('email', $this->session->userdata('email'))->update('users', $profile_edit);

        return $insert;
    }

    function edit_your_company_name()
    {
        $profile_edit = array(
            'company_name' => $this->input->post('cname'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->where('email', $this->session->userdata('email'))->update('users', $profile_edit);

        return $insert;
    }

    function add_agent()
    {

        $profile_edit = array(
            'email' => $this->input->post('email'),
            'password' => $this->encrypt->sha1($this->input->post('password')),
            'company_id' => $this->session->userdata('company_id'),
            'is_agent' => '1',
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->insert('users', $profile_edit);

        return $insert;

    }

    function del_agent()
    {

        return $this->db->delete('users', array('id' => $this->input->post('list_agents')));

    }

    function add_model()
    {

        $profile_edit = array(
            'make_id' => $this->input->post('make_dropdown'),
            'model_name' => $this->input->post('number', TRUE),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->insert('computer_models', $profile_edit);

        return $insert;

    }

    function add_manufacturer()
    {

        $manu_edit = array(
            'manufacturer_name' => $this->input->post('manuname', TRUE),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->insert('software_manufacturers', $manu_edit);

        return $insert;

    }

    function add_mobilemanufacturer()
    {

        $manu_edit = array(
            'make_name' => $this->input->post('manuname', TRUE),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->insert('mobile_makes', $manu_edit);

        return $insert;

    }

    function add_swname()
    {

        $swname_edit = array(
            'software_name' => $this->input->post('swname', TRUE),
            'manufacturer_id' => $this->input->post('manufacturer_dropdown', TRUE),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->insert('software_names', $swname_edit);

        return $insert;

    }

    function add_mobilemodel()
    {

        $swname_edit = array(
            'model_name' => $this->input->post('swname', TRUE),
            'make_id' => $this->input->post('manufacturer_dropdown', TRUE),
            'company_id' => $this->session->userdata('company_id'),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->insert('mobile_models', $swname_edit);

        return $insert;

    }


    function del_model()
    {

        return $this->db->delete('computer_models', array('id' => $this->input->post('list_models')));

    }


    function del_manufacturer()
    {
        $this->db->delete('software_names', array('manufacturer_id' => $this->input->post('manufacturer_dropdown')));
        return $this->db->delete('software_manufacturers', array('id' => $this->input->post('manufacturer_dropdown')));

    }

    function del_mobilemanufacturer()
    {
        $this->db->delete('mobile_models', array('make_id' => $this->input->post('manufacturer_dropdown')));
        return $this->db->delete('mobile_makes', array('id' => $this->input->post('manufacturer_dropdown')));

    }

    function del_swname()
    {

        return $this->db->delete('software_names', array('id' => $this->input->post('list_swnames')));

    }

    function del_mobilemodel()
    {

        return $this->db->delete('mobile_models', array('id' => $this->input->post('list_swnames')));

    }

    function update_agent_password()
    {

        $profile_edit = array(
            'password' => $this->encrypt->sha1($this->input->post('password')),
            'ip' => $this->input->ip_address()
         );

        //insert history data
        $insert = $this->db->where('id', $this->input->post('list_agents'))->update('users', $profile_edit);

        return $insert;

    }

    function payment_update_account_onemonth()
    {
        $profile_edit = array(
            'payment_plan' => "onemonth",
            'payment_date' => date("Y-m-d H:i:s"),
            'payment_ip' => $this->input->ip_address(),
            'date_updated' => date("Y-m-d H:i:s")
         );

        //insert history data
        $insert = $this->db->where('email', $this->session->userdata('email'))->update('users', $profile_edit);

        return $insert;
    }

    function payment_update_account_oneyear()
    {
        $profile_edit = array(
            'payment_plan' => "oneyear",
            'payment_date' => date("Y-m-d H:i:s"),
            'payment_ip' => $this->input->ip_address(),
            'date_updated' => date("Y-m-d H:i:s")
         );

        //insert history data
        $insert = $this->db->where('email', $this->session->userdata('email'))->update('users', $profile_edit);

        return $insert;
    }

    function del_account()
    {

        //update the db
        $update_user_data = array(
            'account_deleted' => '1',
            'account_deleted_feedback' => $this->input->post('feedback'),
            'account_deleted_ip' => $this->input->ip_address()
        );

        //insert updated data
        return $this->db->where('email', $this->session->userdata('email', TRUE))->update('users', $update_user_data);

    }
}