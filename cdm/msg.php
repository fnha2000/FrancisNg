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
            <li>
            	<a href="#">Image</a>
                <ul>
                	<li><a href="image.php">Phase 1</a></li>
                    <li><a href="phase2.php">Phase 2</a></li>
                    <li><a href="phase3.php">Phase 3</a></li>
                </ul>
            </li>
            <li class="active">
            	<a href="#">Sound</a>
                <ul>
                    <li><a href="sound.php">Soundscape</a></li>
                    <li class="active"><a href="#">Message</a></li>
                </ul>
            </li>
            <li><a href="video.php">Video</a></li>
            <li><a href="remix.php">Remix</a></li>
            <li>
            	<a href="#">Indie</a>
                <ul>
                	<li><a href="indieprop.php">Proposal</a></li>
                    <li><a href="indie.php">Project</a></li>
                </ul>
            </li>
            </ul>
        </div>
        <div class="content">
            <p>This is a message tone as a familiarizing exercise for sound editing in Adobe Audition.</p>

            <audio controls="controls">
  				<source src="sound/message.mp3" type="audio/mpeg" />
  				<source src="sound/message.ogg" type="audio/ogg" />
  						Your browser does not support the audio element.
			</audio>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>
