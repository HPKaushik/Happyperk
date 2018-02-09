<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 *    FUNCTION NAME SHOULD BE LIKE
 *    1. IF MORE THAN ONE WORD ADD UNDERSCORE
 *        LIKE:  GET BALANCE - Function Name will be get_balance.
 *    2. USE SMALLER CASE ONLY
 *    3. MUST HAVE NAME AS OPERATION
 *
 */

// Dont work without permission. Don't Ignore this. Be good as you are.
class Oxigenapi {

	protected $_ci;
	protected $_curl;
	protected $response = '';
	protected $OXIGEN_PAY_KEYWORD = 'happyperkpay'; // used while going to do payment transaction
	protected $OXIGEN_LOAD_KEYWORD = 'happyperkload'; // used while going to do load transaction
	protected $OXIGEN_PAY_REVERSE_KEYWORD = 'happyperk_reversal'; // used while going to do load transaction
	protected $OXIGEN_P2P_KEYWORD = 'HPP2P'; // used while going to do transaction of trnasfer one to another wallet.
	protected $OXIGEN_USERNAME = 'FTRACKCAB'; // Username for authantication API
	protected $OXIGEN_PASSWORD = 'znfbPLR261E='; // Password for authantication API
	protected $HP_MERCHANT_ID = '1135699913'; // Merchant id  for Payment and load.
	protected $options = array();

	function __construct() {
		$this->_ci = &get_instance();
		$this->_curl = curl_init();
		// curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($this->_curl, CURLOPT_USERPWD, $this->OXIGEN_USERNAME . ":" . $this->OXIGEN_PASSWORD);
	}

	/**
	 * Function Name : is_wallet_exist
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To check is wallet exit on oxigen or not.
	 */
	function is_wallet_exist($url = '', $param = array()) {
		$this->response = $this->make_post_call($url, $param);
		return $this->response;
	}

	/**
	 * Function Name : get_my_balance
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To get balance of oxigen wallet.
	 */
	function get_my_balance($url = '', $param = array()) {
		if (!empty($url)) {
			$geturl = $this->get_url($url, $param);
			$this->response = $this->make_get_call($geturl);
			$response = json_encode($this->response);
			return $response;
		}
	}
	/**
	 * Function Name : get_merchant_balance
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To get balance of oxigen wallet.
	 */
	function get_merchant_balance($url = '', $param = array()) {
		if (!empty($url)) {
			$param['transid'] = "349878972364646456654";
			$param['mobilenumber'] = $this->HP_MERCHANT_ID;
			$this->response = $this->make_post_call($url, $param);
			$response = json_encode($this->response);
			return $response;
		}
	}

	/**
	 * Function Name : do_payment_from_oxigen_wallet
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To pay against any order.
	 */

	function do_payment_from_oxigen_wallet($url = '', $param = array()) {

		$param['keyword'] = $this->OXIGEN_PAY_KEYWORD;
		$param['username'] = $this->OXIGEN_USERNAME;
		$param['password'] = $this->OXIGEN_PASSWORD;
		$param['Mis1'] = $this->HP_MERCHANT_ID;
		$this->response = $this->make_post_call($url, $param);

		return $this->response;
	}
	function do_payment_enquiry_oxigen_wallet($url = '', $param = array()) {

		$param['keyword'] = $this->OXIGEN_PAY_KEYWORD;
		$param['username'] = $this->OXIGEN_USERNAME;
		$param['password'] = $this->OXIGEN_PASSWORD;
		$this->response = $this->make_post_call($url, $param);

		return $this->response;
	}
	function do_payment_reverse_oxigen_wallet($url = '', $param = array()) {

		$param['keyword'] = $this->OXIGEN_PAY_REVERSE_KEYWORD;
		$param['username'] = $this->OXIGEN_USERNAME;
		$param['password'] = $this->OXIGEN_PASSWORD;
		$this->response = $this->make_post_call($url, $param);

		return $this->response;
	}
	function do_payment_part_reverse_oxigen_wallet($url = '', $param = array()) {
		$param['keyword'] = $this->OXIGEN_PAY_REVERSE_KEYWORD;
		$param['username'] = $this->OXIGEN_USERNAME;
		$param['password'] = $this->OXIGEN_PASSWORD;
		$this->response = $this->make_post_call($url, $param);
		return $this->response;
	}
	function do_recharge_call($url,$param) {
		$param['username'] = $this->OXIGEN_USERNAME;
		$param['password'] = $this->OXIGEN_PASSWORD;
		$this->response = $this->make_post_call($url, $param);
		// prx($this->response);
		return $this->response;
	}

	/**
	 * Function Name : load_into_my_wallet
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To get balance of oxigen wallet.
	 */
	function load_into_my_wallet($url = '', $param = null) {
		if (!empty($url) && !empty($param)) {
			$param['keyword'] = $this->OXIGEN_LOAD_KEYWORD;
			$param['username'] = $this->OXIGEN_USERNAME;
			$param['password'] = $this->OXIGEN_PASSWORD;
			$param['mpin'] = '123456';
			$param['Mis1'] = $this->HP_MERCHANT_ID;
			$this->response = $this->make_post_call($url, $param);
			// $response = json_decode($this->response);
			return $this->response;
		}
		return false;
	}

	function get_operator_list($url) {
		if (!empty($url)) {
			$get_url = $this->get_url($url);
			$this->response = $this->make_get_call($get_url);
			return $this->response;
		}
    }
    function get_operator_info($url,$param) {
      if (!empty($url)) {
			$get_url = $this->get_url($url,$param);
			$this->response = $this->make_get_call($get_url);
			echo $this->response;
		}
	}
	function get_recharge_plan($url) {
		if (!empty($url)) {
			$get_url = $this->get_url($url);
			$this->response = $this->make_get_call($get_url);
			return $this->response;
		}
	}
	/**
	 * Function Name : send_to_other_wallet
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :
	 *             url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To get balance of oxigen wallet.
	 */
	function send_to_other_wallet($url = '', $param = array()) {
		if (!empty($url) && !empty($param)) {
			$param['keyword'] = $this->OXIGEN_P2P_KEYWORD;
			$param['username'] = $this->OXIGEN_USERNAME;
			$param['password'] = $this->OXIGEN_PASSWORD;
			$this->response = $this->make_post_call($url, $param);
			$response = json_encode($this->response);
			return $response;
		}
	}
	/**
	 * Function Name : send_otp
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To send OTP.
	 */

	function send_otp($url, $param) {
		if (!empty($url) && !empty($param)) {
			$get_url = $this->get_url($url, $param);
			$this->response = $this->make_get_call($get_url, $param);
			return $this->response;
		}
	}

	function send_verification_code($url, $param) {
		$get_url = $this->get_url($url, $param);
		$this->response = $this->make_get_call($get_url); 
		$response = json_encode($this->response);
		return $response;
	}
	function create_wallet($url, $param) {
		if (!empty($url) && !empty($param)) {
			// $param['keyword'] = $this->OXIGEN_KEYWORD;
			$param['username'] = $this->OXIGEN_USERNAME;
			$param['password'] = $this->OXIGEN_PASSWORD;
			$this->response = $this->make_post_call($url, $param);
			$response = json_decode($this->response);
			return $response;
		}
	}

	//

	/**
	 * Function Name : send_to_other_wallet
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To make post method call of API using curl.
	 */
	function make_post_call($url, $params) {
		$data_string = json_encode($params);
		$this->_curl = curl_init($url);
		curl_setopt($this->_curl, CURLOPT_HEADER, 0);
		curl_setopt($this->_curl, CURLOPT_USERPWD, $this->OXIGEN_USERNAME . ":" . $this->OXIGEN_PASSWORD);
		curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
		);
		$this->response = curl_exec($this->_curl);
		return $this->response;
	}

	/**
	 * Function Name : make_get_call
	 * Author Name : Kaushik
	 * Date : 9- Jan- 2018
	 * Parameter :url : API url - string
	 *             param : Parameter array for api call - array().
	 * Used for : To make get method call of API using curl.
	 */
	function make_get_call($curl_url, $params = array()) {
		$this->_curl = curl_init();
		if (!empty($curl_url)) {
			curl_setopt($this->_curl, CURLOPT_HEADER, 0);
			curl_setopt($this->_curl, CURLOPT_USERPWD, $this->OXIGEN_USERNAME . ":" . $this->OXIGEN_PASSWORD);
			curl_setopt($this->_curl, CURLOPT_URL, $curl_url);
			curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
		 	$this->response= curl_exec($this->_curl);
			curl_close($this->_curl);
			if (!empty($this->response)) {
			return $this->response;
			}
		}
	}

	function set_post_param($params = array()) {
		if (is_array($params)) {
			$data_string = json_encode($params);
		}
		$this->option(CURLOPT_POSTFIELDS, $data_string);
	}

	function http_method($method) {
		$this->options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
		return $this;
	}

	function get_url($url, $params = array()) {
		return $url . ($params ? '?' . http_build_query($params, null, '&') : '');
	}

	function options($options = array()) {
		// Merge options in with the rest - done as array_merge() does not overwrite numeric keys
		foreach ($options as $option_code => $option_value) {
			$this->option($option_code, $option_value);
		}
		// Set all options provided
		curl_setopt_array($this->session, $this->options);
		return $this;
	}

	function option($code, $value, $prefix = 'opt') {
		if (is_string($code) && !is_numeric($code)) {
			$code = constant('CURL' . strtoupper($prefix) . '_' . strtoupper($code));
		}
		$this->options[$code] = $value;
		return $this;
	}

} 