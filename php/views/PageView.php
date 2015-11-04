<?php

namespace FrancisNg\Views;

class PageView {
	private $model;
	private $navbarPartial;
	private $profilePartial;
	private $experiencePartial;
	private $skillsPartial;
	private $projectsPartial;
	private $creativePartial;
	private $headerPartial;
	private $footerPartial;
	
	public function initView($model) {
		$this->model = $model;
		$this->navbarPartial = new \FrancisNg\Views\NavbarPartial;
		$this->profilePartial = new \FrancisNg\Views\ProfilePartial;
		$this->profilePartial->initView($model->getProfileData());
		$this->experiencePartial = new \FrancisNg\Views\ExperiencePartial;
		$this->experiencePartial->initView($model->getExperiences());
		$this->skillsPartial = new \FrancisNg\Views\SkillsPartial;
		$this->skillsPartial->initView($model->getSkills(), $model->getLangSkills());
		$this->projectsPartial = new \FrancisNg\Views\ProjectsPartial;
		$this->projectsPartial->initView($model->getProjects());
		$this->creativePartial = new \FrancisNg\Views\CreativePartial;
		$this->creativePartial->initView($model->getCreativeData());
		$this->headerPartial = new \FrancisNg\Views\HeaderPartial;
		$this->headerPartial->initView($model->getProfileData());
		$this->footerPartial = new \FrancisNg\Views\FooterPartial;
		$this->footerPartial->initView($model->getProfileData());
	}

	public function output() {
		$this->headerPartial->output();
		$this->navbarPartial->output();
?>

		<div class="jumbotron">
			<div class="container text-center top-header">
				<h1 class="big-header"><?php echo $this->model->getProfileData()->getName() ?></h1>
				<hr>
				<h2>Profile and Portfolio</h2>
			</div>
			<div id="overlay"></div>
		</div>
		
<?php
		$this->profilePartial->output();
		$this->experiencePartial->output();
		$this->skillsPartial->output();
		$this->projectsPartial->output();
		//$this->creativePartial->output();
		$this->footerPartial->output();
		
	}
}
?>