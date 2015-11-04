<?php

namespace FrancisNg\Views;

class ProjectsPartial {
	private $model = array();
	
	public function initView(array $model) {
		$this->model = $model;
	}

	public function output() {
?>
		<div class="colour-section" id="projects">
			<div class="container section">
				<div class="row text-center">
					<div class="col-md-12"><h2>Projects</h2><hr></div>
				</div>
				<div class="row">
				<?php
				for ($i = 0; $i < count($this->model); $i++) { 
				?>
					
					<div class="col-md-4 col-sm-6 col-xs-12 gallery-container" bg="<?php echo $this->model[$i]->getThumbnail() ?>">
						<a href="<?php echo $this->model[$i]->getLink() ?>" target="_blank"><span class="col-md-12 col-sm-12 col-xs-12"></span></a>
						<div class="row">
							<div class="col-md-12 col-xm-12 col-xs-12 gallery-desc">
								<h4><?php echo $this->model[$i]->getTitle() ?></h4>
								<p><?php echo $this->model[$i]->getDescription() ?></p>
							</div>
						</div>
					</div>
					
				<?php } ?>
				</div>
			</div>
		</div>
<?php }
}
?>