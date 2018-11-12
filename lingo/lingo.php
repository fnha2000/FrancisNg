<?php
    session_start();
    $userinfo = $_COOKIE['Lingo'];
    
    if (!$userinfo) header("Location: login.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lingo</title>
        <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/lingo.js"></script>
    </head>
    <body> 
        <section class="main">
            <table id="nav">
                <tr>
                    <td><span id="currentuser"><?php echo $userinfo['id']?></span><span class="navlink" onclick="LogOut()">(Log Out)</span></td>
                    <td><span style="font-style:italic;font-weight:bold;color:royalblue;font-size:1.2em;">LINGO</span></td>
                    <td>Time left: <span id="timeleft">0</span></td>
                </tr>
            </table>
            <p>You get 5 guesses at a 5-letter word. You only get 15 seconds for each guess.<br/>
            After 15 seconds, you will be considered to have entered a blank guess.<br/>
            Enter your guess in the text box and press Enter or click Submit. <br/>
            If a letter entered is in the <span style="font-weight:bold;font-style:italic;">correct location</span>, it will be displayed in <span style="color:red;font-weight:bold;">RED UPPER CASE</span>.<br/>
            If a letter entered is in the word but in the <span style="font-weight:bold;font-style:italic;">wrong location</span>, it will be displayed in <span style="color:blue;font-weight:bold;">BLUE UPPER CASE</span>.<br/>
            If a letter entered is <span style="font-weight:bold;font-style:italic;">not in the word</span>, it will be displayed in <span style="color:black;font-weight:bold;">black lower case</span>.</p>
            <span class="link" onClick="startGame()">Start Game</span>
            <section id="gamepanel">
                <table id = "theTable" border = "1" class="thetable">
                    <tr><th colspan="5">Results</th><th colspan="5">Your Guesses</th></tr>
                </table>
                <input type="text" id="wordguess" value="" onkeydown="checkEnter(event)"/><span class="link" onclick="submitGuess()">Submit</span>
            </section>
            <section id="resultpanel">
                <p></p>
                <span class="link" id="playagain">Play Again</span><br/><br/>
                <span class="link" id="closeresults">Close</span>
            </section>
        </section>
        <script type="text/javascript">
            var theWord, wordCount, currentGuess, roundWon, inprogress, gameTimer, secondValue;
            $(document).ready(function() {
                theWord = new Array();
                wordCount = 0;
                inprogress = false;
				$("#resultpanel").css("display","none");
				$("#closeresults").click(function() {
					$("#resultpanel").css("display","none");
				});
				$("#playagain").click(function() {
					$("#resultpanel").css("display","none");
					startGame();
				});
                initialize();
            });
        </script>
    </body>
</html>
