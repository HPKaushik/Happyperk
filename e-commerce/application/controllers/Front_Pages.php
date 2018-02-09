<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Pages extends Front_Controller {

	function __construct() {
		parent::__construct();
		$this->loggedUser = $this->session->userdata('employeed_logged_in');
		$this->template->set_template('empty_temp');
		$this->template->write('meta_keywords', '');
		$this->template->write('meta_desc', '');
		$this->load->model(array('user_model', 'employee_model', 'home_model', 'brands_model', 'category_model'));
	}
	function about_us() {
		$data['brands'] = $this->brands_model->getResult('*', array('status' => '1'));
		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'frontend/about_us', isset($data) ? $data : NULL);
		$this->template->render();
	}
	function career() {
		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'frontend/career', isset($data) ? $data : NULL);
		$this->template->render();
	}
	function enqiry() {
		$insert1['user_id'] = $this->userId;
		$insert1['name'] = $_POST['first_name'];
		$insert1['email'] = $_POST['email'];
		$insert1['company_name'] = $_POST['company_name'];
		$insert1['mobileno'] = $_POST['mobile'];
		$insert1['comments'] = $_POST['comments'];
		$insert1['added_on'] = date('Y-m-d H:i:s');
		$result = $this->enquire_model->insert($insert1);
		echo 1;
	}

}

/* End of file front_Brands.php */
/* Location: ./application/controllers/front_Brands.php */