<?php

namespace FrancisNg\Views;

class FooterPartial {
	private $model;
	
	public function initView($model) {
		$this->model = $model;
	}
	
	public function output() {
?>
		<div class="container">
			<hr>
			<footer>
				<p>
					&copy; <?php echo $this->model->getName() . ' ' . $this->model->getModYear() ?>
				</p>
			</footer>
		</div>
		<!-- /container -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
		
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		
		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
			( function(b, o, i, l, e, r) {
					b.GoogleAnalyticsObject = l;
					b[l] || (b[l] = function() {
						(b[l].q = b[l].q || []).push(arguments)
					});
					b[l].l = +new Date;
					e = o.createElement(i);
					r = o.getElementsByTagName(i)[0];
					e.src = '//www.google-analytics.com/analytics.js';
					r.parentNode.insertBefore(e, r)
				}(window, document, 'script', 'ga'));
			ga('create', 'UA-XXXXX-X');
			ga('send', 'pageview'); 
		</script>
		</body>
		</html>

<?php
	}
}
?>

