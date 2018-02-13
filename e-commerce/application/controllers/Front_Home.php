<?php

if (!defined('BASEPATH')) 	exit('No direct script access allowed');

class Front_Home extends Front_Controller {

	function __construct() {
		parent::__construct();
		$this->template->set_template('common');
		$this->load->model(array('vouchers_model','awards_model','home_model','location_model','available_location_model'));
	}
	function index() { 
		if(get_session_var('logged_in') && $this->USER_DETAILS['is_wallet_exist']==0)
			redirect('user/wallet/create');
		$data['bodyclass'] = 'index';
		$this->template->add_js(JSPATH.'/owl.carousel.min.js');
		$this->template->add_js(JSPATH.'/masonry.pkgd.min.js');
		$this->template->add_js(JSPATH.'/home.js');
		$this->template->add_js(JSPATH.'/recharge.js');
		$this->template->add_css(CSSPATH.'/slider.css');
		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'home/index', isset($data) ? $data : NULL);
		$this->template->render();
	}

	public function change_location($loc_id) {
		if (!empty($loc_id)) {
			if (!empty($this->userId)) {
				$this->setLocation($this->userId, $loc_id);
			}
		 else {
			$location = $this->available_location_model->getRow('*', array('id' => $loc_id));
			if (!empty($location)) {
				$currentCity = $this->available_location_model->getRow('*', array('city_id' => $location->city_id));
				$this->session->set_userdata('user_location', (array) $currentCity);
				}
			}
		}
		redirect('');
	}
	public function MarkAsReadAnnoucements() {
		$marked = $this->home_model->MarkAllAsReadAnnoucements($this->userId);			
		if($marked)
			echo json_encode(array('status'=>'1'));
		else echo json_encode(array('status'=>'0'));
		exit;
	}
}// 