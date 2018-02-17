<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Buy extends Front_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->aauth->is_loggedin()){ redirect(); }
		$this->load->library('cart');
		$this->load->model(array('order_model', 'vouchers_model', 'employee_model', 'email_model', 'home_model'));
	}

	/**
	 * place order for Vouchers
	 * @author kaushik
	 * Date 4-11-2017
	 * Oxigen
	
	public function placeorder_oxignen() {
		$total_amount = $this->cart->total();
		$sub_total_amount = $total_amount;
		$cashback_amount = 0;
		$msg= '';
        $status = 0;
        $response = false;
		$otp = $this->input->post('otp');
		$trans_status ='';
		$transaction_id ='';

		/* get wallet balance from employee Tables * /
		// $employee_wallet_balance = $this->transaction->getEmployeeWalletBalance($this->employeeId);
		// $employee_cashbank_balance = $this->transaction->getEmployeeCashBack($this->employeeId);

		// $employeeTotalBalance = (($employee_wallet_balance > 0) ? $employee_wallet_balance : 0) + (($employee_cashbank_balance > 0) ? $employee_cashbank_balance : 0);
		if ($employee_wallet_balance >= $total_amount) {
			
			$cart_items = $this->cart->contents();
			(count($cart_items) <= 0) ? redirect('home') : '';
			
			// Create order
			// $order_id = $this->order->doOrder($this->userId, $this->location_id, $this->USER_DETAILS['email'], $this->USER_DETAILS['phone'], $total_amount, $sub_total_amount);
			//  $this->session->set_userdata('order_id',$order_id);

			// Create transaction
			$addTransaction = $this->transaction->doEmployeeTransaction('', PURCHASED, $this->employeeId, '', $order_id, $total_amount, 'Purchased product');
			if($addTransaction){
			// transaction id 
			$transaction_id = get_session_var('transaction_id');
                
			// update voucher details.
			foreach ($cart_items as $item) {
				$master_prod_idz = $this->order_model->get_voucher_id_master_products($item['id']);
				$vendor_id = $this->vouchers_model->getvendor_details($item['id']);
				$cashback_amount = ($master_prod_idz && !empty($item['cashback_amount'])) ? $item['cashback_amount'] * $item['qty'] : 0;
			}
        
			$this->update_voucher_coupons($item['id'], $order_id, $item['qty'], $item['price'], $master_prod_idz->id, $vendor_id->vendor_id);
        	 /* Oxigien Parameters * /
        	 
        	$param  = array(
        		'transid'=> new_transaction_num(),
        		'otp'	=> $otp,
        		'mobilenumber' => $this->USER_DETAILS['phone']	,
        		'amount' => $total_amount	
        		// 'amount' => ($total_amount * 100)	
        	 );
			$doPayment = $this->oxigenapi->do_payment_from_oxigen_wallet(PAYMENT_URL , $param);
				if($doPayment!='') {
					 $doPayment = json_decode($doPayment); 
					if($doPayment->ResponseCode == 0) {
                                // For HP-DB
                                $updated_wallet_balance = $employee_wallet_balance  - $total_amount;
                                $msg = 'Order placed successfully. Thank you.';
                                $this->session->set_flashdata('msg_succ', $msg);
                                $status = 1;
                                $response = true;
                    }
                    else {
                                // For HP-DB
                              	$updated_wallet_balance = $employee_wallet_balance;
                                if($doPayment->ResponseCode == 1027)  
                                    $this->session->set_flashdata('msg_err', 'Something goes wrong. Please try again after some time.');
                                else 
                                    $this->session->set_flashdata('msg_err', $doPayment->ResponseMessage);
                    }
					$prepareDataUpdate['updated_at'] = date('Y-m-d H:i:s');
					$updated_voucher_order=$this->db->where('order_id',$order_id)->update(ORDER_VOUCHERS_MAP_TABLE,$prepareDataUpdate);
					$prepareDataUpdate['oxigen_response'] = json_encode($doPayment);
					$prepareDataUpdate['order_status_id'] = $status;
					$updated_voucher_order=$this->db->where('order_id',$order_id)->update(ORDER_TABLE,$prepareDataUpdate);

					// prx($updated_voucher_order);
					if($updated_voucher_order) {
                            if($status==1)  
                                $trans_status = 'Completed';
                            else  
                            {
                                $trans_status = 'Cancelled';
                                // Rollback transation if recharge is not done in HP-DB. 
                                $msg = "Order placement is failed. ";
                                $RollbackTransaction=$this->transaction->doEmployeeTransaction('',LOAD_MONEY,$this->employeeId,'',$order_id,$total_amount,$msg,$trans_status);
							
                            }   
                            // Update last transaction.
                            $updated_etrans_tab=$this->db->where('id',$transaction_id)->update(EMPLOYEE_TRANSACTIONS_TABLE,array('status'=>$trans_status,'updated_at'=>date('Y-m-d H:i:s')));
                            // Update wallet balance in HP-DB.    
                            if ($updated_etrans_tab) {
                                $update=$this->db->where('employee_id',$this->employeeId)->update(EMPLOYEE_TABLE,array('wallet_balance'=>$updated_wallet_balance,'updated_at'=>date('Y-m-d H:i:s')));
							
                            }                            
                            else{
                                $this->session->set_flashdata('msg_err', 'Something goes wrong. Please try again after some time.');
                                echo "Error: " .  $this->db->_error_message();
                                exit;
                            } 
                        } 
						$this->session->set_flashdata('msg_success', 'Order placed successfully. Thank you.');
				}

            } 
			} else {
			$remaining_payment_balance = $total_amount - $employee_wallet_balance;
			echo "Amount to be paid: " . $remaining_payment_balance;
			exit;
		}
		$this->cart->destroy();
		redirect('cart/ordersuccess');
	}

	/**
	 * place order for Vouchers
	 * @author kaushik
	 * Date 4-11-2017
	 * No Oxigen
	 * Rename it to placeorder_no_api if want with api and use above one by renaming to placeorder. 	 
	 * /
	public function placeorder() {
		$total_amount = $this->cart->total();
		$sub_total_amount = $total_amount;
		$cashback_amount = 0;
		$msg= '';
        $status = 0;
        $response = false;
		$otp = $this->input->post('otp');
		$trans_status ='';
		$transaction_id ='';

		/* get wallet balance from employee Tables * /
		 $employee_wallet_balance = $this->transaction->getEmployeeWalletBalance($this->employeeId);
		 $employee_cashbank_balance = $this->transaction->getEmployeeCashBack($this->employeeId);
		 $employeeTotalBalance = (($employee_wallet_balance > 0) ? $employee_wallet_balance : 0) + (($employee_cashbank_balance > 0) ? $employee_cashbank_balance : 0);
		if ($employee_wallet_balance >= $total_amount) {
			$cart_items = $this->cart->contents();
			(count($cart_items) <= 0) ? redirect('home') : '';
			
			// Create order
			// $order_id = $this->order->doOrder($this->userId, $this->location_id, $this->USER_DETAILS['email'], $this->USER_DETAILS['phone'], $total_amount, $sub_total_amount);
			//  $this->session->set_userdata('order_id',$order_id);

			// Create transaction
			$addTransaction = $this->transaction->doEmployeeTransaction('', PURCHASED, $this->employeeId, '', $order_id, $total_amount, 'Purchased product');
			if($addTransaction){
			// transaction id 
			$transaction_id = get_session_var('transaction_id');
                
			// update voucher details.
			foreach ($cart_items as $item) {
				$master_prod_idz = $this->order_model->get_voucher_id_master_products($item['id']);
				$vendor_id = $this->vouchers_model->getvendor_details($item['id']);
				$cashback_amount = ($master_prod_idz && !empty($item['cashback_amount'])) ? $item['cashback_amount'] * $item['qty'] : 0;
			}
        
			$this->update_voucher_coupons($item['id'], $order_id, $item['qty'], $item['price'], $master_prod_idz->id, $vendor_id->vendor_id);
        	 /* Oxigien Parameters * /
        	 
        	// $param  = array(
        	// 	'transid'=> new_transaction_num(),
        	// 	'otp'	=> $otp,
        	// 	'mobilenumber' => $this->USER_DETAILS['phone']	,
        	// 	'amount' => $total_amount	
        	// 	// 'amount' => ($total_amount * 100)	
        	//  );
			// $doPayment = $this->oxigenapi->do_payment_from_oxigen_wallet(PAYMENT_URL , $param);
				// if($doPayment!='') {
					 $doPayment = json_decode($doPayment); 
					// if($doPayment->ResponseCode == 0) {
     //                            // For HP-DB
     //                            $updated_wallet_balance = $employee_wallet_balance  - $total_amount;
     //                            $msg = 'Order placed successfully. Thank you.';
     //                            $this->session->set_flashdata('msg_succ', $msg);
     //                            $status = 1;
     //                            $response = true;
     //                }
                    // else {
                    //             // For HP-DB
                    //           	$updated_wallet_balance = $employee_wallet_balance;
                    //             if($doPayment->ResponseCode == 1027)  
                    //                 $this->session->set_flashdata('msg_err', 'Something goes wrong. Please try again after some time.');
                    //             else 
                    //                 $this->session->set_flashdata('msg_err', $doPayment->ResponseMessage);
                    // }
					$prepareDataUpdate['updated_at'] = date('Y-m-d H:i:s');
					$updated_voucher_order=$this->db->where('order_id',$order_id)->update(ORDER_VOUCHERS_MAP_TABLE,$prepareDataUpdate);
					$prepareDataUpdate['oxigen_response'] = json_encode($doPayment);
					$prepareDataUpdate['order_status_id'] = $status;
					$updated_voucher_order=$this->db->where('order_id',$order_id)->update(ORDER_TABLE,$prepareDataUpdate);

					// prx($updated_voucher_order);
					if($updated_voucher_order) {
                            if($status==1)  
                                $trans_status = 'Completed';
                            else  
                            {
                                $trans_status = 'Cancelled';
                                // Rollback transation if recharge is not done in HP-DB. 
                                $msg = "Order placement is failed. ";
                                $RollbackTransaction=$this->transaction->doEmployeeTransaction('',LOAD_MONEY,$this->employeeId,'',$order_id,$total_amount,$msg,$trans_status);
							
                            }   
                            // Update last transaction.
                            $updated_etrans_tab=$this->db->where('id',$transaction_id)->update(EMPLOYEE_TRANSACTIONS_TABLE,array('status'=>$trans_status,'updated_at'=>date('Y-m-d H:i:s')));
                            // Update wallet balance in HP-DB.    
                            if ($updated_etrans_tab) {
                                $update=$this->db->where('employee_id',$this->employeeId)->update(EMPLOYEE_TABLE,array('wallet_balance'=>$updated_wallet_balance,'updated_at'=>date('Y-m-d H:i:s')));
							
                            }                            
                            else{
                                $this->session->set_flashdata('msg_err', 'Something goes wrong. Please try again after some time.');
                                echo "Error: " .  $this->db->_error_message();
                                exit;
                            } 
                        } 
						$this->session->set_flashdata('msg_success', 'Order placed successfully. Thank you.');
				// }

            } 
			} else {
			$remaining_payment_balance = $total_amount - $employee_wallet_balance;
			echo "Amount to be paid: " . $remaining_payment_balance;
			exit;
		}
		// $this->cart->destroy();
		// redirect('cart/ordersuccess');
	}
	/**
	 * { update_voucher_coupons }
	 * @author     Kaushik
	 * @param      <int>  $voucher_id         The voucher identifier
	 * @param      <int>  $order_id           The order identifier
	 * @param      <int>  $voucher_coupon_id  The voucher coupon identifier
	 * date : 11-1-2018
	 */
	public function update_voucher_coupons($voucher_id, $order_id, $quantity, $price, $master_id, $vendor_id) {
		$total_avlible_coupon = $this->vouchers_model->get_avalible_coupon_count($voucher_id);
		if ($total_avlible_coupon > 0) {
			$purchased_coupon = $this->vouchers_model->get_avalible_coupon($voucher_id);
			$is = $this->vouchers_model->update_purchased_coupons($purchased_coupon);
			if ($is != '') {
				$add = array('order_id' => $order_id, 'voucher_coupon_id' => $purchased_coupon);
				$iss = $this->vouchers_model->add_ordered_voucher_map_table($add);
				if ($iss) {
					$purchased_prod = array(
						'order_id' => $order_id,
						'price' => $price,
						'master_product_id' => $master_id,
						'quantity' => $quantity,
						'vendor_id' => $vendor_id,
						'created_at' => date('Y-m-d H:i:s'),
					);
					$isPurchased = $this->vouchers_model->add_ordered_product_map_table($purchased_prod);
					return ($isPurchased) ? true : false;
				} else {
					return false;
				}
			}
		}
		return false;
	}

	/**
	 * @author Naresh
	 * Date 4-11-2017
	 */
	public function placerechargeorder() {
		$total_amount = $this->cart->total();
		$sub_total_amount = $total_amount;

		$recharge_data = get_session_var('rechargevalue');
		$servicenumber = $recharge_data['mobilerechargeno'];
		$operator = $recharge_data['operator'];
		$region = $recharge_data['region'];
		$rechargeOfType = $recharge_data['rechargeOfType'];
		$sim_type = $recharge_data['sim_type'];
		$offer_type = $recharge_data['offer_type'];
		$broadband_package = $recharge_data['broadband_package'];
		$broadband_userid = $recharge_data['broadband_userid'];
		$subscribe_id = $recharge_data['subscribe_id'];
		$account_no = $recharge_data['account_no'];
		$otp = $this->input->post('otp');

		/* get wallet balance from employee Tables */
		$employee_wallet_balance = $this->transaction->getEmployeeWalletBalance($this->employeeId);

		if ($employee_wallet_balance >= $total_amount) {
			$recharge_cart_items = $this->cart->contents();
			$post_d = $this->input->post();
			$emp_details = get_session_var('employeed_logged_in');
			$order_for = 1; // 1 for recharge transactions

			// insert order & return last inserted order_id
			$order_id = $this->order->doOrder($this->userId, $this->location_id, $emp_details['email'], $emp_details['phone'], $total_amount, $sub_total_amount, $order_for);
			if($order_id){
				 $this->session->set_userdata('order_id',$order_id);
			
			$recharge_api = $this->recharge->doRechargeTx('', $this->employeeId, $order_id, $emp_details['phone'],$otp,$total_amount, $servicenumber, $operator, $region, $rechargeOfType, $sim_type, $offer_type, $broadband_package, $broadband_userid, $subscribe_id, $account_no);
			// 
			// echo $recharge_api;
			// exit();
			// prx($recharge_api);

			if($recharge_api == false) {
				redirect('home#recharge');
			} else
				redirect('cart/ordersuccess');
			}
		}
		 else {
			$remaining_payment_balance = $total_amount - $employee_wallet_balance;
			/* send user to oxiygen payment if user has no Sufficient balance & payment form */
			echo "Amount to be paid: " . $remaining_payment_balance;
		}
		//exit;
	}

	public function order_success() {
		$data['order_id'] = get_session_var('order_id');
		$this->cart->destroy();
		$this->ordersuccess_send_mail();
		$this->template->write('title', 'HappyPerks');
		$this->template->write_view('content', 'orders/success', isset($data) ? $data : NULL);
		$this->template->render();
	}




	function ordersuccess_send_mail() {
		$email  = $this->USER_DETAILS['email'];
		$template = (get_session_var('is_recharge')!='' && $this->session->set_userdata('is_recharge') == true) ?  5 : 6 ;
		$order_id = get_session_var('order_id');
		return $this->email_model->sendMail($email, 'naresh',$template, NULL,get_session_var('order_id'));
	}


	/****  Hotel code ****/
	// public function place_hotel_order() {

	// 	$total_amount = $this->cart->total();
	// 	$sub_total_amount = $total_amount;

	// 	/* get wallet balance from employee Tables */
	// 	$employee_wallet_row = $this->employee_model->getRow('wallet_balance', array('employee_id' => $this->employeeId));
	// 	$employee_wallet_balance = $employee_wallet_row->wallet_balance;

	// 	if ($employee_wallet_balance >= $total_amount) {

	// 		$hotel_cart_items = $this->cart->contents();

	// 		$post_d = $this->input->post();
	// 		$emp_details = get_session_var('employeed_logged_in');

	// 		$order_for = 2; // 1 for hotel transactions
	// 		// insert order & return last inserted order_id
	// 		$last_insert_id = $this->order->doOrder($this->userId, $this->location_id, $emp_details['email'], $emp_details['phone'], $total_amount, $sub_total_amount, $order_for);

	// 		$cashback_amount = 0;
	// 		foreach ($hotel_cart_items as $item) {
	// 			$master_prod_idz = $this->order_model->get_hotel_id_master_products($item['id']);
	// 			$master_prod_id = $master_prod_idz->id;

	// 			$order_products_map = array();
	// 			$order_products_map['order_id'] = $last_insert_id;
	// 			$order_products_map['master_product_id'] = $master_prod_id;
	// 			$order_products_map['quantity'] = $item['qty'];
	// 			$order_products_map['price'] = $item['price'];

	// 			$cashback_amount = !empty($item['cashback_amount']) ? $item['cashback_amount'] * $item['qty'] : 0;
	// 			$this->order_model->insert_oder_prod_map($order_products_map);
	// 		}

	// 		/* update Employee Transaction */
	// 		if ($this->transaction->doEmployeeTransaction('', PURCHASED, $this->employeeId, '', $order_code, $total_amount, 'Purchased hotel package')) {
	// 			$this->cashback->doEmployeeCashbackTx('', PURCHASED, $this->employeeId, $order_code, $cashback_amount, 'cashback', date('y-m-d h:i:s'));
	// 			//echo "order success";
	// 			redirect('buy/order_hotel_success');
	// 		}
	// 	} else {

	// 		$remaining_payment_balance = $total_amount - $employee_wallet_balance;

	// 		/* send user to oxiygen payment if user has no Sufficient balance & payment form */
	// 		echo "Amount to be paid: " . $remaining_payment_balance;
	// 	}
	// 	//exit;
	// }

	// public function order_hotel_success() {
	// 	/* get_voucher_id & quantity from payment */
	// 	$hotel_package_id = 25;
	// 	$quantity = 1;
	// 	$order_id = 1;

	// 	// reduce the quantity of hotel packages
	// 	$this->order_model->reduce_hotel_package_qty($hotel_package_id, $quantity);

	// 	$order_voucher_hotel_package_map = array();
	// 	$order_voucher_hotel_package_map['hotel_package_id'] = $hotel_package_id;
	// 	$order_voucher_hotel_package_map['order_id'] = $order_id;
	// 	$this->order_model->insert_order_hotel_package($order_voucher_hotel_package_map);

	// 	// sending a mail
	// 	$this->email_model->sendMail('naresh.s@happyperks.com', 'naresh', 3, NULL);

	// 	$data['order_id'] = $order_id;
	// 	$data['email'] = $this->USER_DETAILS['email'];

	// 	$this->template->write('title', 'HappyPerks');
	// 	$this->template->write_view('content', 'frontend/order_success', isset($data) ? $data : NULL);
	// 	$this->template->render();
	// }

}

// Update transaction
			
			//Add Cashback.
			// if ($cashback_amount > 0 && $status==1) {
			// 	sleep(2);
			// 	$generated_transaction_code = (!empty($transaction_id)) ? 'HPCB' . str_pad($transaction_id, 7, '0', STR_PAD_LEFT) : '';
			// 	$employee_transaction_data['transaction_code'] = $generated_transaction_code;
			// 	$employee_transaction_data['received_amount'] = $cashback_amount;
			// 	$employee_transaction_data['credit_amount'] = $cashback_amount;
			// 	$employee_transaction_data['description'] = 'Cashback  has been added';
			// 	$added = $this->transaction->doUpdateEmployeeBalance($this->employeeId, 0, $cashback_amount, $employee_transaction_data, ADD_CASHBACK,'Completed.');
			// 	($added) ? redirect('user/profile#wallet') : '';
			// }
