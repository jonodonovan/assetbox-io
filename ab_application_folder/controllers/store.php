<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller
{

	function index()
	{

        //pass navigation info
        $data['active_page'] = 'store';

		//load view
		$data['main_content'] = 'store_view';
		$this->load->view('layout/template', $data);

	}
}