<?php

class Front_Controller extends CI_Controller {

	protected $requested_page;
	public $USER_DETAILS;
	// public $isAdmin = FALSE;
	// public $isEmployee = FALSE;
	// public $isCorporate = FALSE;
	// public $isMarchent = FALSE;
	public $isLoginEmployeed = FALSE;
	public $userId;
	public $employeeId;
	public $mybalance = 0;
	public $corporateId = NULL;
	
	public function __construct() { 
		parent::__construct();
		$this->location_id = !empty(get_session_var('user_location')) ? get_session_var('user_location')['id'] : 0;
		$this->load->model(array('employee_model','user_model','available_location_model','location_model'));
		
		if(get_session_var('logged_in')) {
			$this->USER_DETAILS = get_session_var('employeed_logged_in');
			// prx($this->USER_DETAILS);
			$this->userId = !empty(get_session_var('user_id')) ? get_session_var('user_id') : NULL;
			$this->corporateId = !empty($this->USER_DETAILS['corporate_id']) ? $this->USER_DETAILS['corporate_id'] : NULL;
			$this->employeeId = !empty($this->USER_DETAILS['employee_id']) ? $this->USER_DETAILS['employee_id'] : NULL;
			$this->mybalance = $this->transaction->getEmployeeWalletBalance($this->employeeId);
		}
		$data['locations'] = $this->available_location_model->get_locations();
		$this->load->vars($data);
		// prx($this) ;
	} 
	public function setLocation($userId, $loc_id = NULL) {
		if (!empty($userId)) {
			if ($loc_id != '') {
				$currentCity = $this->available_location_model->getRow('*', array('id' => $loc_id));
				$u = $this->employee_model->update(array('last_location' => $loc_id), array('user_id' => $this->userId));
				if ($u) {
					$user = $this->employee_model->getRow('employee_id, user_id, last_location', array('user_id' => $userId));
					if (!empty($user)) {
						$currentCity = $this->available_location_model->getRow('*', array('id' => $user->last_location));
						$this->session->set_userdata('user_location', (array) $currentCity);
					} else {
						$this->session->set_userdata('user_location', array());
					}
				}
			} else {
				$user = $this->employee_model->getRow('employee_id, user_id, last_location', array('user_id' => $userId));
				if (!empty($user)) {
					$currentCity = $this->available_location_model->getRow('*', array('id' => $user->last_location));
					$this->session->set_userdata('user_location', (array) $currentCity);
				} else {
					$this->session->set_userdata('user_location', array());
				}
			}
		} else {
			return false;
		}

	}
}