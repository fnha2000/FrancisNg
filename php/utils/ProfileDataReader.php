<?php

namespace FrancisNg\Utils;

class ProfileDataReader extends DataReader {
	function __construct($file) {
		parent::__construct($file);
		$this->model = new \FrancisNg\Models\Profile;
		$this->processData();
	}
	
	protected function processData() {
		$this->model->setName($this->rawdata->name);
		$this->model->setIntro($this->rawdata->intro);
		$this->model->setProfPicDir($this->rawdata->profpicdir);
		$this->model->setModYear($this->rawdata->modifiedyear);
	}
}

?>