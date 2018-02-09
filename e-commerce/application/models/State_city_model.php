<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class State_city_model extends Front_Model {

    function __construct() {

        parent::__construct();

        $this->table = CITY_TABLE;
        $this->primary_key = CITY_TABLE . '.city_id';
    }

    function getState() {
        $this->db->select('*');
        $query = $this->db->get(STATE_TABLE);
        return $query->result();
    }

    function getStateCity() {
        $this->db->select('*');
        $this->db->join(CITY_TABLE, CITY_TABLE . '.state_id = ' . STATE_TABLE . '.state_id');
        $query = $this->db->get(STATE_TABLE);
        return $query->result();
    }

    public function getCities($state_id) {
        $this->db->select(CITY_TABLE . '.city_id,city_name');
        $this->db->from(CITY_TABLE);
        $this->db->where('state_id', $state_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getCity($stateid) {
        $this->db->select("city_name,city_id");
        $this->db->order_by('city_name');
        $this->db->where('state_id', $stateid);
        $query = $this->db->get(CITY_TABLE);
        return $query->result();
    }

}
