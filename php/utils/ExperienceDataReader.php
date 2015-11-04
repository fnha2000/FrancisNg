<?php

namespace FrancisNg\Utils;

class ExperienceDataReader extends DataReader {
	function __construct($file) {
		parent::__construct($file);
		$this->model = array();
		$this->processData();
	}
	
	protected function processData() {
		foreach ($this->rawdata->experience as $experience) {
			$curexp = new \FrancisNg\Models\Experience;
			$curexp->setTitleMain($experience->titlemain);
			$curexp->setTitleSub($experience->titlesub);
			$curexp->setDetailMain($experience->detailmain);
			$curexp->setDetailSub($experience->detailsub);
			$this->model[] = $curexp;
		}
	}
}

?>