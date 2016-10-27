<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller
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


	function detail()
    {
    $url_value = $this->uri->segment(3);

    $this->load->model('search_model');

    $data['query'] = $this->search_model->stock_detail($url_value);


		if ($url_value == "assets-needing-warranty-repair")
		{
			$head_var = "Warranty Repair";
		}
		elseif ($url_value == "assets-in-stock")
		{
			$head_var = "In stock";
		}
		elseif ($url_value == "assets-needing-nonwarranty-repair")
		{
			$head_var = "Non-warranty Repair";
		}
		elseif ($url_value == "assets-out-for-repair")
		{
			$head_var = "Being Repaired";
		}
		elseif ($url_value == "assets-ready-for-recycling")
		{
			$head_var = "Recycle & Decommissioned";
		}
		elseif ($url_value == "removed-assets")
		{
			$head_var = "Removed Assets";
		}
    elseif ($url_value == "accessories-in-stock")
    {
      $head_var = "Accessories In stock";
    }

		$data['detail_value'] = $head_var;

		if ($url_value == "assets-needing-nonwarranty-repair")
		{
            //settings for popup box
			$data['atts'] = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

			//pass menu info
            $data['active_page'] = 'dashboard';

            $data['main_content'] = 'stock_assets-needing-nonwarranty-repair_view';
            $this->load->view('layout/template', $data);
		}
		elseif ($url_value == "assets-out-for-repair")
		{
            //settings for popup box
			$data['atts'] = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

			//pass menu info
            $data['active_page'] = 'dashboard';

            $data['main_content'] = 'stock_assets-out-for-repair_view';
            $this->load->view('layout/template', $data);
        }
		elseif ($url_value == "assets-needing-warranty-repair")
		{
            //settings for popup box
			$data['atts'] = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

			//pass menu info
            $data['active_page'] = 'dashboard';

            $data['main_content'] = 'stock_assets-needing-warranty-repair_view';
            $this->load->view('layout/template', $data);
        }
		elseif ($url_value == "assets-ready-for-recycling")
		{
			//pass menu info
            $data['active_page'] = 'dashboard';

            $data['main_content'] = 'stock_assets-ready-for-recycling_view';
            $this->load->view('layout/template', $data);
        }
		elseif ($url_value == "removed-assets")
		{
			//pass menu info
            $data['active_page'] = 'dashboard';

            $data['main_content'] = 'stock_removed-assets_view';
            $this->load->view('layout/template', $data);
        }
		else
		{
			//settings for popup box
			$data['atts'] = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

			//pass menu info
            $data['active_page'] = 'dashboard';

            $data['main_content'] = 'stock_assets-in-stock_view';
            $this->load->view('layout/template', $data);
		}
    }

	function update_checked()
	{
		if ($this->input->post('item'))
    {
      $checked_messages = $this->input->post('item'); //selected messages

      $this->load->model('item_checkbox_model');

      if ($this->input->post('formtype') == "nowinstock")
      {
        $this->item_checkbox_model->update_checked_nowinstock($checked_messages);
      }
      elseif ($this->input->post('formtype') == "removed")
      {
        $this->item_checkbox_model->update_checked_removed($checked_messages);
      }
      elseif ($this->input->post('formtype') == "removed_mobile")
      {
        $this->item_checkbox_model->update_checked_removed_mobile($checked_messages);
      }
      elseif ($this->input->post('formtype') == "pcn_audit")
      {
        $this->item_checkbox_model->update_checked_audit($checked_messages);
      }
      else
      {
        $this->item_checkbox_model->update_checked($checked_messages);
      }

      $this->session->set_flashdata('message', 'Updated');
      redirect('dashboard/computer');

    } else {

      $this->session->set_flashdata('messagebad', 'No items were selected');
      redirect('dashboard');

    }

	}
}