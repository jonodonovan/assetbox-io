<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {


	public function index()
	{

        //pass navigation info
        $data['active_page'] = 'contact';


		$data['main_content'] = 'contact_view';
        $this->load->view('layout/template', $data);

	}

	public function submit()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{

	        $data['active_page'] = 'contact';
			$data['main_content'] = 'contact_view';
    		$this->load->view('layout/template', $data);
			//echo 'failed';
			//die();

		} else {

            $this->load->model('contact_model');

	        if($query = $this->contact_model->submit())
			{

				$contactemail = $this->input->post('email');
				$contactmessage = $this->input->post('message');


				//email setup
				$this->load->library('email', array('mailtype' => 'html'));

				$this->email->from('support@assetbox.io', 'AssetBox Support');
				$this->email->to('support@assetbox.io');
				$this->email->subject("AssetBox.io - Contact Submission");

				$message = "<p>A new contact form was submitted.</p>";
				$message .= "<p>$contactemail</p>";
				$message .= "<p>$contactmessage</p>";

				$this->email->message($message);

				//email send
				if ($this->email->send())

				$this->session->set_flashdata('messagebold', 'Thank you for contacting us, we\'ll get back with you as soon as possible!');
	            redirect('contact');

	        } else {

				$this->session->set_flashdata('messagebad', 'Failed');
				redirect('contact');

	       	}
		}
	}
}