<?php
namespace Core;

use \Core\Connect;
use \PDO;

class Model extends Connect {

	protected $db;

	/**
	 * Construct
	 */	
	public function __construct() {
		parent::__construct();
		global $db;
		$this->db = $db;
	}

}