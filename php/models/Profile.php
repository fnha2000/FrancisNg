<?php

namespace FrancisNg\Models;

class Profile {
	private $name;
	private $intro;
	private $profPicDir;
	private $modYear;
	
	public function getName() {
		return $this->name;
	}
	
	public function getIntro() {
		return $this->intro;
	}
	
	public function getProfPicDir() {
		return $this->profPicDir;
	}
	
	public function getModYear() {
		return $this->modYear;
	}
	
	public function setName($value) {
		$this->name = $value;
	}
	
	public function setIntro($value) {
		$this->intro = $value;
	}
	
	public function setProfPicDir($value) {
		$this->profPicDir = $value;
	}
	
	public function setModYear($value) {
		$this->modYear = $value;
	}
}

?>