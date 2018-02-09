<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction_model extends Front_Model {

    function __construct() {

        parent::__construct();

        $this->table = EMPLOYEE_TRANSACTIONS_TABLE;
        $this->primary_key = EMPLOYEE_TRANSACTIONS_TABLE . '.id';
    }

    function total_amount($user_id) {
        $query = $this->db->query("SELECT ((SELECT COALESCE(SUM(amount),0) FROM hp_transaction WHERE tran_type =1 AND user_id=" . $user_id . ") - (SELECT COALESCE(SUM(amount),0) FROM hp_transaction WHERE tran_type =2 AND (user_id!=" . $user_id . " AND corporate_id =" . $user_id . "))) as myblance");
        return $query->row();
    }

    function wallet_amount_of_employee($user_id) {
        $query = $this->db->query("SELECT COALESCE(SUM(amount),0) as myblance FROM hp_transaction WHERE user_id=" . $user_id . "");
        return $query->row();
    }

    /*
     *  
     * @param type $user_id
     * @return type data object for result    
     *
     */
	/* 
    function getAllTransactions($user_id) {
        $allTransactions = $query = $this->db->where('user_id', $user_id)->order_by('added_on', 'ASC')->get(EMPLOYEE_TRANSACTIONS_TABLE)->result();
        //exit($this->db->last_query());
        return $allTransactions;
    } */
	
	function getAllTransactionsEmployee($employee_id) {
        $allTransactions = $this->db->where('employee_id', $employee_id)->order_by('created_at', 'Desc')->limit(15)->get(EMPLOYEE_TRANSACTIONS_TABLE)->result();
        return $allTransactions;
    }

}
