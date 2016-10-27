<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal extends CI_Controller
{

	function privacy()
	{

		//load view
		$data['main_content'] = 'privacy_view';
		$this->load->view('layout/template', $data);

	}

    function tos()
    {

        //load view
        $data['main_content'] = 'tos_view';
        $this->load->view('layout/template', $data);

    }

}