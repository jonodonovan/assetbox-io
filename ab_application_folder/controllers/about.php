<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller
{

	function index()
	{

        //pass navigation info
        $data['active_page'] = 'about';

		//load view
		$data['main_content'] = 'about_view';
		$this->load->view('layout/template', $data);

	}
}