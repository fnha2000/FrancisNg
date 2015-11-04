<?php

namespace FrancisNg\Models;

class Project {
	private $title;
	private $desc;
	private $address;
	private $thumbnail;
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getDescription() {
		return $this->desc;
	}
	
	public function getLink() {
		return $this->address;
	}
	
	public function getThumbnail() {
		return $this->thumbnail;
	}
	
	public function setTitle($value) {
		$this->title = $value;
	}
	
	public function setDescription($value) {
		$this->desc = $value;
	}
	
	public function setLink($value) {
		$this->address = $value;
	}
	
	public function setThumbnail($value) {
		$this->thumbnail = $value;
	}
}

?>