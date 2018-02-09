<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Cart extends Front_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->aauth->is_loggedin()){ redirect(); }
		$this->load->library('cart', 'Transaction');
		$this->load->model(array('vouchers_model', 'home_model'));
	}

	public function index() {
		$data['base_url'] = BASEURL;
		$cashback = 0;
		if ($this->cart->contents() != '') {
			foreach ($this->cart->contents() as $item) {
				$cb_amount = isset($item['cashback_amount']) && $item['cashback_amount'] > 0 ? $item['cashback_amount'] : 0;
				$cashback = $cb_amount * $item['qty'];
			}
		}
		$data['cashback'] = ($cashback != 0) ? $cashback : 0;
		$this->template->write('title', 'HappyPerks');
		$this->template->add_js('assets/js/cart.js');
		$this->template->write_view('content', 'cart/index', isset($data) ? $data : NULL);
		$this->template->render();
	}
	public function review() {
		$this->template->write('title', 'HappyPerks');
		$this->template->add_js('assets/js/cart.js');
		$this->template->write_view('content', 'cart/review', isset($data) ? $data : NULL);
		$this->template->render();
	}

	public function recharges() {
		$this->cart->destroy();
		$response = array();
		$cashback_mode = '';
		$cashback_amount = '';
		if ($this->input->post('mobilerechargeno') != NULL && !empty($this->input->post('mobilerechargeno'))) {
			$mobilerechargeno = $this->input->post('mobilerechargeno');
		} else {
			$mobilerechargeno = '';
		}
		if ($this->input->post('offer_type') != NULL && !empty($this->input->post('offer_type'))) {
			$offer_type = $this->input->post('offer_type');
		} else {
			$offer_type = '';
		}
		if ($this->input->post('sim_type') != NULL && !empty($this->input->post('sim_type'))) {
			$sim_type = $this->input->post('sim_type');
		} else {
			$sim_type = '';
		}
		if ($this->input->post('broadband_package') != NULL && !empty($this->input->post('broadband_package')) AND $this->input->post('broadband_userid') != NULL && !empty($this->input->post('broadband_userid'))) {
			$broadband_package = $this->input->post('broadband_package');
			$broadband_userid = $this->input->post('broadband_userid');
		} else {
			$broadband_package = '';
			$broadband_userid = '';
		}
		if ($this->input->post('subscribe_id') != NULL && !empty($this->input->post('subscribe_id'))) {
			$subscribe_id = $this->input->post('subscribe_id');
		} else {
			$subscribe_id = '';
		}
		if ($this->input->post('account_no') != NULL && !empty($this->input->post('account_no'))) {
			$account_no = $this->input->post('account_no');
		} else {
			$account_no = '';
		}
		$sess = array(
			'mobilerechargeno' => $mobilerechargeno,
			'rechargeOfType' => $this->input->post('rechargeOfType'),
			'operator' => $this->input->post('operator'),
			'region' => $this->input->post('region'),
			'operatorname' => $this->input->post('operatorname'),
			'regioncircle' => $this->input->post('regioncircle'),
			'mobilerechargeamount' => $this->input->post('mobilerechargeamount'),
			'sim_type' => $sim_type,
			'offer_type' => $offer_type,
			'broadband_package' => $broadband_package,
			'broadband_userid' => $broadband_userid,
			'subscribe_id' => $subscribe_id,
			'account_no' => $account_no,
			'transaction_id' => rand(),
		);
		$this->session->set_userdata('rechargevalue', $sess);

		$recharge_data = !empty($this->input->post()) ? $this->input->post() : get_session_var('rechargevalue');
		$data = array(
			'id' => uniqid(),
			'qty' => 1,
			'price' => $recharge_data['mobilerechargeamount'],
			'name' => $recharge_data['mobilerechargeno'],
			'cashback_mode' => $cashback_mode,
			'cashback_amount' => $cashback_amount,
		);
		if ($this->cart->insert($data)) {
			$response['success'] = 1;
			$response['redirectUrl'] = 'cart';
		} else {
			$response['success'] = 0;
		}

		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'cart/index', isset($data) ? $data : NULL);
		$this->template->render();
	}

	// public function add_hotels() {
	// 	$this->cart->destroy();

	// 	$response = array();
	// 	$cashback_mode = '';
	// 	$cashback_amount = '';

	// 	/* $hp_id = $this->input->post('id'); */
	// 	$hp_id = 12;
	// 	/* $quantity = $this->input->post('quantity'); */
	// 	$quantity = 1;

	// 	$hotel_package = $this->hotels_model->get_hotel_package($hp_id);
	// 	$hotel_package_data = (array) $hotel_package[0];

	// 	$price = !empty($hotel_package_data['offer_price']) ? $hotel_package_data['offer_price'] : $hotel_package_data['price'];

	// 	$data = array(
	// 		'id' => $hotel_package_data['id'],
	// 		'qty' => $quantity,
	// 		'price' => $price,
	// 		'name' => $hotel_package_data['name'],
	// 		'cashback_mode' => $cashback_mode,
	// 		'cashback_amount' => $cashback_amount,
	// 	);

	// 	if ($this->cart->insert($data)) {
	// 		$response['success'] = 1;
	// 		$response['redirectUrl'] = 'cart';
	// 	} else {
	// 		$response['success'] = 0;
	// 	}
	// 	if ($this->input->is_ajax_request()) {
	// 		echo json_encode($response);
	// 		exit;
	// 	}
	// }

	public function add() {
		$response = array();
		$cashback_mode = '';
		$usage_per_user = 0;
		$cashback_amount = 0;
		if ($this->input->post() != '') {
			$this->cart->destroy();
			// ordered voucher id
			$id = $this->input->post('id');
			// ordered voucher quantity
			$quantity = $this->input->post('quantity');
			// ordered voucher details
			$voucher_details = $this->vouchers_model->get_voucher_array($id);

			if (!empty($voucher_details)) {
				$count_coupons = $this->vouchers_model->get_avalible_coupon_count($id);
				if ($count_coupons > 0) {
					$price = !empty($voucher_details['offer_price']) ? $voucher_details['offer_price'] : $voucher_details['price'];
					if ($voucher_details['usage_per_user'] != '' && $voucher_details['usage_per_user'] < $count_coupons) {
						$usage_per_user = $voucher_details['usage_per_user'];
					} else {
						$usage_per_user = $count_coupons;
					}
					// cashback of voucher
					if (isset($voucher_details['cashback']) && !empty($voucher_details['cashback'])) {
						if ($voucher_details['cashback_mode'] == PERCENTAGE_MODE) {
							// $cashback_mode = 'P';
							$cashback_amount = $price * ($voucher_details['cashback'] / 100);
						} else {
							// $cashback_mode = 'F';
							$cashback_amount = $voucher_details['cashback'];
						}
					}
					$re = "/[^\\w. -]/";
					$result = preg_replace($re, "", $voucher_details['name']);
					$data = array(
						'id' => $id,
						'qty' => $quantity,
						'price' => $price,
						'name' => $result,
						'max' => $usage_per_user,
						'cashback_amount' => $cashback_amount,
					);
					if ($this->cart->insert($data)) {
						$response['success'] = 1;
						$response['redirectUrl'] = 'cart';
					} else {
						$response['success'] = 0;
					}
					if ($this->input->is_ajax_request()) {
						echo json_encode($response);
						exit;
					}
				}
			}
		}
		// redirect('cart/');
	}

	public function remove($rowid = '') {
		$response = array();

		if ($rowid == "all") {
			$this->cart->destroy();

			$response['success'] = '1';
			$response['msg'] = 'Cart is clear';
		} else {

			$data = array(
				'rowid' => $rowid,
				'qty' => 0,
			);

			$this->cart->update($data);
			$response['success'] = 1;
			$response['msg'] = "Item is removed";
			$response['redirectUrl'] = 'cart';
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($response);
			exit;
		}

		//redirect('checkout');
	}

	public function update_cart() {
		$response = array();
		$data = $this->input->post();

		if ($this->cart->update($data)) {
			$cashback = 0;
			foreach ($this->cart->contents() as $item) {
				$cashback += $item['cashback_amount'] * $item['qty'];
			}
			$response['success'] = 1;
			$response['items_count'] = count($this->cart->contents());
			$response['items_total_amount'] = "Rs. " . number_format($this->cart->total(), 0, '.', ',');
			$response['cashback_amount'] = "Rs. " . number_format($cashback, 0, '.', ',');

			if ($this->cart->total() > $this->mybalance) {
				$response['info'] = "You have to pay using debit card or Net banking";
			}
		} else {
			$response['success'] = 0;
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($response);
			exit;
		}
	}

}
