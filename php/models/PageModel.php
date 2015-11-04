<?php

namespace FrancisNg\Models;

class PageModel {
	private $profileData;
	private $experiences = array();
	private $projects = array();
	private $skills = array();
	private $langSkills = array();
	private $creativeData = array();
	
	public function getProfileData() {
		return $this->profileData;
	}
	
	public function getExperiences() {
		return $this->experiences;
	}
	
	public function getProjects() {
		return $this->projects;
	}
	
	public function getSkills() {
		return $this->skills;
	}
	
	public function getLangSkills() {
		return $this->langSkills;
	}
	
	public function getCreativeData() {
		return $this->creativeData;
	}
	
	public function setProfileData($value) {
		$this->profileData = $value;
	}
	
	public function setExperiences(array $value) {
		$this->experiences = $value;
	}
	
	public function setProjects(array $value) {
		$this->projects = $value;
	}
	
	public function setSkills(array $value) {
		$this->skills = $value;
	}
	
	public function setLangSkills(array $value) {
		$this->langSkills = $value;
	}
	
	public function setCreativeData(array $value) {
		$this->creativeData = $value;
	}
}

?>