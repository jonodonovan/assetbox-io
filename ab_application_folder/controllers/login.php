<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
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

    function check()
    {
        if ($this->session->userdata('logged_in'))
        {
            redirect('computers');
        }

        // load form validation
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('email', 'Email Address', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');

        //run form validation
        if ($this->form_validation->run())
        {
            //is true, pass to db
            $this->load->model('auth_model');

            if ($this->auth_model->verify_user())
            {

                //update the db
                $update_user_data = array(
                'last_login' => date("Y-m-d H:i:s"),
                'last_login_ip' => $this->input->ip_address()
                );

                //insert updated data
                $this->db->where('email', $this->input->post('email'))->update('users', $update_user_data);

                //todo: organize
                $query = $this
                        ->db
                        ->select('id')
                        ->select('is_agent')
                        ->select('location')
                        ->select('name')
                        ->select('company_id')
                        ->select('barcode')
                        ->select('company_name')
                        ->select('alternative_email')
                        ->select('payment_plan')
                        ->where('email', $this->input->post('email'))
                        ->get('users')->row();

                $newdata = array(
                        'id'            => $query->id,
                        'email'         => $this->input->post('email'),
                        'alt_email'     => $query->alternative_email,
                        'name'          => $query->name,
                        'company_id'    => $query->company_id,
                        'barcode'       => $query->barcode,
                        'company_name'  => $query->company_name,
                        'logged_in'     => TRUE,
                        'plan'          => $query->payment_plan,
                        'is_agent'      => $query->is_agent
                        );

                $this->session->set_userdata($newdata);

                //todo: organize
                $this->db->where('company_id', $this->session->userdata('company_id'));
                $this->db->limit(1);
                $q = $this->db->get('software_manufacturers');

                if ($q->num_rows == 1)
                {
                    $scheckvar = 1;

                } else {

                    $scheckvar = 0;
                }

                $this->db->where('company_id', $this->session->userdata('company_id'));
                $this->db->limit(1);
                $q = $this->db->get('mobile_makes');

                if ($q->num_rows == 1)
                {
                    $mcheckvar = 1;

                } else {

                    $mcheckvar = 0;
                }

                $this->db->where('company_id', $this->session->userdata('company_id'));
                $this->db->limit(1);
                $q = $this->db->get('computer_models');

                if ($q->num_rows == 1)
                {
                    $ccheckvar = 1;

                } else {

                    $ccheckvar = 0;
                }

                $newdata2 = array(
                        'scheck'        => $scheckvar,
                        'mcheck'        => $mcheckvar,
                        'ccheck'        => $ccheckvar
                        );

                $this->session->set_userdata($newdata2);

                $this->db->select('date_created');
                $this->db->where('email', $this->input->post('email'));
                $q2 = $this->db->get('users')->row();

                if ($query->is_agent == 0)
                {
                    $person = $this->session->userdata('name');

                    if ($person === '')
                    {

                        if ($query->payment_plan == "")
                        {

                            if(time() - strtotime($q2->date_created) > 60*60*168)
                            {
                                //older than 7 days
                                $this->session->set_flashdata('message', 'Hello!');
                                redirect('/settings', 'refresh');

                            } else {

                                //not older
                                $this->session->set_flashdata('message', 'Hello!');
                                redirect('/settings', 'refresh');
                            }
                        }

                        $this->session->set_flashdata('message', 'Hello!');
                        redirect('/settings', 'refresh');
                    }

                    if ($query->payment_plan == "")
                    {

                        if(time() - strtotime($q2->date_created) > 60*60*168)
                        {
                            //older than 7 days
                            $this->session->set_flashdata('message', 'Hello '.$person.'!');
                            redirect('/settings', 'refresh');

                        } else {

                            //not older
                            $this->session->set_flashdata('message', 'Hello '.$person.'!');
                            redirect('/settings', 'refresh');
                        }
                    }

                    $this->session->set_flashdata('message', 'Hello '.$person.'!');
                    redirect('/settings', 'refresh');
                }


                $this->session->set_flashdata('message', 'Welcome!');
                redirect('computers', 'refresh');

            }

            if ($this->auth_model->failed_login() == 0)
            {

                $this->session->set_flashdata('messagebad', 'Whoops, either your email address, password or both were incorrect, please try again.');

                redirect('login/error_login');

            } elseif ($this->auth_model->failed_login() == 1) {

                $this->session->set_flashdata('messagebad', 'You have tried to many times.');

                redirect('login/reset');

            } elseif ($this->auth_model->failed_login() == 2) {

                $this->session->set_flashdata('messagebad', 'This account has been deleted. You have 24 hours to have the account re-enabled. Please contact us.');

                redirect('contact');

            }
        }

        //load view
        $data['main_content'] = 'login_view';
        $this->load->view('layout/template', $data);
    }

    function reset()
    {
        if ($this->session->userdata('logged_in'))
        {
            redirect('computers');
        }

        //pass success or failed message
        $data['message'] = $this->session->flashdata('status');
        $data['messagebad'] = $this->session->flashdata('status_bad');

        //pass navigation info
        $data['active_page'] = 'passwordreset';

        //load view
        $data['main_content'] = 'passwordreset_view';
        $this->load->view('layout/template', $data);
    }

    function passwordreset_submit()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        //run form validation
        if ($this->form_validation->run() == FALSE)
        {
            $this->index(); //failed validation

        } else {

            //setup key
            $key = $this->encrypt->sha1(uniqid());

            //load signup model
            $this->load->model('user_passwordreset_model');

            // submit information to users_temp db
            if ($this->user_passwordreset_model->add_temp_key($key))
            {

                //email setup
                $this->load->library('email', array('mailtype' => 'html'));

                $this->email->from('support@assetbox.io', 'AssetBox Support');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Password Reset for your AssetBox.io account!");

                $message = "<h1>Follow the steps below to reset your password.\r\n</h1>";
                $message .= "<p>Click here https://assetbox.io/login/passwordreset/$key to reset your password.\r\n</p>";
                $message .= "<p>If you did not request a reset, contact support@assetbox.io.</p>";

                $this->email->message($message);
                $email = $this->input->post('email');
                //email send
                if ($this->email->send())
                {
                    $flashmessage = "A confirmation link has been emailed to <b>". $email. "</b><br> Didn't receive an email? Check your spam, bulk, or junk folder.";
                    $this->session->set_flashdata('messagebold', $flashmessage);
                    redirect('login');

                } else {

                    $this->session->set_flashdata('messagebad', 'Email failed to send, please contact support@assetbox.io');
                    redirect('login');
                }

            } else {

                $this->session->set_flashdata('messagebad', 'Something went wrong, ERROR #49, please contact support@assetbox.io with the error code.');
                redirect('login');

            }
        }
    }

    function passwordreset($key)
    {

        $this->load->model('user_passwordreset_model');

        if ($this->user_passwordreset_model->check_key($key))
        {

            //pass navigation info
            $data['active_page'] = 'passwordreset_new';

            //load view
            $data['main_content'] = 'passwordnew_view';
            $this->load->view('layout/template', $data);

        } else {

            $this->session->set_flashdata('messagebad', 'Something went wrong, ERROR #52, please contact support@assetbox.io with the error code.');
            redirect('signup');
        }
    }

    function passwordreset_check()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('key', 'Reset Key', 'trim|required|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

        //run form validation
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('messagebad', 'Please make sure your email address is correct and that the passwords match.');
            $key = $this->input->post('key');
            redirect('login/passwordreset/'.$key, 'location');

        } else {

            $this->load->model('user_passwordreset_model');

            if ($this->user_passwordreset_model->double_check())
            {

                if ($this->user_passwordreset_model->change_pass())
                {

                    $this->session->set_flashdata('messagebad', 'Something went wrong, ERROR #50, please contact support@assetbox.io with the error code.');
                    redirect('signup');

                } else {

                    $this->session->set_flashdata('messagebold', 'The password reset was successful. <br><br><div class="btn btn-primary btn-lg>"'.anchor('#loginmodal','Login', 'data-toggle="modal"').'</div>');
                    redirect('login');

                }

            } else {

                $this->session->set_flashdata('messagebad', 'Something went wrong. Make sure you entered the correct email address. Use the back button to try again.<br>If you continue to have problems, please contact support@assetbox.io with the error code, #51.');
                redirect('login');

            }
        }
    }

    function error_login()
    {

        if ($this->session->userdata('logged_in'))
        {
            redirect('computers');
        }

        //pass success or failed message
        $data['message'] = $this->session->flashdata('status');
        $data['messagebad'] = $this->session->flashdata('status_bad');

        //load view
        $data['main_content'] = 'login_view';
        $this->load->view('layout/template', $data);

    }

}