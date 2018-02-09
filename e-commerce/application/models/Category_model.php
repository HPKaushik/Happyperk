<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Category_model extends Front_Model {

	function __construct() {

		parent::__construct();

		$this->table = CATEGORY_TABLE;
		$this->primary_key = CATEGORY_TABLE . '.id';
	}
}
