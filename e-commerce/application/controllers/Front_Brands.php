<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Brands extends Front_Controller {

	function __construct() {
		parent::__construct();
		$this->template->set_template('common');
		$this->template->write('meta_keywords', '');
		$this->template->write('meta_desc', '');
		$this->load->model(array('user_model', 'employee_model', 'home_model', 'brands_model', 'category_model'));
	}
	function index() {
		$data['brands'] = $this->brands_model->getResult('*', array('status' => '1'));
		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'pages/brands', isset($data) ? $data : NULL);
		$this->template->render();
	}

}

/* End of file front_Brands.php */
/* Location: ./application/controllers/front_Brands.php */