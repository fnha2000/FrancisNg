<?php

namespace FrancisNg\Controllers;

class ProfileController {
	// File constants
	private $profileXml = 'data/profile.xml';
	private $experienceXml = 'data/experiences.xml';
	private $skillXml = 'data/skills.xml';
	private $langXml = 'data/langskills.xml';
	private $projectXml = 'data/projects.xml';
	private $creativeXml = 'data/creatives.xml';
	
	// Data objects
	private $pageModel;
	private $pageView;
	
	// Reader objects
	private $ProfileReader;
	private $ProjectReader;
	private $SkillReader;
	private $LangSkillReader;
	private $ExperienceReader;
	private $CreativeReader;
	
	function __construct() {
		$this->initDataReaders();
	}
	
	public function getPageModel() {
		return $this->pageModel;
	}
	
	public function getPageView() {
		return $this->pageView;
	}
	
	public function loadData() {
		$this->pageModel = new \FrancisNg\Models\PageModel; 
		$this->pageView = new \FrancisNg\Views\PageView;
		$this->pageModel->setProfileData($this->ProfileReader->getData());
		$this->pageModel->setExperiences($this->ExperienceReader->getData());
		$this->pageModel->setProjects($this->ProjectReader->getData());
		$this->pageModel->setSkills($this->SkillReader->getData());
		$this->pageModel->setLangSkills($this->LangSkillReader->getData());
		$this->pageModel->setCreativeData($this->CreativeReader->getData());
		$this->pageView->initView($this->pageModel);
	}
	
	private function initDataReaders() {
		$this->ProfileReader = new \FrancisNg\Utils\ProfileDataReader($this->profileXml);
		$this->ProjectReader = new \FrancisNg\Utils\ProjectDataReader($this->projectXml);
		$this->SkillReader = new \FrancisNg\Utils\SkillDataReader($this->skillXml);
		$this->LangSkillReader = new \FrancisNg\Utils\SkillDataReader($this->langXml);
		$this->ExperienceReader = new \FrancisNg\Utils\ExperienceDataReader($this->experienceXml);
		$this->CreativeReader = new \FrancisNg\Utils\CreativeDataReader($this->creativeXml);
	}
}

?>