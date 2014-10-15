<?php
require APPPATH.'libraries/tbs_class_php5.php';
require APPPATH.'libraries/tbs_plugin_aggregate.php';
require APPPATH.'libraries/tbs_plugin_plus.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tbs_load extends clsTinyButStrong {
	function tbs_load(){
		$this->clsTinyButStrong();
	}
}

?>