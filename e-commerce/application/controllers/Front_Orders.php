<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Orders extends Front_Controller {

	private $total = 0 ;
	private $sub_total = 0;
	private $cashback= 0 ;
	private $response = false;
	private $wallet_balance;
	private $cashback_balance;
	private $_table = ORDER_TABLE;	

	function __construct() {
		parent::__construct();
		if (!$this->aauth->is_loggedin()){ redirect(); }
		$this->template->set_template('common');
		$this->template->write('meta_keywords', '');
		$this->template->write('meta_desc', '');
		$this->load->model(array('order_model','user_model','vouchers_model','employee_model','home_model', 'brands_model', 'category_model'));
		$this->load->library('pdf');
		$this->load->library('cart');
		$this->wallet_balance = $this->transaction->getEmployeeWalletBalance($this->employeeId);
		$this->cashback_balance = $this->transaction->getEmployeeCashBack($this->employeeId);
	}
	/* function index() {
	 * 
	 * }
	 */
	function placeorder_no_api() {

		/* Intitalization */
		$this->total = $this->cart->total();
		$this->sub_total = $this->total;
		$msg = '';
        $status = 0;
		$trans_status ='';
		$transaction_id ='';
		
			/* Otp for Oxigen Payment API */
			if($this->input->post()!='') {
				$postdata = escape_post_strings($this->input->post());
				$otp  = $postdata['otp'];
			} 
		/* Check wallet Balance */ 
		if($this->wallet_balance >= $this->total) {
			$cart_items = $this->cart->contents();
			(count($cart_items) <= 0) ? redirect('home') : '';
			$order_for = 0;
				/* collect data and create array to insert*/
				$add_order = array (
					'user_id' =>$this->userId,
					'location_id' =>$this->location_id,
					'email' => $this->USER_DETAILS['email'],
					'telephone' => $this->USER_DETAILS['phone'],
					'total' => $this->total,
					'order_for' => $order_for,
					'created_at' => date('Y-m-d H:i:s'),
					'order_status_id' => 1,
				);
			/* Insert into DB*/
			 $result = $this->db->insert($this->_table, $add_order);
			 if ($result) { 
			 	$order_id = $this->db->insert_id();
			
				$addTransaction = $this->transaction->doEmployeeTransaction('', PURCHASED, $this->employeeId,'', $order_id,$this->total, 'Purchased product.');
				if($addTransaction){
				/* transaction id */
				$transaction_id = get_session_var('transaction_id');
	                
				/* update voucher details.*/
					foreach ($cart_items as $item) :
						$master_prod_idz = $this->order_model->get_voucher_id_master_products($item['id']);
						$vendor_id = $this->vouchers_model->getvendor_details($item['id']);
						$cashback_amount = ($master_prod_idz && !empty($item['cashback_amount'])) ? $item['cashback_amount'] * $item['qty'] : 0;
						$this->update_voucher_coupons($item['id'], $order_id, $item['qty'], $item['price'], $master_prod_idz->id, $vendor_id->vendor_id);
					endforeach;
						
						/* Send to Oxigen. */
						$param  = array(
			        		'transid'=> new_transaction_num(),
			        		'otp'	=> $otp,
			        		'mobilenumber' => $this->USER_DETAILS['phone']	,
			        		'amount' => $this->total	/* 'amount' => ($this->total * 100) /* To Do*/
		        	 	);
	        	 	
	        	 	/* Oxigen API.*/
	        	 	$doPayment = $this->oxigenapi->do_payment_from_oxigen_wallet(PAYMENT_URL , $param);
	        	 	if($doPayment!='') {
						 $doPayment = json_decode($doPayment); 
					   if($doPayment->ResponseCode == 0) { /* For HP-DB*/
		                        $this->wallet_balance = $this->wallet_balance - $this->total;
		                        $msg = 'Order placed successfully. Thank you.';
		                        $this->session->set_flashdata('msg_succ', $msg);
		                        $status = 1;
		                        $response = true;
	                		}
		                    else { /* For HP-DB*/
			                  	$this->wallet_balance = $this->wallet_balance;
			                    if($doPayment->ResponseCode == 1027)  
			                    	$this->session->set_flashdata('msg_err','Something goes wrong. Please try again after some time.');
		                    	else 
	                    			$this->session->set_flashdata('msg_err', $doPayment->ResponseMessage);
		                    }
						/*  Update Voucher Orders.*/
							$updated_voucher_order=$this->db->where('order_id',$order_id)->update(ORDER_VOUCHERS_MAP_TABLE,array('updated_at',date('Y-m-d H:i:s')));
							$update_order = array(
								 'oxigen_response' =>  json_encode($doPayment),
								 'order_status_id' => $status ,
								 'order_code' => 'HP'.str_pad($last_insert_id, 6, 0, STR_PAD_LEFT),
								 'invoice_no' => 'HPO'.str_pad($last_insert_id, 6, 0, STR_PAD_LEFT)
								);
							$updated_order=$this->db->where('order_id',$order_id)->update(ORDER_TABLE,$update_order);
							if($updated_order) {
		                            if($status == 1)  
		                                $trans_status = 'Completed';
		                            else  
		                            {
		                                $trans_status = 'Cancelled';
		                                /* Rollback transation if recharge is not done in HP-DB. */
		                                $msg = "Order Placement is failed. ";
		                                $RollbackTransaction=$this->transaction->doEmployeeTransaction('',LOAD_MONEY,$this->employeeId,'',$order_id,$this->total,$msg,$trans_status);
									
		                            }   
		                            /* Update last transaction.*/
		                            $updated_etrans_tab=$this->db->where('id',$transaction_id)->update(EMPLOYEE_TRANSACTIONS_TABLE,array('status'=>$trans_status,'updated_at'=>date('Y-m-d H:i:s')));
		                            /* Update wallet balance in HP-DB.    */
		                            if ($updated_etrans_tab) {
		                                $update=$this->db->where('employee_id',$this->employeeId)->update(EMPLOYEE_TABLE,array('wallet_balance'=>$this->wallet_balance,'updated_at'=>date('Y-m-d H:i:s')));
									
		                            }                            
		                            else{
		                                $this->session->set_flashdata('msg_err', 'Something goes wrong. Please try again after some time.');
		                                /* echo "Error: " .  $this->db->_error_message();*/
		                            } 
		                        }
	                        $this->session->set_flashdata('msg_success', 'Order placed successfully. Thank you.');
						} /* Oxigen Condition */

					} /* if - transaction add*/
		 			else {
						$remaining_payment_balance = $this->total - $this->wallet_balance;
						echo "Amount to be paid: " . $remaining_payment_balance;
						exit;
					}
				} else return false; /* Order Created.*/
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
	 */
	public function placeorder() {
		$this->total = $this->cart->total();
		$this->sub_total = $this->total;
		$msg = '';
        $status = 0;
		$trans_status ='';
		$transaction_id ='';
		
			/* Otp for Oxigen Payment API */
			if($this->input->post()!='') {
				$postdata = escape_post_strings($this->input->post());
				$otp  = $postdata['otp'];
			} 
		/* Check wallet Balance */ 
		// prx($this->wallet_balance >= $this->total);
		if($this->wallet_balance >= $this->total) {
			$cart_items = $this->cart->contents();
			(count($cart_items) <= 0) ? redirect('home') : '';
			$order_for = 0;
				/* collect data and create array to insert*/
				$add_order = array (
					'user_id' =>$this->userId,
					'location_id' =>$this->location_id,
					'email' => $this->USER_DETAILS['email'],
					'telephone' => $this->USER_DETAILS['phone'],
					'total' => $this->total,
					'order_for' => $order_for,
					'created_at' => date('Y-m-d H:i:s'),
					'order_status_id' => 1,
				);
			/* Insert into DB*/
			 $result = $this->db->insert($this->_table, $add_order);
			 if ($result) { 
			 	$order_id = $this->db->insert_id();
			
				$addTransaction = $this->transaction->doEmployeeTransaction('', PURCHASED, $this->employeeId,'', $order_id,$this->total, 'Purchased product.');
				if($addTransaction){
				/* transaction id */
				$transaction_id = get_session_var('transaction_id');
	                
				/* update voucher details.*/
					foreach ($cart_items as $item) :
						$master_prod_idz = $this->order_model->get_voucher_id_master_products($item['id']);
						$vendor_id = $this->vouchers_model->getvendor_details($item['id']);
						$cashback_amount = ($master_prod_idz && !empty($item['cashback_amount'])) ? $item['cashback_amount'] * $item['qty'] : 0;
					endforeach;
						$this->update_voucher_coupons($item['id'], $order_id, $item['qty'], $item['price'], $master_prod_idz->id, $vendor_id->vendor_id);

					$updated_voucher_order=$this->db->where('order_id',$order_id)->update(ORDER_VOUCHERS_MAP_TABLE,array('updated_at'=>date('Y-m-d H:i:s')));
						$status = 1;
							$update_order = array(
								 // 'oxigen_response' =>  json_encode($doPayment),
								 'order_status_id' => $status,
								 'order_code' => 'HP'.str_pad($order_id, 6, 0, STR_PAD_LEFT),
								 'invoice_no' => 'HPO'.str_pad($order_id, 6, 0, STR_PAD_LEFT)
								);
						$updated_order=$this->db->where('order_id',$order_id)->update(ORDER_TABLE,$update_order);
							if($updated_order) {
		                            if($status == 1)   {
		                                $trans_status = 'Completed';
		                            	$this->wallet_balance = $this->wallet_balance - $this->total;
		                            }
		                            else  
		                            {
		                                $trans_status = 'Cancelled';
		                                /* Rollback transation if recharge is not done in HP-DB. */
		                                $msg = "Order Placement is failed. ";
		                                $RollbackTransaction=$this->transaction->doEmployeeTransaction('',LOAD_MONEY,$this->employeeId,'',$order_id,$this->total,$msg,$trans_status);
									
		                            }   
		                            /* Update last transaction.*/
		                            $updated_etrans_tab=$this->db->where('id',$transaction_id)->update(EMPLOYEE_TRANSACTIONS_TABLE,array('status'=>$trans_status,'updated_at'=>date('Y-m-d H:i:s')));
		                            /* Update wallet balance in HP-DB.    */
		                            if ($updated_etrans_tab) {
		                                $update=$this->db->where('employee_id',$this->employeeId)->update(EMPLOYEE_TABLE,array('wallet_balance'=>$this->wallet_balance,'updated_at'=>date('Y-m-d H:i:s')));
									
		                            }                            
		                            else{
		                                $this->session->set_flashdata('msg_err', 'Something goes wrong. Please try again after some time.');
		                                /* echo "Error: " .  $this->db->_error_message();*/
		                            } 
		                        }
	                        $this->session->set_flashdata('msg_success', 'Order placed successfully. Thank you.');
						} /* Oxigen Condition */

					} /* if - transaction add*/
		 			else {
						$remaining_payment_balance = $this->total - $this->wallet_balance;
						echo "Amount to be paid: " . $remaining_payment_balance;
						exit;
					}
				} else redirect('cart');
				// return fal	se; /* Order Created.*/
		// }	
		$this->cart->destroy();
		redirect('cart/ordersuccess');
	 } 

	 public function order_success() {
		$data['order_id'] = get_session_var('order_id');
		$this->cart->destroy();
		$this->ordersuccess_send_mail();
		$this->template->write('title', 'Ordre Placed Successfully |'. SITE_NAME );
		$this->template->write_view('content', 'orders/success', isset($data) ? $data : NULL);
		$this->template->render();
	}
	function ordersuccess_send_mail() {
		$email  = $this->USER_DETAILS['email'];
		$template = (get_session_var('is_recharge')!='' && $this->session->set_userdata('is_recharge') == true) ?  5 : 6 ;
		$order_id = get_session_var('order_id');
		return $this->email_model->sendMail($email, 'naresh',$template, NULL,get_session_var('order_id'));
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
// PDF 
    public function generated_invoice($order_id) {
        if (!empty($order_id)) {
            $paper = 'A4'; $orientation = "portrait";
            $data['coupon_code'] = $this->order_model->get_voucher_coupon_code($order_id);
            $voucher_id = $this->order_model->get_ordered_voucher_id($order_id);
            $data['voucher_details'] = $this->vouchers_model->get_voucher($voucher_id);
            $data['order_details'] = $this->order_model->get_product_order_details($order_id);
            $html = $this->load->view('orders/order_pdf', $data,true);
            // $this->pdf->setPaper($paper, $orientation);
            // print_r($html);
            $this->pdf->load_view('orders/order_pdf',$html);
            $this->pdf->render();
            $this->pdf->stream("Invoice : order id - " . $order_id . " - " . time() . ".pdf");
        } else {
        	echo "Sorry";
        }
    }
} /* end*/
 	






		 /* 	$update_order = array(*/
		 /* 		'order_code'=>'HP'.str_pad($order_id, 6, 0, STR_PAD_LEFT),*/
		 /* 		'invoice_no' => 'HPO'.str_pad($order_id, 6, 0, STR_PAD_LEFT);*/
		 /* 	);*/
			/* $updated = $this->db->where('order_id', $order_id)->update($this->_table, $prepareDataUpdate);*/
			/* if ($updated) { */
			/* 	/* return $order_id; */
			/* }*/