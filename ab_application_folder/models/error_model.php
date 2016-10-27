<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_model extends CI_Model
{

	function error_404($seg1, $seg2, $seg3, $seg4, $seg5, $seg6) {

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		$ip = $_SERVER['REMOTE_ADDR'];
		}

	    $error_data = array(
	        'url_1' => $seg1,
	        'url_2' => $seg2,
	        'url_3' => $seg3,
	        'url_4' => $seg4,
	        'url_5' => $seg5,
	        'url_6' => $seg6,
	        'ip' => $ip
	    );

	    //insert data
	    $insert = $this->db->insert('errors', $error_data);

	    return $insert;

	}
}