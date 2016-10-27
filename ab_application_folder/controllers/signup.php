<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller
{

	function __construct()
	{
	    parent::__construct();
	}

    public function index()
    {

        // load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|xss_clean|matches[password]');

        $this->form_validation->set_message('is_unique', 'Hmmmm.... looks like that email has already been used. ' .anchor('login/reset','Forgot your password?', 'data-toggle="modal"'));

        //run form validation
        if ($this->form_validation->run())
		{
			//setup key
			$registration_key = $this->encrypt->sha1(uniqid());

			//load signup model
			$this->load->model('signup_model');
			$email = $this->input->post('email');

			// submit information to users_temp db
			if ($this->signup_model->add_temp_user($registration_key))
			{
				$url = anchor('https://twitter.com/intent/tweet?button_hashtag=AssetBoxIO&text=I%27m%20taking%20charge%20of%20my%20computer%2C%20software%2C%20and%20mobile%20inventory%20with%20%40AssetBoxIO', 'Help us spread the word!', array('target' => '_blank' ,'class' => 'twitter-hashtag-button black-text', 'data-related' => 'assetboxio', 'data-url' => 'https://assetbox.io', 'data-dnt' => 'true'));

				//email setup
				$this->load->library('email', array('mailtype' => 'html'));

				$this->email->from('support@assetbox.io', 'AssetBox Support');
				$this->email->to($email);
				$this->email->subject("Confirm your AssetBox.io account!");

				$message = "<p>Thanks for signing up with us, we hope you enjoy your stay.</p>";
				$message .= "<p>Click here https://assetbox.io/signup/confirm/$registration_key to confirm your account</p>";

				$this->email->message($message);

				//email send
				if ($this->email->send())
				{
					$flashmessage = "Thank you for signing up! Your confirmation link has been emailed to <b>". $email. "</b><br> Didn't receive an email? Check your spam, bulk, or junk folder. <br><i class='icon-twitter'> </i>$url";
					$this->session->set_flashdata('messagebold', $flashmessage);
					redirect('welcome');

				} else {

					$this->session->set_flashdata('message', 'Email failed to send, please contact support@assetbox.io');
					redirect('welcome/new-account');
				}

			}

		} else {

	        //load view
	        $data['main_content'] = 'signup_view';
	        $this->load->view('layout/template', $data);

        }
    }

    public function confirm($registration_key)
    {

    	$this->load->model('signup_model');

    	if ($this->signup_model->check_key($registration_key))
		{

			$this->signup_model->activate_user($registration_key);
			$this->session->set_flashdata('message', 'Confirmation successful! Please login');

			redirect('welcome');

		} else {

			redirect('signup');

		}
    }
}