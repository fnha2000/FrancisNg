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
            <li><a href="video.php">Video</a></li>
            <li><a href="remix.php">Remix</a></li>
            <li class="active">
            	<a href="#">Indie</a>
            </li>
            </ul>
        </div>
        <div class="content">
            <h3>Proposal</h3>
            <p>I will create an animation using Adobe Photoshop and After Effects. I will first write a script for a possible storyline or message I intend to pass through the animation. A rough draft will most likely be done in a storyboard format to make it easier to organize the kinds of images I will need to compose the scenario. It will also be easier to set my script to the visual scenes required.</p> 
            <p>Next, I will draft the required images, props, and characters in Photoshop using layers. I plan to use a more stylistic approach in the visual style, with only silhouettes and general shapes to represent characters and environmental elements, without detailed faces and expressions, mainly because it will make animation many times harder if facial expressions are to be included. Individual movable parts will be on separate layers, essentially making the characters puppets with torsos, arms, legs and so on that can be manipulated separately. However, I may also use a 3D character animation program to animate 3D characters with modified shaders that make them look flat, so that I can show characters in pseudo-3D space without having to draw every angle from scratch.</p> 
            <p>I will then import them into After Effects to animate them. Although After Effects is intended for use to add special effects to video files, it is possible to create animated scenes in it with Photoshop files. One possible issue I could run into is setting a soundtrack to the final animation, or possibly even the intermediate scenes. Because After Effects does not work with native video files in my case, previews do not play in real time, causing sound files to not play as they would. The current workaround I can think of involves rendering a video file first before adding sound, and may cause sync problems if length does not match my intended soundtrack. Because I can edit the sound itself if required, it should be possible to produce a reasonable animation if the smaller difficulties can be solved.</p>
            <video width="512" height="384" controls>
  				<source src="http://www.stephceraso.com/students_2012/francis/video/indie.mp4" type="video/mp4" />
  				<source src="http://www.stephceraso.com/students_2012/francis/video/indie.ogg" type="video/ogg" />
  				Your browser does not support the video tag.
			</video>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>
