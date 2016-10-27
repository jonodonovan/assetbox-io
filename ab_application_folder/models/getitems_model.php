<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getitems_model extends CI_Model
{
    function index()
    {
    	//$data['items'] = $results['rows'];
        $this->db->order_by("id", "desc");
        $this->db->select("id, action_type, ticket_num, serial_num, part_num, model, user_first_name, user_last_name, reason, added_by, date_created");
        $rows = $this->db->get('items', $config['per_page'], $this->uri->segment(3))->result_array(); 
        foreach ($rows as $count => $row)
        {
            $rows[$count]['id'] = anchor('itemprofile/'.$row['id'],$row['id']);
        }
        return $rows;
    }
}
