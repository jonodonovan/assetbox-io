<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete_model extends CI_Model
{
  function get_partnum($q)
  {
    $this->db->select('part_num');
    $this->db->like('part_num', $q); 
    $query = $this->db->get('item_history');

    if($query->num_rows > 0)
    {
      foreach ($query->result_array() as $row)
      {
        $row_set[] = htmlentities(stripslashes($row['part_num'])); //build an array
      }

    echo json_encode($row_set); //format the array into json data
    }
  }

  function get_employees($q)
  {
    $this->db->select('*');
    $this->db->like('name', $q, 'after');
    $query = $this->db->get('employees');

    if($query->num_rows > 0)
    {
      foreach ($query->result_array() as $row)
      {
        $new_row['label']=htmlentities(stripslashes($row['name']));
        $new_row['value']=htmlentities(stripslashes($row['xid']));
        $row_set[] = $new_row; //build an array
      }
      
      echo json_encode($row_set); //format the array into json data
    }
  }

  function get_partnum2($q)
  {
    $this->db->select('*');
    $this->db->like('part_num', $q, 'after'); 
    $query = $this->db->get('item_history');

    if($query->num_rows > 0)
    {
      foreach ($query->result_array() as $row)
      {
        $new_row['label']=htmlentities(stripslashes($row['part_num']));
        $new_row['value']=htmlentities(stripslashes($row['part_num']));
        $row_set[] = $new_row; //build an array
      }
      
      echo json_encode($row_set); //format the array into json data
    }
  }
}