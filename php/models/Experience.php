<?php

namespace FrancisNg\Models;

class Experience {
	private $titleMain;
	private $titleSub;
	private $detailMain;
	private $detailSub;
	
	public function getTitleMain() {
		return $this->titleMain;
	}
	
	public function getTitleSub() {
		return $this->titleSub;
	}
	
	public function getDetailMain() {
		return $this->detailMain;
	}
	
	public function getDetailSub() {
		return $this->detailSub;
	}
	
	public function setTitleMain($value) {
		$this->titleMain = $value;
	}
	
	public function setTitleSub($value) {
		$this->titleSub = $value;
	}
	
	public function setDetailMain($value) {
		$this->detailMain = $value;
	}
	
	public function setDetailSub($value) {
		$this->detailSub = $value;
	}
}

?>