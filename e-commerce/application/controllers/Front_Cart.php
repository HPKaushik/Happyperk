<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Cart extends Front_Controller {
 	protected $response = array();	
 	protected $cashback = 0;	
 	protected $cashback_mode = '';	

	public function __construct() {
		parent::__construct();
		if (!$this->aauth->is_loggedin()){ redirect(); }
		$this->load->library('cart', 'Transaction');
		$this->load->model(array('vouchers_model', 'home_model'));
	}

	public function index() {
		// $thiscashback = 0;
		if ($this->cart->contents() != '') {
			foreach ($this->cart->contents() as $item) {
				$cb_amount = isset($item['cashback_amount']) && $item['cashback_amount'] > 0 ? $item['cashback_amount'] : 0;
				$cashback = $cb_amount * $item['qty'];
			}
		}
		$data['cashback'] = ($this->cashback != 0) ? $this->cashback : 0;
		$this->template->write('title', 'HappyPerks');
		$this->template->add_js('assets/js/cart.js');
		$this->template->write_view('content', 'cart/index', isset($data) ? $data : NULL);
		$this->template->render();
	}
	public function add() {
		$usage_per_user = 0;
		if ($this->input->post() != '') {
			$postdata = escape_post_strings($this->input->post());
			$this->cart->destroy();
			// ordered voucher id
			$id = $postdata['id'];
			// ordered voucher quantity
			$quantity = $postdata['quantity'];
			// ordered voucher details
			$voucher_details = $this->vouchers_model->get_voucher_array($id);

			if (!empty($voucher_details)) {
				$count_coupons = $this->vouchers_model->get_avalible_coupon_count($id);
				if ($count_coupons > 0) {
						$price = !empty($voucher_details['offer_price']) ? $voucher_details['offer_price'] : $voucher_details['price'];
						//usage_per_user
						if ($voucher_details['usage_per_user'] != '' && $voucher_details['usage_per_user'] < $count_coupons) {
							$usage_per_user = $voucher_details['usage_per_user'];
						} else {
							$usage_per_user = $count_coupons;
						}

						// cashback of voucher
						if (isset($voucher_details['cashback']) && !empty($voucher_details['cashback'])) {
							if ($voucher_details['cashback_mode'] == PERCENTAGE_MODE) {
								$this->cashback = $price * ($voucher_details['cashback'] / 100);
							} 
							else { 
								$this->cashback = $voucher_details['cashback'];
							}
						}
						// to make plenty string as not allowed in cart lib.
						$result = preg_replace("/[^\\w. -]/", "", $voucher_details['name']);
						$data = array(
							'id' => $id,
							'qty' => $quantity,
							'price' => $price,
							'name' => $result,
							'max' => $usage_per_user,
							'cashback_amount' => $this->cashback,
						);
						if ($this->cart->insert($data)) {
							redirect('cart');
						} else {
							redirect('home');
						}
					}
				}
			}
	}
	public function review() {
		$this->template->write('title', 'HappyPerks');
		$this->template->add_js('assets/js/cart.js');
		$this->template->write_view('content', 'cart/review', isset($data) ? $data : NULL);
		$this->template->render();
	}

	public function recharges() {
		$this->cart->destroy();
		$this->cashback_mode = '';
		$this->cashback = '';
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
			'cashback_mode' => $this->cashback_mode,
			'cashback_amount' => $this->cashback,
		);
		if ($this->cart->insert($data)) {
			$this->response['success'] = 1;
			$this->response['redirectUrl'] = 'cart';
		} else {
			$this->response['success'] = 0;
		}

		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'cart/index', isset($data) ? $data : NULL);
		$this->template->render();
	}



	

	public function remove($rowid = '') {
		
		if ($rowid == "all") {
			$this->cart->destroy();

			$this->response['success'] = '1';
			$this->response['msg'] = 'Cart is clear';
		} else {

			$data = array(
				'rowid' => $rowid,
				'qty' => 0,
			);

			$this->cart->update($data);
			$this->response['success'] = 1;
			$this->response['msg'] = "Item is removed";
			$this->response['redirectUrl'] = 'cart';
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($this->response);
			exit;
		}

		//redirect('checkout');
	}

	public function update_cart() {
		$data = $this->input->post();

		if ($this->cart->update($data)) {
			$this->cashback = 0;
			foreach ($this->cart->contents() as $item) {
				$this->cashback += $item['cashback_amount'] * $item['qty'];
			}
			$this->response['success'] = 1;
			$this->response['items_count'] = count($this->cart->contents());
			$this->response['items_total_amount'] = "Rs. " . number_format($this->cart->total(), 0, '.', ',');
			$this->response['cashback_amount'] = "Rs. " . number_format($cashback, 0, '.', ',');

			if ($this->cart->total() > $this->mybalance) {
				$this->response['info'] = "You have to pay using debit card or Net banking";
			}
		} else {
			$this->response['success'] = 0;
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($this->response);
			exit;
		}
	}

}

	// public function add_hotels() {
	// 	$this->cart->destroy();

	// 	$this->cashback_mode = '';
	// 	$this->cashback = '';

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
	// 		'cashback_mode' => $this->cashback_mode,
	// 		'cashback_amount' => $this->cashback,
	// 	);

	// 	if ($this->cart->insert($data)) {
	// 		$this->response['success'] = 1;
	// 		$this->response['redirectUrl'] = 'cart';
	// 	} else {
	// 		$this->response['success'] = 0;
	// 	}
	// 	if ($this->input->is_ajax_request()) {
	// 		echo json_encode($this->response);
	// 		exit;
	// 	}
	// }