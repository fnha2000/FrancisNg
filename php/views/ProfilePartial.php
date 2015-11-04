<?php

namespace FrancisNg\Views;

class ProfilePartial {
	private $model;
	
	public function initView($model) {
		$this->model = $model;
	}

	public function output() {
?>

		<!-- Profile -->
		<div class="container section" id="profile">
			<div class="row text-center">
				<div class="col-md-12"><h2>Profile</h2><hr></div>
			</div>
			<div class="row">
				<div class="col-md-4 text-center">
					<img class="img-circle" src="<?php echo $this->model->getProfPicDir() ?>" />
				</div>
				<div class="col-md-8">
					<p><?php echo $this->model->getIntro() ?></p>
				</div>
			</div>
		</div>
		
<?php
	}
}
?>