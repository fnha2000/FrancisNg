<?php

namespace FrancisNg\Views;

class SkillsPartial {
	private $techSkillList = array();
	private $langSkillList = array();
	
	public function initView(array $techSkillList, array $langSkillList) {
		$this->techSkillList = $techSkillList;
		$this->langSkillList = $langSkillList;
		usort($this->techSkillList, array($this, 'skillSort'));
	}

	public function output() {
?>

		<!-- Skills -->
		<div class="container section" id="skills">
			<div class="row text-center">
				<div class="col-md-12"><h2>Skills</h2><hr></div>
			</div>
			<div class="row text-center"><h3>Technical</h3></div>
			<div class="row">
			<?php
			for ($i = 0; $i < count($this->techSkillList); $i++) {
			?>
					<div class="col-md-6">
						<div class="row skill">
							<div class="col-sm-8 col-xs-8">
								<span><?php echo $this->techSkillList[$i]->getDescription() ?></span>
							</div>
							<div class="col-sm-4 col-xs-4">
								<div class="meter">
									<span style="width: <?php echo ($this->techSkillList[$i]->getProficiency() * 20) ?>%"></span>
								</div>
							</div>
						</div>
					</div>
					<?php 
				}
					?>
			</div>
			<div class="row text-center"><h3>Language</h3></div>
			<div class="row">
			<?php
				for ($i = 0; $i < count($this->langSkillList); $i++) {
			?>
					<div class="col-md-6">
						<div class="row skill">
							<div class="col-sm-8 col-xs-8">
								<span><?php echo $this->langSkillList[$i]->getDescription() ?></span>
							</div>
							<div class="col-sm-4 col-xs-4">
								<b><?php echo $this->langSkillList[$i]->getProficiency() ?></b>
							</div>
						</div>
					</div>
			<?php 
				}
			?>
			</div>
		</div>
		
<?php
	}
	
	function skillSort($first, $second) {
		return -strcmp($first->getProficiency(), $second->getProficiency());
	}
}
?>