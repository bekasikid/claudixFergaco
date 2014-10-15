<?php

class MY_Model extends CI_Model {
	
	public $em;
	
	function __construct() {
		parent::__construct();
	
		// Instantiate Doctrine's Entity manage so we don't have to everytime we want to use Doctrine
// 		$this->em = $this->doctrine->em;
	}
	
	/**
	 * inject_class - load class using dependency injection
	 */
	public function inject_class($path, $class, $func) {
		// load_class is a function located in system/core/common.php on line 123
		return load_class($class, $path, NULL);
	}
	
}