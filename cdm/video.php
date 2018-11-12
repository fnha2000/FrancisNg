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
            <li>
            	<a href="sound.php">Sound</a>
            </li>
            <li class="active"><a href="#">Video</a></li>
            <li><a href="remix.php">Remix</a></li>
            <li>
            	<a href="indie.php">Indie</a>
            </li>
            </ul>
        </div>
        <div class="content">
        	<h3>Concept Proposal</h3>
            <p>I will be focusing on the idea of learning a new language as the "familiar", everyday part of campus life. The specific language I will focus on is Japanese. I will first show the regular routine of learning a completely unfamiliar language that most students go through. This will include reading on cultural aspects and grammatical structures, writing the different scripts used in Japanese, and practicing speech and conversations. As many students of unfamiliar languages will know, it can become a very tedious routine, and may lead to some frustration. I will then move on to less conventional or "non-textbook" ways of familiarizing oneself with the language and culture, techniques which I have personally used and found effective. These will include reading manga or Japanese comics, magazines, and eventually novels, watching Japanese animations and films, and even playing Japanese games. I will present these in a hopefully light-hearted and amusing way, making use of music and/or sound effects to set the mood.</p>
            <video width="640" height="480" controls>
  				<source src="http://www.stephceraso.com/students_2012/francis/video/vidproj.mp4" type="video/mp4" />
  				<source src="http://www.stephceraso.com/students_2012/francis/video/vidproj.ogg" type="video/ogg" />
  				Your browser does not support the video tag.
			</video>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>
