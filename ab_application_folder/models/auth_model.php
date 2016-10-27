<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function verify_user()
    {
        //query db
        $this->db->where('email', $this->input->post('email', TRUE));
        $this->db->where('account_deleted', 0);
        $this->db->where('password', $this->encrypt->sha1($this->input->post('password', TRUE)));
        $query = $this->db->get('users');

        //verify something returned
        if ($query->num_rows() == 1)
		{

            $login_number == 0;
            $login = array(
                'failed_login' => $login_number
             );
            $this->db->where('email', $this->input->post('email', TRUE))->update('users', $login);

            //success
            return $query->row();
        }
        //fail
        return FALSE;
    }

    public function failed_login()
    {

        $this->db->select('failed_login, account_deleted');
        $this->db->where('email', $this->input->post('email'));
        $this->db->limit(1);
        $query = $this->db->get('users');

        $login_number = $query->row()->failed_login;
        $deleted = $query->row()->account_deleted;

        if ($deleted == 1)
        {
            return(2);

        } else {

            if ($login_number < 5)
            {
                $login_number++;

                $login = array(
                    'failed_login' => $login_number,
                    'failed_ip' => $this->input->ip_address()
                 );
                $this->db->where('email', $this->input->post('email', TRUE))->update('users', $login);

                return(0);

            } elseif ($login_number >= 5) {

                $login_number++;

                $login = array(
                    'failed_login' => $login_number,
                    'failed_ip' => $this->input->ip_address()
                 );
                $this->db->where('email', $this->input->post('email', TRUE))->update('users', $login);

                return(1);
            }
        }
    }
}


