<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function isShortnameExitst($shortname = '') {
	$CI = &get_instance();
	if (!empty($shortname)) {
		$return = $CI->db->select('short_name,logo,corporate_id,company_name')->where('short_name', $shortname)->get(CORPORATE_TABLE);
		if ($return->num_rows() == 1) {
			$comapany = $return->row_array();
			return $comapany;
		} else {
			return false;
		}
		return false;
	}
	return false;
}

function getShortName() {
	$pieces = parse_url(base_url());
	$domain = str_replace('www.', '', $pieces['host']);
	$domain = explode('.', $domain);
	if (count($domain) == 3) {
		return $domain[0];
	}
	return false;
}

if (!function_exists('isWalletExistonOxygen')) {

	function isWalletExistonOxygen() {
		$ci = &get_instance();
		$user = $ci->session->userdata('logged_in');
		if (!$user) {
			redirect(base_url());
		} else {
			$logged = $ci->session->userdata('employeed_logged_in');
			$param = array('mobilenumber' => $logged['phone']);
			$return = $ci->oxigenapi->is_wallet_exist(VERIFY_WALLET_URL, $param);
			if (!empty($return) && is_object($return)) {
				return ($return->ResponseCode == 1002) ? true : false;
			}
		}
		return false;
	}

}

function getCompanyDetails($id = '') {
	$CI = &get_instance();
	$return = $CI->db->select('short_name,logo,corporate_id,company_name')->where('corporate_id', $id)->get(CORPORATE_TABLE);
	if ($return->num_rows() == 1) {
		$comapany = $return->row_array();
		return $comapany;
	} else {
		return false;
	}
	return false;
}

if (!function_exists('updateUserLoginActivityTrack')) {

	function updateUserLoginActivityTrack($user_id, $corporate_id) {
		$ci = &get_instance();
		$ci->load->library('activity_log');
		$update_last_loggedin = $ci->user_model->update(array('lastsignedinon' => date('Y-m-d H:m:s')), array('user_id' => $user_id));
		$insert['user_id'] = $user_id;
		$insert['logged_in_at'] = date('Y-m-d H:i:s');
		$result = $ci->user_session_log_model->insert($insert);
		$data['activity_log'] = $ci->activity_log->addActivity($user_id, $corporate_id, AUTHENTICATION_MODULE, LOGGED_IN, $result);
		return ($result) ? true : false;
	}

}

function isCorporateActive($corporateId = '') {
	$CI = &get_instance();
	$return = $CI->db->select('status')->where('corporate_id', $corporateId)->get(CORPORATE_TABLE)->row_array();
	if ($return['status'] == 0) {
		return false;
	} else {
		return $return;
	}

}

if (!function_exists('get_user_name')) {

	function get_user_name($userId) {
		$ci = &get_instance();
		$return = $ci->db->select('first_name,last_name')->where('employee_id', $userId)->get(EMPLOYEE_TABLE);
		if ($return->num_rows() == 1) {
			$user = $return->row_array();
			return $user['first_name'] . ' ' . $user['last_name'];
		} else {
			return false;
		}
		return false;
	}

}