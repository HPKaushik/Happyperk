<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends Front_Controller {

	function __construct() {
		parent::__construct();
		// $this->load->model('order_model');
	}

	/**
	 * User Profile Page
	 * Date : 7-11-2017
	 * @author Kaushik
	 */

	public function send_otp() {
		$param = array('mobilenumber' => "919409590342", 'otptype' => '15');
		$response = $this->oxigenapi->send_otp(SEND_OTP_WALLET_URL, $param);
		print_r(json_decode($response));
	}
	public function send_verification_code() {
		$param = array('mobilenumber' => "919601477006");
		$response = $this->oxigenapi->send_verification_code(MOBILE_VERIFICATION_URL, $param);
		print_r(json_decode($response));
	}
	public function create_wallet() {
		$param = array(
			'mobilenumber' => "919601477006",
			'DOB' => '25/02/1992',
			'Name' => 'Ruku',
			'verificationcode' => '',
		);
		$this->oxigenapi->create_wallet(SEND_OTP_WALLET_URL, $param);
	}
	public function load_into_my_wallet() {
		$param = array(
			'mobilenumber' => "919409590342",
			'Amount' => '2500',
			'Name' => 'Ruku',
		);
		$this->oxigenapi->load_into_my_wallet(LOAD_TO_WALLET_URL, $param);
	}
	public function do_payment_from_oxigen_wallet() {
		$param = array(
			'transid' => "17565541564622",
			'Amount' => '2500',
			'otp' => '848518',
			'Mobilenumber' => '919409590342',
		);
		$response = $this->oxigenapi->do_payment_from_oxigen_wallet(PAYMENT_URL, $param);
		print_r(json_decode($response));
	}
	public function do_payment_reverse_oxigen_wallet() {
		$param = array(
			'transactionnumber' => "89554044011516432067",
		);
		$response = $this->oxigenapi->do_payment_reverse_oxigen_wallet(PAYMENT_REVERSE_URL, $param);
		print_r(json_decode($response));
	}
	public function do_payment_enquiry_oxigen_wallet() {
		$param = array(
			'transID' => "89554044011516432067",
		);
		$response = $this->oxigenapi->do_payment_enquiry_oxigen_wallet(PAYMENT_ENQUIRY_URL, $param);
		print_r(json_decode($response));
	}
	public function do_payment_part_reverse_oxigen_wallet() {
		$param = array(
			'transactionnumber' => "63335277011515482494",
			'amount' => '20',
		);
		$response = $this->oxigenapi->do_payment_part_reverse_oxigen_wallet(PAYMENT_PART_REVERSE_URL, $param);
		print_r(json_decode($response));
	}
	public function get_my_balance() {
		$param = array('mobilenumber' => "919409590342");
		$response = $this->oxigenapi->get_my_balance(WALLET_BALANCE_URL, $param);
		print_r(json_decode($response));
	}
	public function get_merchant_balance() {
		$response = $this->oxigenapi->get_merchant_balance(MERCHANT_BALANCE_URL);
		print_r(json_decode($response));
	}
	public function get_operator_list() {
		$response = $this->oxigenapi->get_operator_list(OPERATOR_LIST);
		
	}
	public function get_operator_info() {
        if($this->input->get()!='') { 
            $phone = $this->input->get('phone');
    		$param = array(
                'mobilenumber' => "91".$phone
            );
           	$response = $this->oxigenapi->get_operator_info(OPERATOR_INFO, $param);
            // prx($response);
            // echo json_encode(json_decode($response));
            // exit;
        }
        return false;
	}
	public function send_to_other_wallet() {
		$param = array(
			'mobilenumber' => "919409590342",
			'benemobile' => "918320292635",
			'transid' => "9183369269409590342",
			'Amount' => "5000",
			'otp' => "905836",
		);
		$response = $this->oxigenapi->send_to_other_wallet(TRANSFERWALLET_URL, $param);
		print_r(json_decode($response));
	}
	public function get_recharge_plan() {
         if($this->input->get()!='') { 
            $operator = $this->input->get('operator');
            $region = $this->input->get('region');
    		$param = array(
    			'OperatorAlias' => $operator,
    			'RegionAlias' => $region,
		      );
    		$response = $this->oxigenapi->get_recharge_plan(RECHARGE_PLAN, $param);
    		print_r(json_decode($response));
	       }
    }
}

/* End of file Front_User.php */
/* Location: .//C/Users/Karan/AppData/Local/Temp/fz3temp-2/Front_User.php */