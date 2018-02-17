<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends Front_Model {

	function __construct() {
        parent::__construct();
        $this->table = VENDORS_TABLE;
        $this->primary_key = VENDORS_TABLE.'.id';
    }
    public function get_valid_on_days($vendor_id){
    	$this->table = VENDOR_VALID_DAYS;
        $this->primary_key = VENDORS_TABLE.'.id';
        $valid_on = $this->getRow('mon, tue, wed, thu, fri, sat, sun, open_from, open_to,valid_type',array('vendor_id'=>$vendor_id));
        // echo $this->db->last_query();
        // prx($valid_on);
        return (array)$valid_on;
    }

}

/* End of file vendor_mode.php */
/* Location: ./application/models/vendor_mode.php */