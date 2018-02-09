<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Vouchers_model extends Front_Model {

	function __construct() {

		parent::__construct();

		$this->table = VOUCHERS_TABLE;
		$this->primary_key = VOUCHERS_TABLE . '.id';
	}

	public function get_vouchers($location_id, $limit = NULL, $lastID = NULL, $offset = NULL, $search_by_name = NULL) {
		$this->db->select('distinct(v.id)');
		if (!empty($location_id)) {
//            $this->db->where(array('valmp.location_id' => $location_id));
			//            $this->db->join(VOUCHER_AVAILABLE_LOCATIONS_MAP_TABLE . ' as valmp', 'valmp.voucher_id = v.id', 'left');
		}
		$this->db->where(array('v.status' => 1));
		$this->db->where('( DATE(NOW())< v.valid_from or DATE(NOW()) > v.valid_from or v.valid_from is null) and (v.valid_to >= DATE(NOW()) )');

		$query = $this->db->get($this->table . ' as v');
		if ($lastID != '') {
			$where = 'nv.id  <' . $lastID;
		}
		if ($query->num_rows() > 0) {
			$this->db->select('distinct(nv.id), nv.*,b.name as brandname,b.id as brandid,b.logo as brandlogo');
			$this->db->join(BRANDS_TABLE . ' as b', 'b.id = nv.brand', 'left');
			$this->db->group_by('nv.id');
			$this->db->order_by('nv.id', 'DESC');
			$this->db->where_in('nv.id', $this->somename($query));
			if ($lastID != '') {
				$this->db->where('nv.id  <' . $lastID);
			}
			if ($search_by_name != '') {
				$this->db->like('nv.name', $search_by_name);
			}
			$this->db->limit($limit, $offset);
			$query = $this->db->get($this->table . ' as nv');
			return $query->result();
		}
		return false;
	}

	function somename($query) {
		return array_map(function ($_) {
			return $_['id'];
		}, $query->result_array());
	}

	public function get_vocher_cashback_categories($vid) {
		$query = $this->db->where('vcm.voucher_id', $vid)
			->join(VOUCHER_CATEGORIES_MAP_TABLE . ' as vcm', 'c.id = vcm.category_id')
			->get(CATEGORIES_TABLE . ' as c');
		return $query->row();
	}

	public function get_voucher($vid) {
		$query = $this->db->select('v.*,b.name as brandname,b.logo as brandlogo,b.id as brandid,b.category_id as brandcategoryid')
			->where('v.id =' . $vid)
//                ->where('( DATE(NOW())< v.valid_from or DATE(NOW()) > v.valid_from or v.valid_from is null) and (v.valid_to >= DATE(NOW()) )')
			->join(BRANDS_TABLE . ' as b', 'b.id = v.brand', 'left')
			->get($this->table . ' as v');
		return $query->row();
	}

	public function getvendor_details($vid) {
		$query = $this->db->select('vendor_id')->where('id', $vid)->get($this->table);
		return $query->row();
	}

	public function get_voucher_of_same_category($brandid, $brandcategoryid, $voucherid) {
		$query = $this->db->select('v.*,b.name as brandname,b.logo as brandlogo')->where('v.id !=' . $voucherid)
			->join(BRANDS_TABLE . ' as b', 'b.id = v.brand', 'left  ')->where('b.category_id =' . $brandcategoryid)
			->where('b.id !=' . $brandid)->limit(3)
			->where('( DATE(NOW())< v.valid_from or DATE(NOW()) > v.valid_from or v.valid_from is null) and (v.valid_to >= DATE(NOW()) )')
			->get($this->table . ' as v');
		return $query->result();
	}

	public function get_voucher_of_same_brand($bid, $voucherid) {
		$query = $this->db->select('v.*,b.name as brandname,b.logo as brandlogo')->where('b.id =' . $bid)
			->where('v.id !=' . $voucherid)
			->join(BRANDS_TABLE . ' as b', 'b.id = v.brand', 'left  ')
			->where('( DATE(NOW())< v.valid_from or DATE(NOW()) > v.valid_from or v.valid_from is null) and (v.valid_to >= DATE(NOW()) )')
			->limit(3)
			->get($this->table . ' as v');
		return $query->result();
	}

	public function get_voucher_array($vid) {
		$query = $this->db->select('v.*,b.name as brandname,b.logo as brandlogo')->where('v.id =' . $vid)
			->join(BRANDS_TABLE . ' as b', 'b.id = v.brand')
			->get($this->table . ' as v');
		return $query->row_array();
	}

	public function get_voucher_brand_locations($vid) {
		$query = $this->db->select('bl.brand_id,bl.address,bl.latitude,bl.longitude')->where('v.id', $vid)
			->join(BRANDS_REDEEM_LOCATIONS_TABLE . ' as bl', 'bl.brand_id = v.brand')
			->get(VOUCHERS_TABLE . ' as v');
		return $query->result();
	}

	public function get_avalible_coupon_count($vid) {
		$count = $this->db->where(array('voucher_id' => $vid, 'is_used' => 0, 'is_purchased' => 0))
			->get(VOUCHERS_COUPONCODES_TABLE)
			->num_rows();
		return $count;
	}

	public function get_avalible_coupon($vid) {
		$avalible_coupons = $this->db->select('id')->where(array('voucher_id' => $vid, 'is_used' => 0, 'is_purchased' => 0))
			->get(VOUCHERS_COUPONCODES_TABLE)
			->row();
		return $avalible_coupons->id;
	}

	// Update status to is_purchased = 1; table = VOUCHERS_COUPONCODES_TABLE;
	public function update_purchased_coupons($vid) {
		$update = array('is_purchased' => '1', 'updated_at' => date('Y-m-d H:i:s'));
		$is_purchased = $this->db->where('id', $vid)->update(VOUCHERS_COUPONCODES_TABLE, $update);
		return $is_purchased;
	}

	public function add_ordered_voucher_map_table($data = array()) {
		$data['created_at'] = date('Y-m-d H:i:s');
		$ad = $this->db->insert(ORDER_VOUCHERS_MAP_TABLE, $data);
		return ($ad) ? true : false;
	}

	public function add_ordered_product_map_table($data = array()) {
		$ad = $this->db->insert(ORDER_PRODUCTS_MAP_TABLE, $data);
		return ($ad) ? true : false;
	}

}
