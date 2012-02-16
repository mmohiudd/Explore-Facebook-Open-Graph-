<!doctype html>
<!--[if lte IE 8 ]> 
	<html lang="en" class="no-js oldie"> <![endif]-->
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="imagetoolbar" content="no">
						
		<title>Explore Facebook Open Graph with BNOTIONS</title>
		
		<meta name="description" content="">
		<meta name="author" content="(c) 2012 - BNOTIONS">
		
		<link rel="shortcut icon" type="image/png" href="<?php echo url::site()?>assets/img/favicon.png">
		
		<link rel="stylesheet" href="<?php echo url::site()?>assets/css/bp.css">
		<link rel="stylesheet" href="<?php echo url::site()?>assets/css/screen.css?v=2" media="screen">
	
		<script src="<?php echo url::site()?>assets/js/libs/modernizr-2.0.6.min.js"></script>
	
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo url::site()?>assets/js/libs/selectivizr-1.0.2.min.js"></script>
	<![endif]-->	
	</head>
	
	<body>
		<header>
			
		</header>
	
		<section id="ctas">
			<h1>Total auths: <?php echo $total_auths?></h1>
			<h1>Total Netflix users: <?php echo $total_netflix_users?></h1>
			<h1>Last movie(s) watched:<br>
			<?php
			$i=0;
			foreach($last_movies_watched as $movie) {
				echo $movie['name'] . "<br>";
				if(++$i==5){
					break;	
				}
			}
			?>
			</h1>
			<h1>Most popular:<br>
			<?php
			for($i=0;$i<5; $i++) {
				echo $most_popular_video[$i]['name'] . "<br>";
			}
			?>
			</h1>
		</section>
		
		<footer>
			<div>
				
				<section></section>
			</div>
		</footer>
	
		<!-- scripts -->
		<!-- 	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/js/libs/jquery-1.7.1.min.js"><\/script>')</script> -->
		<script src="<?php echo url::site()?>assets/js/libs/jquery-1.7.1.min.js"></script>
		<script src="<?php echo url::site()?>assets/js/plugins.js"></script>
		<script src="<?php echo url::site()?>assets/js/script.js"></script>
		
		<script>
			var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>
	</body>
</html>