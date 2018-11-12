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
            	<a href="#">Sound</a>
                <ul>
                    <li><a href="sound.php">Soundscape</a></li>
                    <li><a href="msg.php">Message</a></li>
                </ul>
            </li>
            <li><a href="#">Video</a></li>
            <li><a href="remix.php">Remix</a></li>
            <li class="active">
            	<a href="#">Indie</a>
                <ul>
                	<li class="active"><a href="indieprop.php">Proposal</a></li>
                    <li><a href="indie.php">Project</a></li>
                </ul>
            </li>
            </ul>
        </div>
        <div class="content">
            <p>These are the proposal drafts for the indie project.</p>

            <h3>Proposal 1</h3>
            <p>I intend to create an animation using Adobe Photoshop and After Effects. I will first write a script for a possible storyline or message I intend to pass through the animation, then draft the required images, props, and characters in Photoshop using layers. I will then import them into After Effects to animate them and add in any necessary effects and/or soundtracks, resulting in a full animated presentation.</p>
            <h3>Proposal 2</h3>
            <p>I will create a website that is oriented towards my major, computer science. It will have a cleaner, more professional look that makes it easier to find any information required. The kind of information the website will contain will include my resume, any independent projects related to computer science that I have completed, and the kind of classes taken that contribute to my experience in particular areas.</p>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>