<?php

namespace FrancisNg\Views;

class CreativePartial {
	private $model = array();
	
	public function initView(array $model) {
		$this->model = $model;
	}

	public function output() {
?>
		
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12"><h2>Creative</h2><hr></div>
			</div>
		</div>
		
<?php
	}
}
?>