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

	public function get_vouchers($location_id, $limit = NULL, $lastID = NULL, $offset = NULL) {
		// Location based.	
		// if (!empty($location_id)) {
		//  $this->db->where(array('valmp.location_id' => $location_id));
		//    $this->db->join(VOUCHER_AVAILABLE_LOCATIONS_MAP_TABLE . ' as valmp', 'valmp.voucher_id = v.id', 'left');
		// }
		
		$this->db->select('distinct(voucher.id), voucher.*,brand.name as brandname,brand.id as brandid,brand.logo as brandlogo');
		// $this->db->select('distinct(voucher.id), voucher.is_new,voucher.is_featured,voucher.sort_order,voucher.is_hot');
		$this->db->join(BRANDS_TABLE . ' as brand', 'brand.id = voucher.brand', 'left');
		$this->db->group_by('voucher.id');

		// set limit number of record in result.
		if($limit != ''  ||  $offset != '' )
			$this->db->limit($limit, $offset);
		// Enabled vouchers.
		$this->db->where('voucher.status',1);
		$this->db->order_by('voucher.is_new','DESC');
		$this->db->order_by('voucher.is_hot','DESC');
		$this->db->order_by('voucher.is_featured','DESC');
		$this->db->order_by('voucher.sort_order','DESC');

		// non-expired vouchers.
		$this->db->where('( DATE(NOW())< voucher.valid_from or DATE(NOW()) > voucher.valid_from or voucher.valid_from is null) and (voucher.valid_to >= DATE(NOW()) )');
		
		// for randoming the result
		$this->db->order_by('rand()');

		$query = $this->db->get($this->table . ' as voucher');
		if ($query->num_rows() > 0) 
				// prx( $query->result());
          	 return $query->result();
		else return false;
	}

	// function somename($query) {
	// 	return array_map(function ($_) {
	// 		return $_['id'];
	// 	}, $query->result_array());
	// }

	public function searchby($keyword='')
	{
		$brandids = array();	
		$this->db->select('distinct(voucher.id) , brand.id as brandid ,voucher.*');
		$this->db->like('brand.name',$keyword);
		$this->db->or_like('voucher.name',$keyword);
		$this->db->or_where("brand.id  in (SELECT brand_id FROM ".BRANDS_REDEEM_LOCATIONS_TABLE." WHERE address LIKE '%".$keyword."%')");
		$this->db->or_where("brand.category_id  in (SELECT id FROM ".CATEGORIES_TABLE." WHERE name LIKE '%".$keyword."%')");
		$this->db->join(BRANDS_TABLE . ' as brand', 'brand.id = voucher.brand','left');
		$category  = $this->db->get($this->table . ' as voucher');
		
		return $category->result_array();
	}
	
	public function get_vocher_cashback_categories($vid) {
		$query = $this->db->where('vcm.voucher_id', $vid)
			->join(VOUCHER_CATEGORIES_MAP_TABLE . ' as vcm', 'c.id = vcm.category_id')
			->get(CATEGORIES_TABLE . ' as c');
		return $query->row();
	}

	public function get_voucher($vid) {
		$query = $this->db->select('v.*,b.name as brandname,b.logo as brandlogo,b.id as brandid,b.description as branddescription,b.category_id as brandcategoryid')
			->where('v.id =' . $vid)
			// ->where("generateslug(v.name)='".$vname)
//                ->where('( DATE(NOW())< v.valid_from or DATE(NOW()) > v.valid_from or v.valid_from is null) and (v.valid_to >= DATE(NOW()) )')
			->join(BRANDS_TABLE . ' as b', 'b.id = v.brand', 'left')
			->get($this->table . ' as v');
			if ($query->num_rows() > 0) 
	    		 return $query->row();
			else prx($this->db->last_query());
			///return false;
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
