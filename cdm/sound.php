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
            </li>
            <li><a href="video.php">Video</a></li>
            <li><a href="remix.php">Remix</a></li>
            <li>
            	<a href="indie.php">Indie</a>
            </li>
            </ul>
        </div>
        <div class="content">
        	<h3>Soundscape proposal</h3>
            <p>The Hillman Library is probably one of the most familiar locations to many students on campus. It is where students go to study, work on projects and homework, and maybe even relax at the Cup and Chaucer or to use the computers, either for academic or other purposes. During finals week when the library is open 24 hours, some students even spend the night there. So how would I consider such a place to be strange or unfamiliar?</p>
            <p>I am the kind of student who prefers working in my own room, in an environment I consider more "familiar" than most other places. I always get the feeling that although the library tends to be very crowded, there is always a feeling of detachment from the surroundings. Due to the quiet atmosphere, any sound I make when walking through a room seems to echo hollowly, seemingly amplified by the relative silence. People usually speak in low voices or whisper, giving it a muffled, distant quality even though they may be at the table right next to you. Very occasionally, the muffled sound of music also fills the air when someone has the volume of their headphones on so loud that the sound leaks out.</p>
            <p>I intend to record the sounds of different locations in the library, possibly on each individual floor. More notable spots would be the computer lab and/or computer terminals, the open study halls, around the Cup and Chaucer Cafe, and the stairways. The time of day would also affect the number of people and the amount of activity in the library. The library tends to fill up towards the night, when everyone's classes are over and they flock to the library to study and do their homework.</p>
                
            <h3>Soundscape - Part 1</h3>
            <audio controls="controls">
  				<source src="sound/Soundscape_mixdown.mp3" type="audio/mpeg" />
  						Your browser does not support the audio element.
			</audio>
            <h3>Soundscape - Part 2 / Podcast</h3>
            <audio controls="controls">
  				<source src="sound/podcast.mp3" type="audio/mpeg" />
  						Your browser does not support the audio element.
			</audio>
            <h3>Soundscape+Podcast - Revision 1</h3>
            <audio controls="controls">
  				<source src="sound/soundscape_revision1.mp3" type="audio/mpeg" />
  						Your browser does not support the audio element.
			</audio>
        </div>
        <?php readfile("footer.html"); ?>
    </div>
</body>
</html>
