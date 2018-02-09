<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Order_model extends Front_Model {

	function __construct() {
		parent::__construct();
		$this->table = ORDER_TABLE;
		$this->primary_key = $this->table . '.order_id';
	}

	public function updateInvoice($last_insert_id, $invoice) {
		$this->db->where('order_id', $last_insert_id);
		$this->db->update($this->table, array('invoice_no' => $invoice));
	}

	public function updateOrderCode($last_insert_id, $order_code, $invoice_no) {
		$this->db->where('order_id', $last_insert_id);
		$this->db->update($this->table, array('order_code' => $order_code, 'invoice_no' => $invoice_no));
		return true;
	}

	public function get_voucher_id_master_products($vid) {
		$query = $this->db->where('mp.voucher_id =' . $vid)
			->get(MASTER_PRODUCTS_TABLE . ' as mp');
		return $query->row();
	}

	public function get_ordered_voucher_id($oid) {
		$query = $this->db->select('vc.voucher_id')
			->join(ORDER_VOUCHERS_MAP_TABLE . ' as voc', 'voc.order_id = ' . $oid, 'left')
			->join(VOUCHERS_COUPONCODES_TABLE . ' as vc', 'vc.id = voc.voucher_coupon_id', 'left')
			->where('o.order_id =' . $oid)
			->get($this->table . ' as o');
		return $query->row()->voucher_id;
	}

	public function get_product_order_details($oid) {
		$query = $this->db->where('order_id =' . $oid)
			->get(ORDER_PRODUCTS_MAP_TABLE);
		return $query->row();
	}
	public function get_recharge_order_details($oid) {
		$query = $this->db->where('order_id =' . $oid)
			->get(ORDER_RECHARGE_TABLE);
		return $query->row();
	}
	public function get_order_details($oid) {
		$query = $this->db->where('order_id =' . $oid)
			->get($this->table);
		return $query->row();
	}

	public function get_hotel_id_master_products($hotel_package_id) {
		$query = $this->db->where('mp.hotel_package_id =' . $hotel_package_id)
			->get(MASTER_PRODUCTS_TABLE . ' as mp');
		return $query->row();
	}

	public function insert_oder_prod_map($order_products_map) {
		$this->db->insert(ORDER_PRODUCTS_MAP_TABLE, $order_products_map);
		return true;
	}

	public function get_vouchers_couponcodes($vid, $quantity) {
		$wdata = array('vc.voucher_id' => $vid, 'vc.is_used' => 0);
		$query = $this->db->where($wdata)
			->limit($quantity)
			->get(VOUCHERS_COUPONCODES_TABLE . ' as vc');
		return $query->result_array();
	}

	public function update_voucher_coupon_codes($coupon_data) {
		$this->db->update_batch(VOUCHERS_COUPONCODES_TABLE, $coupon_data, 'id');
		$this->db->last_query();
		exit;
		return true;
	}

	public function insert_order_voucher_coupons($order_voucher_coupons) {
		$this->db->insert_batch(ORDER_VOUCHER_HOTEL_PURCHASED_MAP_TABLE, $order_voucher_coupons);
		return true;
	}

	public function insert_order_hotel_package($order_voucher_hotel_package_map) {
		$this->db->insert(ORDER_VOUCHER_HOTEL_PURCHASED_MAP_TABLE, $order_voucher_hotel_package_map);
		return true;
	}

	public function reduce_hotel_package_qty($hotel_package_id, $qty) {
		$this->db->query("UPDATE " . HOTEL_PACKAGES_TABLE . " as hp SET `hp`.`qty` = `hp`.`qty`-" . $qty . " WHERE `hp`.`id`=" . $hotel_package_id);
		return true;
	}

	/**
	 * @author  Kaushik
	 * Modified date 24-11-2017
	 * @date 7-11-2017
	 * @param type $user_id
	 * @return type object
	 */
	function getAllOrdersVouchers($user_id) {
		$allOrders = $query = $this->db->where(array('user_id' => $user_id, 'order_for' => 0))->order_by('created_at', 'DESC')->get($this->table)->result();
		//exit($this->db->last_query());
		return $allOrders;
	}

	public function get_voucher_coupon_code($oid) {
		$query = $this->db->select('vc.coupon_code')
			->join(ORDER_VOUCHERS_MAP_TABLE . ' as voc', 'voc.order_id = ' . $oid, 'left')
			->join(VOUCHERS_COUPONCODES_TABLE . ' as vc', 'vc.id = voc.voucher_coupon_id', 'left')
			->where('o.order_id =' . $oid)
			->get($this->table . ' as o');
		return $query->row()->coupon_code;
	}

	function getAllOrdersRecharge($user_id) {
		$allOrders = $query = $this->db->where(array('user_id' => $user_id, 'order_for' => 1))->order_by('created_at', 'DESC')->get($this->table)->result();
		return $allOrders;
	}

	function getAllOrdersHotels($user_id) {
		$allOrders = $this->db->where(array('user_id' => $user_id, 'order_for' => 2))->order_by('created_at', 'DESC')->get($this->table)->result();
		return $allOrders;
	}

	function getAllPurchasedVouchers() {
		$purchasedVouchers = $this->db->select('distinct(voucher_coupon.voucher_id)')
			->where(array('order.user_id' => '812'))
			->where('voucher_coupon.voucher_id != ', 'NULL')
			->join(ORDER_VOUCHERS_MAP_TABLE . ' as ordered', 'order.order_id=ordered.order_id', 'left')
			->join(VOUCHERS_COUPONCODES_TABLE . ' as voucher_coupon', 'voucher_coupon.voucher_id=ordered.Id', 'left')
			->get($this->table . ' as order')->result();
		return !empty($purchasedVouchers) ? $this->object_to_array($purchasedVouchers) : array();
	}

	function object_to_array($object) {
		$object_to_array = array();
		foreach ($object as $key => $value) {
			$object_to_array[$key] = $value->voucher_id;
		}
		return $object_to_array;
	}

}
