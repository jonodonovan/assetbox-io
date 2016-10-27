<?php

class Upload_model extends CI_Model {

    function __construct() {
        parent::__construct();

    }

    function get_addressbook() {
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function insert_csv($insert_data) {
        $this->db->insert('users', $insert_data);
    }
}