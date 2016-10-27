<?php
class Error404 extends CI_Controller
{
	public function __construct()
	{
	        parent::__construct();
	}

	public function index()
	{

        //pass navigation info
        $data['active_page'] = '404';

        $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);

        //form dropdown options
        $this->load->model('error_model');
        $this->error_model->error_404($seg1, $seg2, $seg3, $seg4, $seg5, $seg6);

		$this->output->set_status_header('404');

        //pass the information to the view
        $data['main_content'] = 'error404_view';
        $this->load->view('layout/template', $data);
	}
}
?>