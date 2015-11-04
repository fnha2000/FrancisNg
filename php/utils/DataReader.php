<?php

namespace FrancisNg\Utils;

abstract class DataReader {
	protected $rawdata;
	protected $model;
	
	function __construct($file) {
		$this->loadData($file);
	}
	
	protected function loadData($file) {
		$xml = file_get_contents($file);
		$xml = $this->simplexml_unCDATA($xml);
		$this->rawdata = simplexml_load_string($xml);
	}
	
	public function getData() {
		return $this->model;
	}
	
	function simplexml_unCDATA($xml) {
	    $new_xml = NULL;
	    preg_match_all("/\<\!\[CDATA \[(.*)\]\]\>/U", $xml, $args);
	
	    if (is_array($args)) {
	        if (isset($args[0]) && isset($args[1])) {
	            $new_xml = $xml;
	            for ($i=0; $i<count($args[0]); $i++) {
	                $old_text = $args[0][$i];
	                $new_text = htmlspecialchars($args[1][$i]);
	                $new_xml = str_replace($old_text, $new_text, $new_xml);
	            }
	        }
	    }
	
	    return $new_xml;
	}
	
	abstract protected function processData();
}

?>