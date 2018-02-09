<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brands_redeem_location_model extends Front_Model {

    function __construct() {

        parent::__construct();

        $this->table = BRANDS_REDEEM_LOCATIONS_TABLE;
        $this->primary_key = BRANDS_REDEEM_LOCATIONS_TABLE . '.id';
    }

}
