<?php

namespace FrancisNg\Views;

class ExperiencePartial {
	private $model = array();
	
	public function initView(array $model) {
		$this->model = $model;
	}

	public function output() {
?>
		<div class="colour-section" id="experience">
			<div class="container section">
				<div class="row text-center">
					<div class="col-md-12"><h2>Experience</h2><hr></div>
				</div>
				<?php
				foreach ($this->model as $experience) { 
				?>	
					<div class="row experience-item">
						<div class="col-md-4">
							<b><?php echo $experience->getTitleMain() ?></b>
							<br/>
							<p><?php echo $experience->getTitleSub() ?></p>
						</div>
						<div class="col-md-8">
							<b><?php echo $experience->getDetailMain() ?></b>
							<br/>
							<p><?php echo $experience->getDetailSub() ?></p>
						</div>
					</div>
					
				<?php } ?>
			</div>
		</div>
<?php
	}
}
?>