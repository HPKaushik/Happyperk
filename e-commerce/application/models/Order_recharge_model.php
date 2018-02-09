<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_recharge_model extends Front_Model {

    function __construct() {

        parent::__construct();

        $this->table = ORDER_RECHARGE_TABLE;
        $this->primary_key = ORDER_RECHARGE_TABLE . '.id';
    }

    public function getAllRechargeOrderInfo($user_id) {
        $query = ORDER_RECHARGE_TABLE . '.*,' . ORDER_TABLE . '.*,';
        $where = ORDER_RECHARGE_TABLE . ".order_id=" . ORDER_TABLE . ".order_id";
        $this->db->select($query);
        $this->db->from(ORDER_RECHARGE_TABLE);
        $this->db->from(ORDER_TABLE);
        $this->db->where($where);
        $this->db->where(ORDER_TABLE . '.user_id', $user_id);
        $this->db->order_by(ORDER_TABLE . '.order_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

}
