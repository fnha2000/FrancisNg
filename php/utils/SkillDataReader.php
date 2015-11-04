<?php

namespace FrancisNg\Utils;

class SkillDataReader extends DataReader {
	function __construct($file) {
		parent::__construct($file);
		$this->model = array();
		$this->processData();
	}
	
	protected function processData() {
		foreach ($this->rawdata->skill as $skill) {
			$curskill = new \FrancisNg\Models\Skill;
			$curskill->setProficiency($skill->proficiency);
			$curskill->setDescription($skill->description);
			$this->model[] = $curskill;
		}
	}
}

?>