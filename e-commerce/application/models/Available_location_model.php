<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Available_location_model extends Front_Model {
    
    function __construct() {

        parent::__construct();

        $this->table = AVAILABLE_LOCATIONS_TABLE;
        $this->primary_key = AVAILABLE_LOCATIONS_TABLE.'.id';
    }
	
	public function get_locations(){
		
		$query = $this->db->where('l.status', 1)
						  ->get($this->table.' as l');
		
		return $query->result();
		
	}
}