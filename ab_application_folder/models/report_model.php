<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
/*    function get_topusers()
    {
		$total_users = 0;
        $this->db->select('user_id, COUNT(id) AS total');
		$this->db->where('user_id !=', '');
		$this->db->where('user_id !=', '0');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('user_id');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(5);

        $userrows = $this->db->get('computer_history')->result_array();

        foreach ($userrows as $count => $userrow)
        {
            $userrows[$count]['user_id'] = $userrow['user_id'];
			$total_users = ($total_users + $userrow['total']);
        }

		$total_mousers = 0;
        $this->db->select('user_id, COUNT(id) AS total');
		$this->db->where('user_id !=', '');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('user_id');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(5);

        $mouserrows = $this->db->get('mobile_history')->result_array();

        foreach ($mouserrows as $count => $userrow)
        {
            $mouserrows[$count]['user_id'] = $userrow['user_id'];
			$mototal_users = ($total_users + $userrow['total']);
        }


        $all_userrows = $userrows + $mouserrows;
        $all_total_users = $total_users + $mototal_users;


		return array(
					'us_userrows' => $all_userrows,
					'us_total_users' => $all_total_users
				);
    }

	function get_topreasons()
    {
		$total_reasons = 0;
        $this->db->select('reason, COUNT(id) AS total');
		$this->db->where('reason !=', '');
		$this->db->where('user_id !=', '0');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('reason');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(5);

        $reasonrows = $this->db->get('computer_history')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['reason'] = $reasonrow['reason'];
			$total_reasons = ($total_reasons + $reasonrow['total']);
        }
		return array(
					'us_reasonrows' => $reasonrows,
					'us_total_reasons' => $total_reasons
		);
    }*/

	function get_computer_info()
    {
		$total_models = 0;
        $this->db->select('model, COUNT(id) AS total');
		$this->db->where('model !=', '');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('model');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(5);

        $modelrows = $this->db->get('computer_history')->result_array();

        foreach ($modelrows as $count => $modelrow)
        {
            $modelrows[$count]['model'] = $modelrow['model'];
			$total_models = ($total_models + $modelrow['total']);
        }
		return array(
					'computer_rows' => $modelrows,
					'computer_count' => $total_models
		);
    }

	function get_software_info()
    {
		$total_models = 0;
        $this->db->select('name, COUNT(id) AS total');
		$this->db->where('name !=', '');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('name');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(5);

        $modelrows = $this->db->get('software_history')->result_array();

        foreach ($modelrows as $count => $modelrow)
        {
            $modelrows[$count]['name'] = $modelrow['name'];
			$total_models = ($total_models + $modelrow['total']);
        }
		return array(
					'software_rows' => $modelrows,
					'software_count' => $total_models
		);
    }

	function get_mobile_info()
    {
		$total_models = 0;
        $this->db->select('model, COUNT(id) AS total');
		$this->db->where('model !=', '');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('model');
		$this->db->order_by('total', 'DESC');
		$this->db->limit(5);

        $modelrows = $this->db->get('mobile_history')->result_array();

        foreach ($modelrows as $count => $modelrow)
        {
            $modelrows[$count]['model'] = $modelrow['model'];
			$total_models = ($total_models + $modelrow['total']);
        }
		return array(
					'mobile_rows' => $modelrows,
					'mobile_count' => $total_models
		);
    }



	function get_total_actionhistory()
    {
		$computer_total_actions = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionrows = $this->db->get('computer_history')->result_array();

        foreach ($actionrows as $count => $actionrow)
        {
            $actionrows[$count]['id'] = $actionrow['id'];
			$computer_total_actions = ($computer_total_actions + $actionrow['total']);
        }

		$software_total_actions = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionrows = $this->db->get('software_history')->result_array();

        foreach ($actionrows as $count => $actionrow)
        {
            $actionrows[$count]['id'] = $actionrow['id'];
			$software_total_actions = ($software_total_actions + $actionrow['total']);
        }

		$mobile_total_actions = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionrows = $this->db->get('mobile_history')->result_array();

        foreach ($actionrows as $count => $actionrow)
        {
            $actionrows[$count]['id'] = $actionrow['id'];
			$mobile_total_actions = ($mobile_total_actions + $actionrow['total']);
        }


		return $total_actions = $computer_total_actions + $software_total_actions + $mobile_total_actions;
    }

	function get_total_computers()
    {
		$total_computers = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('type_var', 'pcn');
        $this->db->where('action_type !=', 'removed');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->distinct();
        $computerrows = $this->db->get('computer')->result_array();

        foreach ($computerrows as $count => $computerrow)
        {
            $computerrows[$count]['id'] = $computerrow['id'];
			$total_computers = ($total_computers + $computerrow['total']);
        }

		return array(
					'us_computerrows' => $computerrows,
					'us_total_computers' => $total_computers
		);
    }

	function get_total_acc()
    {
		$total_accs = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('type_var', 'acc');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->distinct();
        $accrows = $this->db->get('computer')->result_array();

        foreach ($accrows as $count => $accrow)
        {
            $accrows[$count]['id'] = $accrow['id'];
			$total_accs = ($total_accs + $accrow['total']);
        }

		return array(
					'us_accrows' => $accrows,
					'us_total_accs' => $total_accs
		);
    }

	function get_total_swnames()
    {
		$total_accs = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->distinct();
        $accrows = $this->db->get('software')->result_array();

        foreach ($accrows as $count => $accrow)
        {
            $accrows[$count]['id'] = $accrow['id'];
			$total_accs = ($total_accs + $accrow['total']);
        }

		return array(
					'us_accrows' => $accrows,
					'us_total_swnames' => $total_accs
		);
    }

	function get_total_mobile()
    {
		$total_accs = 0;
        $this->db->select('id, COUNT(id) AS total');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->distinct();
        $accrows = $this->db->get('mobile')->result_array();

        foreach ($accrows as $count => $accrow)
        {
            $accrows[$count]['id'] = $accrow['id'];
			$total_accs = ($total_accs + $accrow['total']);
        }

		return array(
					'us_accrows' => $accrows,
					'us_total_mobile' => $total_accs
		);
    }

	function get_actions_oneweek()
    {
		$endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 6, date('Y')));

		$compuer_actionsweek = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('computer_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$compuer_actionsweek = ($compuer_actionsweek + $actionweekrow['total']);
        }

		$software_actionsweek = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('software_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$software_actionsweek = ($software_actionsweek + $actionweekrow['total']);
        }

		$mobile_actionsweek = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('mobile_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$mobile_actionsweek = ($mobile_actionsweek + $actionweekrow['total']);
        }

		return $us_total_actionsweek = $compuer_actionsweek + $software_actionsweek + $mobile_actionsweek;
    }

	function get_actions_fourweek()
    {
		$endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 12, date('Y')));

		$compuer_actionsfourweek = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('computer_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$compuer_actionsfourweek = ($compuer_actionsfourweek + $actionweekrow['total']);
        }

		$software_actionsfourweek = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('software_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$software_actionsfourweek = ($software_actionsfourweek + $actionweekrow['total']);
        }

		$mobile_actionsfourweek = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('mobile_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$mobile_actionsfourweek = ($mobile_actionsfourweek + $actionweekrow['total']);
        }

		return $us_total_actionsfourweek = $compuer_actionsfourweek + $software_actionsfourweek + $mobile_actionsfourweek;
    }

	function get_actions_onemonth()
    {
		$endDate = date("Y-m-d", mktime(0, 0, 0, date('m') - 12, date('d'), date('Y')));

		$compuer_actionsmonth = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('computer_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$compuer_actionsmonth = ($compuer_actionsmonth + $actionweekrow['total']);
        }

		$software_actionsmonth = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('software_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$software_actionsmonth = ($software_actionsmonth + $actionweekrow['total']);
        }

		$mobile_actionsmonth = 0;
        $this->db->select('id');
		$this->db->select('COUNT(id) AS total');
		$this->db->where('date_created >', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
        $actionweekrows = $this->db->get('mobile_history')->result_array();

        foreach ($actionweekrows as $count => $actionweekrow)
        {
			$mobile_actionsmonth = ($mobile_actionsmonth + $actionweekrow['total']);
        }

		return $us_total_actionsmonth = $compuer_actionsmonth + $software_actionsmonth + $mobile_actionsmonth;

    }


/**********************************************
*********************************************************************
***************************Mobile Setup*********************************
*********************************************************************
**********************************************/

	function get_topreasons2()
    {

    	$endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
		$total_reasons = 0;
        $this->db->select('device_id, ced');
        $this->db->where('ced !=', 0000-00-00);
		$this->db->where('ced <=', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('device_id');
		$this->db->order_by('ced', 'ASC');
		$this->db->limit(5);

        $reasonrows = $this->db->get('mobile')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['ced'] = $reasonrow['ced'];
            $reasonrows[$count]['device_id'] = anchor('itemprofile/index/m/'.$reasonrow['device_id'], $reasonrow['device_id']);
			$total_reasons = ($total_reasons + '1');
        }
		return array(
					'us_reasonrows2' => $reasonrows,
					'us_total_reasons2' => $total_reasons
		);
    }


	function get_topreasons3()
    {

    	$endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
		$total_reasons = 0;
        $this->db->select('device_id, crd');
        $this->db->where('crd !=', 0000-00-00);
		$this->db->where('crd <', $endDate);
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->group_by('device_id');
		$this->db->order_by('crd', 'ASC');
		$this->db->limit(5);

        $reasonrows = $this->db->get('mobile')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['crd'] = $reasonrow['crd'];
            $reasonrows[$count]['device_id'] = anchor('itemprofile/index/m/'.$reasonrow['device_id'], $reasonrow['device_id']);
			$total_reasons = ($total_reasons + '1');
        }
		return array(
					'us_reasonrows3' => $reasonrows,
					'us_total_reasons3' => $total_reasons
		);
    }

    //software - led - licenses ending dates
    function get_led()
    {

        $endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
        $total_reasons = 0;
        $this->db->select('license, ced, sw_code');
        $this->db->where('ced !=', 0000-00-00);
        $this->db->where('ced <', $endDate);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->group_by('license');
        $this->db->order_by('ced', 'ASC');
        $this->db->limit(5);

        $reasonrows = $this->db->get('software')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['ced'] = $reasonrow['ced'];
            $reasonrows[$count]['license'] = anchor('itemprofile/index/s/'.$reasonrow['sw_code'], $reasonrow['license']);
            $total_reasons = ($total_reasons + '1');

            $reasonrows[$count]['sw_code'] = NULL;
        }
        return array(
                    'led_rows' => $reasonrows,
                    'led_count' => $total_reasons
        );
    }

    //software - sed - support ending dates
    function get_sed()
    {

        $endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
        $total_reasons = 0;
        $this->db->select('license, sced, sw_code');
        $this->db->where('sced !=', 0000-00-00);
        $this->db->where('sced <', $endDate);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->group_by('license');
        $this->db->order_by('sced', 'ASC');
        $this->db->limit(5);

        $reasonrows = $this->db->get('software')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['sced'] = $reasonrow['sced'];
            $reasonrows[$count]['license'] = anchor('itemprofile/index/s/'.$reasonrow['sw_code'], $reasonrow['license']);
            $total_reasons = ($total_reasons + '1');

            $reasonrows[$count]['sw_code'] = NULL;
        }
        return array(
                    'sed_rows' => $reasonrows,
                    'sed_count' => $total_reasons
        );
    }

    function get_temp_comps()
    {
        $endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
        $this->db->select('serial_num, temp_date');
        $this->db->where('temp_date !=', 0000-00-00);
        $this->db->where('temp_date <', $endDate);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->group_by('serial_num');
        $this->db->order_by('temp_date', 'ASC');
        $this->db->limit(5);

        $reasonrows = $this->db->get('computer')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['temp_date'] = $reasonrow['temp_date'];
            $reasonrows[$count]['serial_num'] = anchor('itemprofile/index/c/'.$reasonrow['serial_num'], $reasonrow['serial_num']);
        }

        $total_reasons = 0;
        $this->db->select('serial_num');
        $this->db->where('temp_date !=', 0000-00-00);
        $this->db->where('company_id', $this->session->userdata('company_id'));

        $reasonrows2 = $this->db->get('computer')->result_array();

        foreach ($reasonrows2 as $count => $reasonrow2)
        {
            $total_reasons = ($total_reasons + '1');
        }
        return array(
            'comp_temp_rows' => $reasonrows,
            'comp_temp_count' => $total_reasons
        );

    }

    function get_temp_mobiles()
    {
        $endDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
        $total_reasons = 0;
        $this->db->select('device_id, temp_date');
        $this->db->where('temp_date !=', 0000-00-00);
        $this->db->where('temp_date <', $endDate);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->group_by('device_id');
        $this->db->order_by('temp_date', 'ASC');
        $this->db->limit(5);

        $reasonrows = $this->db->get('mobile')->result_array();

        foreach ($reasonrows as $count => $reasonrow)
        {
            $reasonrows[$count]['temp_date'] = $reasonrow['temp_date'];
            $reasonrows[$count]['device_id'] = anchor('itemprofile/index/m/'.$reasonrow['device_id'], $reasonrow['device_id']);
            $total_reasons = ($total_reasons + '1');
        }
        return array(
                    'mobile_temp_rows' => $reasonrows,
                    'mobile_temp_count' => $total_reasons
        );
    }

    function get_computers_not_in_stock_info()
    {
        //Computers not in Stock
        $total_amount_pcn = 0;
        $this->db->select('model, COUNT(id) AS total')->group_by('model')
              ->where('company_id =', $this->session->userdata('company_id'))
              ->where('type_var =', "pcn")
              ->where('action_type !=', "add")
              ->where('action_type !=', "checkin")
              ->where('action_type !=', "recycle")
              ->where('action_type !=', "repairin")
              ->where('action_type !=', "needsrepair")
              ->where('action_type !=', "audit_missing")
              ->where('action_type !=', "stockin")
              ->where('action_type !=', "warranty")
              ->where('action_type !=', "removed")
              ->where('action_type !=', "computer deleted")
              ->where('action_type !=', "lost_stolen");
        $stockrows = $this->db->get('computer')->result_array();

        foreach ($stockrows as $count => $stockrow)
        {

          $stockrows[$count]['model'] = $stockrow['model'];
          $total_amount_pcn = ($total_amount_pcn + $stockrow['total']);
        }

        return array(
                    'comp_out_rows' => $stockrows,
                    'comp_out_count' => $total_amount_pcn
        );
    }

}
