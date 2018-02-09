<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction {

	protected $_table = 'hp_corporate_transactions';

	public function __construct() {
		$this->ci = &get_instance();
	}

	/*  @author: Kaushik
		     *   @parameter: corporateId      - CorporateId - @Int
		     *               transaction_type - Transaction type - @enum - 1 Loaded Money, 2 Transferred
		     *               employeeId       - Employee ID -  @Int - Like CREATE, DELETE, UPDATE
		      amount           - Amount - @decimal, annnoucement id, award id.
		      @date: 14-11-2017
	*/

// 'HP' . str_pad(1500, 6, '0', STR_PAD_LEFT);
	public function doTransaction($transaction_code = '', $corporateId = '', $transaction_type = '', $employeeId = '', $amount = '', $description = '') {
		$prepareDataInsert = array();
		$prepareDataUpdate = array();
		$updated_wallet_balance = '';
		$operation = '';
		$cashback_amount = 0;
// Creating Transaction

		$prepareDataInsert['corporate_id'] = $corporateId;
		$prepareDataInsert['credit_amount'] = $amount;
		$prepareDataInsert['description'] = $description;
		$wallet_balance = $this->getCorporateBalance($corporateId);
		$employee_wallet_balance = $this->getEmployeeWalletBalance($employeeId);
		$prepareDataInsert['begin_balance'] = $wallet_balance; // != '0.00' && $wallet_balance != NULL) ? $wallet_balance :0;
		if (isset($transaction_code) && empty($transaction_code)) {
			$prepareDataInsert['transaction_type'] = $transaction_type;
			$prepareDataInsert['created_at'] = date('Y-m-d H:i:s');
			$prepareDataInsert['status'] = PROCESSING_TRANSACTION;
			if ($transaction_type == SEND_MONEY) {
				$prepareDataInsert['spent_amount'] = $amount;
				$prepareDataInsert['employee_id'] = $employeeId;
				$prepareDataInsert['end_balance'] = $updated_wallet_balance = $wallet_balance - $amount;
// $employee_wallet_balance = $employee_wallet_balance + $amount;
				$operation = SEND_MONEY_OPERATION;
			} else {
				$prepareDataInsert['received_amount'] = $amount;
				$prepareDataInsert['end_balance'] = $updated_wallet_balance = $wallet_balance + $amount;
				$operation = LOAD_MONEY_OPERATION;
			}

// Insert into database
			$result = $this->ci->db->insert($this->_table, $prepareDataInsert);
			$transaction_id = $this->ci->db->insert_id();

// Updating record
			if ($result) {
				if ($operation == SEND_MONEY_OPERATION) {
					$generated_transaction_code = $prepareDataUpdate['transaction_code'] = 'HPSM' . str_pad($transaction_id, 8, '0', STR_PAD_LEFT);
				} else {
					$generated_transaction_code = $prepareDataUpdate['transaction_code'] = 'HPCLM' . str_pad($transaction_id, 8, '0', STR_PAD_LEFT);
				}
				$prepareDataUpdate['status'] = COMPLETED_TRANSACTION;
				$updated = $this->ci->db->where('id', $transaction_id)->update($this->_table, $prepareDataUpdate);
				if ($updated) {
					$update = $this->UpdateCororateBalance($corporateId, $updated_wallet_balance);

					if ($update && ($operation === SEND_MONEY_OPERATION)) {
						$employee_transaction_data = array();
						$cashback_amount = $this->CheckCashBackRules($corporateId, $amount);
						$employee_transaction_data['transaction_code'] = $generated_transaction_code;
						$employee_transaction_data['credit_amount'] = $amount + $cashback_amount;
						$employee_transaction_data['description'] = 'Admin has sent.';
//                        print_r($employee_transaction_data);
						$updates = $this->doUpdateEmployeeBalance($employeeId, $amount, $cashback_amount, $employee_transaction_data, RECEIVED);
						if ($updates) {
							$this->ci->load->library('activity_log');
							$logged_user = $this->ci->session->userdata('corporate_logged_in');
							$this->ci->activity_log->addActivity($logged_user['user_id'], $corporateId, MONEY_TRANSACTION, $operation, $transaction_id);
							return true;
						}
					}
				}
				return true;
			} else {
				return false;
			}

		}
	}

// Function ends.
	// end function

	function doUpdateEmployeeBalance($employeeId = '', $amount = '', $cashback = '', $employee_transaction_data = array(), $transaction_type = '',$status = NULL) {
		$this->_table = EMPLOYEE_TRANSACTIONS_TABLE;
		$wallet_balance = '';
		if (!empty($employeeId) && (!empty($amount) || $amount == 0)) {
			$wallet_balance = $this->getEmployeeWalletBalance($employeeId);
			$cashback_balance = $this->getEmployeeCashBack($employeeId);
			$employee_transaction_data['begin_balance'] = $wallet_balance + $cashback_balance;
			$employee_transaction_data['employee_id'] = $employeeId;
			$employee_transaction_data['created_at'] = date('Y-m-d H:i:s');
			if($status == NULL)
				$employee_transaction_data['status'] = 'Pending';
			else 
				$employee_transaction_data['status'] = $status;
			if ($transaction_type == PURCHASED) {
				if ($cashback_balance <= $amount) {
					$order_amount = $amount - $cashback_balance;
					$wallet_balance = $wallet_balance - $order_amount;
					$cashback_balance = 0;
				}
				if ($cashback_balance > $amount) {
					$cashback_balance = $cashback_balance - $amount;
				}

				$employee_transaction_data['credit_amount'] = round($amount);
				$employee_transaction_data['end_balance'] = $employee_transaction_data['begin_balance'] - $amount;
			} elseif ($transaction_type == RECEIVED) {
				$wallet_balance = $wallet_balance + round($amount);
				$employee_transaction_data['received_amount'] = round($amount + $cashback);
				$employee_transaction_data['end_balance'] = $employee_transaction_data['begin_balance'] + $amount;
			} elseif ($transaction_type == SEND_MONEY) {
				$wallet_balance = $wallet_balance - round($amount);
				$employee_transaction_data['spent_amount'] = round($amount - $cashback);
				$employee_transaction_data['end_balance'] = $employee_transaction_data['begin_balance'] - $amount;
			} else {
				$wallet_balance = $wallet_balance + round($amount);
				$cashback_balance = $cashback_balance + round($cashback);
				$employee_transaction_data['end_balance'] = $employee_transaction_data['begin_balance'] + $amount + $cashback;
			}
//            prx($employee_transaction_data);
			$insert = $this->ci->db->insert(EMPLOYEE_TRANSACTIONS_TABLE, $employee_transaction_data);
			if ($insert) {
				$transaction_id = $this->ci->db->insert_id();
				$this->ci->session->set_userdata('transaction_id',$transaction_id);
				$prepareDataUpdate['transaction_code'] = 'HPE' . str_pad($transaction_id, 8, '0', STR_PAD_LEFT);
				$updated = $this->ci->db->where('id', $transaction_id)->update($this->_table, $prepareDataUpdate);
				$update = $this->ci->db->where('employee_id', $employeeId)->update(EMPLOYEE_TABLE, array('wallet_balance' => round($wallet_balance), 'cashback_balance' => round($cashback_balance)));
				if ($update) {
					return true;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function CheckCashBackRules($CorporateId = '', $amount = '') {
		$getRule = '';
		$cashback = 0;

		$getRule = $this->ci->db->where('corporate_id', $CorporateId)->order_by('amount_above', 'desc')->limit(1)->get(CORPORATE_CASHBACK_RULE_TABLE)->row_array();
		if (!empty($getRule)) {
			extract($getRule);
			if (isset($amount_above) && ($amount_above != 0 || $amount_above > 0)) {
				if ($amount >= $amount_above) {
					if ($cashback_mode == FIXED_MODE) {
						$cashback = $cashback + $cashback_amount;
					} else {
						$cashback = $cashback + (($amount * $cashback_amount) / 100);
					}
				}
			}
		}
		return $cashback;
	}

	function UpdateCororateBalance($corporateId = '', $wallet_balance = '') {
		$updateBalance = $this->ci->db->where('corporate_id', $corporateId)->update(CORPORATE_TABLE, array('wallet_balance' => $wallet_balance));
		if ($updateBalance) {
//echo  $this->ci->db->last_query();
			return true;
		} else {
			return false;
		}
	}

	function getCorporateBalance($corporate_id = '') {
		$begin_balance = $this->ci->db->select('wallet_balance')->where('corporate_id', $corporate_id)->get(CORPORATE_TABLE)->row_array();
		$wallet_balance = $begin_balance['wallet_balance'];
		return $wallet_balance;
	}

	function getEmployeeWalletBalance($employee_id = '') {
		$begin_balance = $this->ci->db->select('wallet_balance')->where('employee_id', $employee_id)->get(EMPLOYEE_TABLE)->row_array();
		$wallet_balance = $begin_balance['wallet_balance'];
		//$params = array('mobilenumber' => "91" . $this->USER_DETAILS['phone']);
		//        $wallet_balance = $this->ci->oxigenapi->get_my_balance(WALLET_BALANCE_URL, $params);
		return (int) $wallet_balance;
	}

	function getEmployeeCashBack($employee_id = '') {
		$begin_balance = $this->ci->db->select('cashback_balance')->where('employee_id', $employee_id)->get(EMPLOYEE_TABLE)->row_array();
		$cashback_balance = $begin_balance['cashback_balance'];
		if ($cashback_balance <= 0) {
			$cashback_balance = 0.00;
		}

		return $cashback_balance;
	}

	function SendToMultiple() {

	}

	function doEmployeeTransaction($transaction_code = NULL, $transaction_type = NULL, $employeeId = NULL, $to_employee = NULL, $order_id = NULL, $amount = NULL, $description = NULL,$status = NULL) {

		// Intialization
		$this->_table = EMPLOYEE_TRANSACTIONS_TABLE;
		$employee_transaction_data = array();
		$updated_wallet_balance = 0;
		$amount = round($amount);

		// Wallet balances
		$employee_wallet_balance = $this->getEmployeeWalletBalance($employeeId);
		$employee_cashbank_balance = $this->getEmployeeCashBack($employeeId);
		$employeeTotalBalance = (($employee_wallet_balance > 0) ? $employee_wallet_balance : 0) + (($employee_cashbank_balance > 0) ? $employee_cashbank_balance : 0);

		// Transaction code
		$generated_transaction_code = (!empty($order_id)) ? 'HPEOT' . str_pad($order_id, 8, '0', STR_PAD_LEFT) : '';

		$employee_transaction_data['transaction_code'] = $generated_transaction_code;
		if ($transaction_type == SEND_MONEY) {
			$employee_transaction_data['spent_amount'] = $amount;
			$employee_transaction_data['credit_amount'] = $amount;
			$employee_transaction_data['to_employee'] = $to_employee;
			$this->doEmployeeTransaction('', LOAD_MONEY, $to_employee, '', '', $amount, 'Received amount');
		} else if ($transaction_type == PURCHASED) {
			$employee_transaction_data['order_code'] = $order_id;
			$employee_transaction_data['credit_amount'] = $amount;
			$employee_transaction_data['spent_amount'] = $amount;
		} else {
			$employee_transaction_data['received_amount'] = $amount;
			$employee_transaction_data['credit_amount'] = round($amount);
		}
		$employee_transaction_data['description'] = $description;
		$update = $this->doUpdateEmployeeBalance($employeeId, $amount, 0, $employee_transaction_data, $transaction_type , $status);
		if ($update) {
			return true;
		}
	}

}

/*  @author: Kaushik
 *  @modified Date: 15-11-2017
 * 	@modified By: Naresh
 *  @parameter: EmployeeId      - EmployeeId - @Int
 *  			transaction_type - Transaction type - @enum - 1 Loaded Money, 2 Transferred, 3 purchased
 *  			to employeeId       - Employee ID -  @Int - Like CREATE, DELETE, UPDATE
 * 	amount - Amount - @decimal, annnoucement id, award id.
 * 	@date: 14-11-2017
 */

//    function doEmployeeTransaction($transaction_code = NULL, $transaction_type = NULL, $employeeId = NULL, $to_employee = NULL, $order_code = NULL, $amount = NULL, $description = NULL) {
//
//        $this->_table = EMPLOYEE_TRANSACTIONS_TABLE;
//
//        $prepareDataInsert = array();
//        $prepareDataUpdate = array();
//        $updated_wallet_balance = 0;
//        // Creating Transaction
//        $prepareDataInsert['employee_id'] = $employeeId;
//        $prepareDataInsert['credit_amount'] = $amount;
//        $prepareDataInsert['description'] = $description;
//
//        $employee_wallet_row = $this->ci->employee_model->getRow('wallet_balance,cashback_balance', array('employee_id' => $employeeId));
//        $employee_wallet_balance = $employee_wallet_row->wallet_balance;
//        $employee_cashbank_balance = $employee_wallet_row->cashback_balance;
//        $employeeTotalBalance = (($employee_wallet_balance > 0) ? $employee_wallet_balance : 0 ) + (($employee_cashbank_balance > 0) ? $employee_cashbank_balance : 0 );
//
//        if (isset($transaction_code) && empty($transaction_code)) {
//            $prepareDataInsert['begin_balance'] = $employee_wallet_balance;
//            $prepareDataInsert['transaction_type'] = $transaction_type;
//            $prepareDataInsert['created_at'] = date('Y-m-d H:i:s');
//            $prepareDataInsert['status'] = "Processing";
//            if ($transaction_type == SEND_MONEY) {
//                $prepareDataInsert['spent_amount'] = $amount;
//                $prepareDataInsert['employee_id'] = $employeeId;
//                $prepareDataInsert['end_balance'] = $updated_wallet_balance = $employee_wallet_balance - $amount;
//                $prepareDataInsert['to_employee'] = $to_employee;
//
//                /* Employee to Employee Transaction */
//                $this->doEmployeeTransaction('', LOAD_MONEY, $to_employee, '', '', $amount, 'Received Employee');
//            } else if ($transaction_type == PURCHASED) {
//                $prepareDataInsert['spent_amount'] = $amount;
//                $prepareDataInsert['employee_id'] = $employeeId;
//                $prepareDataInsert['order_code'] = $order_code;
//                $prepareDataInsert['end_balance'] = $employeeTotalBalance = $employee_wallet_balance - ($employee_cashbank_balance - $amount);
//            } else {
//                $prepareDataInsert['received_amount'] = $amount;
//                $prepareDataInsert['end_balance'] = $updated_wallet_balance = $employee_wallet_balance + $amount;
//            }
//            // Insert into database
//            $result = $this->ci->db->insert($this->_table, $prepareDataInsert);
//            $transaction_id = $this->ci->db->insert_id();
//
//            // Updating record
//            if ($result) {
//                $prepareDataUpdate['transaction_code'] = 'HPE' . str_pad($transaction_id, 8, '0', STR_PAD_LEFT);
//                $prepareDataUpdate['status'] = "Completed";
//                $updated = $this->ci->db->where('id', $transaction_id)->update($this->_table, $prepareDataUpdate);
//                if ($updated) {
//                    $update = $this->ci->db->where('employee_id', $employeeId)->update(EMPLOYEE_TABLE, array('wallet_balance' => $updated_wallet_balance));
//                    if ($update)
//                        return true;
//                }
//            }
//        }
//        return false;
//    }