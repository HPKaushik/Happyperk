<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends Front_Model {
    
    function __construct() {

        parent::__construct();

        $this->table = LOCATION_TABLE;
        $this->primary_key = LOCATION_TABLE.'.id';
    }

    
}