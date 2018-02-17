<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Vouchers extends Front_Controller {
	protected $loggedUser;	
	public function __construct() {

		parent::__construct();
		$this->loggedUser = $this->aauth->is_loggedin();
		$this->load->model(array('vouchers_model','brands_model','category_model','awards_model','home_model','brands_redeem_location_model','vendor_model'));
		// $this->load->model(array('vouchers_model', 'brands_redeem_location_model', 'home_model','awards_model'));
	}

	public function index() {
		//get loction
		// $location_id = $this->location['id'];
		$data['vouchers'] = $this->vouchers_model->get_vouchers($this->location_id);
		$this->template->write('title', '');
		/* Adding Indiviual css files */
		$this->template->add_js(JSPATH.'/masonry.pkgd.min.js');
		$this->template->add_js(JSPATH.'/owl.carousel.min.js');
		$this->template->add_js(JSPATH.'/home.js');
		$this->template->write_view('content', 'vouchers/list', isset($data) ? $data : NULL);
		$this->template->render();
	}

	public function get_coupon($vid) {
		$this->load->model('order_model');
		$data['voucher'] = $this->vouchers_model->get_voucher($vid);
		$data['count_coupons'] = $this->vouchers_model->get_avalible_coupon_count($vid);
		$data['brandsloc'] = $this->vouchers_model->get_voucher_brand_locations($vid); 
		$data['googlemap'] = $this->load->view('vouchers/googlemap', isset($data) ? $data : NULL,true);
		$this->template->add_js(JSPATH.'/getCoupon.js');
		$this->template->write_view('content', 'vouchers/view', isset($data) ? $data : NULL);
		$this->template->render();
	}

	// function myUrlEncode($string) {
	// 	$entities = array(' ', '+', '-', '.', '%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
	// 	$replacements = '-';
	// 	return str_replace($entities, $replacements, urlencode($string));
	// }
	
	// Search by name.
	public function search() {
		if ($this->input->post() != '') {
			$post = escape_post_strings($this->input->post());
			$data['name'] = $post['name'];
			$data['vouchers'] = $this->vouchers_model->searchby($data['name']);
			$this->template->add_js(JSPATH.'/masonry.pkgd.min.js');
			// $this->template->add_js(JSPATH.'/owl.carousel.min.js');
			if ($this->input->is_ajax_request()) {
				   echo json_encode($data['vouchers']);
				   exit;
			}
			$this->template->add_js(JSPATH.'/home.js');
			$this->template->write_view('content', 'vouchers/list', isset($data) ? $data : NULL);
			$this->template->render();
		} else {
			redirect('home');
		}
	}
	public function getMoreVoucher() {
		$view_data = array();
		$data = array();
		// $award ='';
		$morevouchers = '';
		if ($this->input->post() != '') {
			$postdata = escape_post_strings($this->input->post());
			if ($postdata['is_last'] == 0) {
				$award_offset = 0;
				$limit = $postdata['limit'];
				$awardoffset = $postdata['awardoffset'];
				$queryAll = $this->vouchers_model->get_vouchers($this->location_id);
				$data['num'] = count($queryAll);
				$offset = $postdata['offset'];
				$data['offset'] = $offset + $limit;
				$data['is_last'] = ($data['num'] < $data['offset']) ? 1 : 0;
				
				// Awards
				if($this->aauth->is_loggedin()) {
					$data['awardoffset'] = $postdata['awardoffset'] + 1;
					$award = $this->awards_model->getRow('*', array('corporate_id' => $this->USER_DETAILS['corporate_id'], 'status' => '1'), '', 'id', 'DESC', 1, $awardoffset);
					$view_data['award'] = (count($award) > 0) ? $award : array();
				}
				$view_data['morevouchers'] = $this->vouchers_model->get_vouchers($this->location_id, $limit, NULL, $offset);
				$data['htmlcontent'] = $this->load->view('home/get_more_vouchers',isset($view_data)?$view_data:NULL, true);
			}
		}
		echo json_encode($data);
		exit;
	}

}
