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
            <li class="active"><a href="#">Home</a></li>
            <li>
            	<a href="#">Image</a>
                <ul>
                	<li><a href="image.php">Phase 1</a></li>
                    <li><a href="phase2.php">Phase 2</a></li>
                    <li><a href="phase3.php">Phase 3</a></li>
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
            <p>Welcome to the homepage for Composing Digital Media. Project pages are listed on the main navigation, and other related links are on the footer.</p>
            <p>Notice: All resources used for projects on this site are for educational purposes only.</p>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>
