<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goodbye extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in'))
        {
            redirect('computers');
        }

        //pass success or failed message
        $data['message'] = $this->session->flashdata('status');
        $data['messagebad'] = $this->session->flashdata('status_bad');

        $data['active_page'] = 'home';
        //load view
        $data['main_content'] = 'home_view';
        $this->load->view('layout/template', $data);
    }
}