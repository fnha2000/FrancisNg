<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Francis Ng's Digital Media</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<div class="main">
    	<div class="banner">
        	<img alt="banner" src="Banner.png" />
        </div>
    	<div id="nav">
        	<ul class="navmenu">
            <li><a href="home.php">Home</a></li>
            <li class="active">
            	<a href="#">Image</a>
                <ul>
                	<li><a href="image.php">Phase 1</a></li>
                    <li><a href="phase2.php">Phase 2</a></li>
                    <li class="active"><a href="#">Phase 3</a></li>
                </ul>
            </li>
            <li>
            	<a href="sound.php">Sound</a>
            </li>
            <li><a href="video.php">Video</a></li>
            <li><a href="remix.php">Remix</a></li>
            <li>
            	<a href="indie.php">Indie</a>
            </li>
            </ul>
        </div>
        <div class="content">
            <p>This is Phase 3 of the image project.</p>
            <p>In this final phase, no new images were added to the composite, instead it is made entirely from reused elements found in the previous stage. Once again, masking, effects, and transforms were the essential tools in creating this final scene.</p>
			<div class="imgcont">
            	<div class="thumb"><a href="http://www.flickr.com/photos/fnha2000/6849682477/in/photostream"><img alt="img1" src="phase3/phase3t.jpg" class="thumb" width="230" height="153" /></a></div>
			</div>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>