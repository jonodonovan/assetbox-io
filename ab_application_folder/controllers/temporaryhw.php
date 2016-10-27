<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temporaryhw extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		session_start();

		//check if logged in
		if (!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	public function index()
	{

		//temp use equipment
		$this->load->model('temporaryhw_model');

		//notebooks
		$data['notebook_query'] = $this->temporaryhw_model->get_tempdevices_notebook();

		//aircard
		$data['aircard_query'] = $this->temporaryhw_model->get_tempdevices_aircard();

		//projector
		$data['projector_query'] = $this->temporaryhw_model->get_tempdevices_projector();


/*******************************************/
/*******************************************/

	    //pass navigation info
	    $data['active_page'] = 'temporaryhw';

	    //pass the information to the view
	    $data['main_content'] = 'temporaryhw_view';
	    $this->load->view('layout/template', $data);

/*******************************************/
/*******************************************/

	}

	public function updatestatus()
	{
		$this->output->enable_profiler(TRUE);

		foreach ($this->input->post() as $key => $value)
		{

		    if ($value != "" && $value != "Update")
		    {

		        $this->db->select('action_type');
		        $this->db->where('serial_num', $key);
		        $this->db->limit(1);
		        $action_var = $this->db->get('items')->row()->action_type;

		        if ($action_var === "checkout")
		        {

		            $newaction_var = "checkin";

		        } elseif ($action_var === "checkin") {

		            $newaction_var = "checkout";

		        }

/*******************************************/
/*******************************************/

		        //update the db
		        $update_item_data = array(
		        'action_type' => $newaction_var,
		        'user_id' => $value,
		        'reason' => "Status change",
		        'added_by' => $_SESSION['username'],
		        'country' => $_SESSION['userlocation'],
		        'date_updated' => date("Y-m-d H:i:s")
		        );

		        //insert updated data
		        $this->db->where('serial_num', $key)->update('items', $update_item_data);
		        $insert_id = $this->db->insert_id();

/*******************************************/

		        //build array for history db
		        $new_item_insert_history = array(
	        	'item_id' => $insert_id,
	        	'serial_num' => $key,
		        'action_type' => $newaction_var,
		        'user_id' => $value,
		        'reason' => "Status change",
		        'added_by' => $_SESSION['username'],
		        'country' => $_SESSION['userlocation']
		        );

		        //insert history data
		        $insert2 = $this->db->insert('item_history', $new_item_insert_history);

/*******************************************/
/*******************************************/

		    }

		}

	redirect('temporaryhw');

	}
}