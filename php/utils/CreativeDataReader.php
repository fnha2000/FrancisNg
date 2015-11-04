<?php

namespace FrancisNg\Utils;

class CreativeDataReader extends DataReader {
	function __construct($file) {
		parent::__construct($file);
		$this->model = array();
		$this->processData();
	}
	
	protected function processData() {
		
	}
}

?>