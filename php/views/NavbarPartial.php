<?php

namespace FrancisNg\Views;

class NavbarPartial {
	public function output() {
?>

		<nav class="navbar" id="navigation-main">
			<div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-collapsible" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="navigation-collapsible">
					<ul class="nav">
						<li><a href="#profile">Profile</a></li>
						<li><a href="#experience">Experience</a></li>
						<li><a href="#skills">Skills</a></li>
						<li><a href="#projects">Projects</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
<?php
	}
}
?>