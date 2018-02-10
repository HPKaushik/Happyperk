<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order {

    protected $_table = ORDER_TABLE;

    public function __construct() {
        $this->ci = & get_instance();
    }
	
	function doOrder($user_id, $location_id, $email, $telephone, $total, $sub_total = '', $order_for = 0) {

        $prepareDataInsert = array();
        $prepareDataUpdate = array();
        
        $prepareDataInsert['user_id'] = $user_id;
		$prepareDataInsert['location_id'] = $location_id;
		$prepareDataInsert['email'] = $email;
		$prepareDataInsert['telephone'] = $telephone;
		$prepareDataInsert['total'] = $total;
		$prepareDataInsert['sub_total'] = $sub_total;
		$prepareDataInsert['order_for'] = $order_for;
		$prepareDataInsert['created_at'] = date('Y-m-d H:i:s');
		$prepareDataInsert['order_status_id'] = 1;
		
		// Insert into database
		$result = $this->ci->db->insert($this->_table, $prepareDataInsert);
		$last_insert_id = $this->ci->db->insert_id();
		
        // Updating record
		if ($result) {
			$prepareDataUpdate['order_code'] = 'HP'.str_pad($last_insert_id, 6, 0, STR_PAD_LEFT);
			$prepareDataUpdate['invoice_no'] = 'HPO'.str_pad($last_insert_id, 6, 0, STR_PAD_LEFT);	   
			$updated = $this->ci->db->where('order_id', $last_insert_id)->update($this->_table, $prepareDataUpdate);
			if ($updated) {
				return $last_insert_id;
			}
		}
        return false;
    }
}