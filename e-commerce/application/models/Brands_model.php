<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands_model extends Front_Model {
	function __construct() {

		parent::__construct();

		$this->table = BRANDS_TABLE;
		$this->primary_key = BRANDS_TABLE . '.id';
	}
}

/* End of file brands_model.php */
/* Location: ./application/models/brands_model.php */