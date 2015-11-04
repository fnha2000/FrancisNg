<?php

namespace FrancisNg\Models;

class Skill {
	private $desc;
	private $proficiency;
	
	public function getDescription() {
		return $this->desc;
	}
	
	public function getProficiency() {
		return $this->proficiency;
	}
	
	public function setDescription($value) {
		$this->desc = $value;
	}
	
	public function setProficiency($value) {
		$this->proficiency = $value;
	}
}

?>