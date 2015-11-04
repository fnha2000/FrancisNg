<?php

namespace FrancisNg\Utils;

class ProjectDataReader extends DataReader {
	function __construct($file) {
		parent::__construct($file);
		$this->model = array();
		$this->processData();
	}
	
	protected function processData() {
		foreach ($this->rawdata->project as $project) {
			$curproj = new \FrancisNg\Models\Project;
			$curproj->setTitle($project->title);
			$curproj->setDescription($project->description);
			$curproj->setLink($project->address);
			$curproj->setThumbnail($project->thumbnail);
			$this->model[] = $curproj;
		}
	}
}

?>