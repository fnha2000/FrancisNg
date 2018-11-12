function requestWord() {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    httpRequest.open('GET', 'getWord.php', false);
    httpRequest.setRequestHeader('Content-Type', 'text/xml');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var wordData = JSON.parse(httpRequest.responseText);
            var exists = false;
            for (var i = 0; i < theWord.length; i++) {
                if (theWord[i] == wordData.word) {
                    exists = true;
                    break;
                }
            }
            if (!exists) {
                theWord[wordCount] = wordData.word;
                wordCount++;
            }
            else requestWord();
        }
    };
    httpRequest.send(null);
}

function initialize()
{
    currentGuess = 1;
    secondValue = 15;
    roundWon = false;
    var rows = $("#theTable tr:gt(0)");
    for (var i = 0; i < rows.length; i++) {
        $(rows[i]).remove();
    }
    $("#wordguess").val("");
}

function startGame() {
    if (!inprogress) {
        initialize();
        requestWord();
        inprogress = true;
        $("#timeleft").html("15");
        $("#wordguess").focus();
        gameTimer = setInterval(function() {updateTime()}, 1000);
        $("#theTable").append("<tr></tr>");
        $("#theTable tr:last").append("<td>" + theWord[wordCount-1].charAt(0) + "</td>");
        $("#theTable tr:last td:eq(0)").attr("class","correct");
        for (var i = 1; i < 10; i++) {
            $("#theTable tr:last").append("<td></td>");
        }
    }
    else {
        alert("A game is currently in progress.");
    }   
}

function updateTime() {
    secondValue--;
    $("#timeleft").html(secondValue);
    if (secondValue == 0) {
        currentGuess++;
        secondValue = 15;
        $("#timeleft").html("15");
        if (currentGuess < 6) {
            var oldrow = $("#theTable tr:last").html();
            $("#theTable").append("<tr></tr>");
            $("#theTable tr:last").append(oldrow);
        }
    }
    if (currentGuess == 6) {
        clearInterval(gameTimer);
        inprogress = false;
        $("#timeleft").html("0");
        alert("Time is up!");
        processResults();
    }
}

function processResults() {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var result, display;
    if (roundWon) {
		display = "Congratulations! You've won this round.</p>";
		result = "win";
	}
    else {
		display = "Too bad! You've lost this round.</p>";
		result = "lose";
	}
    var user = $("#currentuser").html();
    var data = "user=" + user + "&result=" + result;
    httpRequest.open('POST','score.php',false);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var result = JSON.parse(httpRequest.responseText);
            if (result.status == "Success") {
				var winpercent = result.won / result.played * 100;
                display += "<p>Your current statistics:<br/>Rounds played: " + result.played + "<br/>Rounds won: " + result.won + "<br/>Win %: " + winpercent;
                $("#resultpanel p").html(display);
				$("#resultpanel").css("display","block");
            }
            else alert("There was a problem posting your results.");
    	}
    };
    httpRequest.send(data);
}

function checkEnter(e) {
    if (e.which) {
        if (e.which == 13) submitGuess();
    }
    else if (e.keyCode) {
        if (e.keyCode == 13) submitGuess();
    }
}

function submitGuess() {
    if (inprogress) {
        var input = $("input#wordguess").val();
        var inputsize = input.length;
		if (inputsize == 0) {
			alert("Please enter a guess.");
			$("#wordguess").focus();
			return;
		}
        var inputboxes = $("#theTable tr:last td:gt(4)");
        for (var i = 0; i < inputsize; i++) {
            $(inputboxes[i]).html(input.charAt(i));
            $(inputboxes[i]).attr("class","inputletter");
        }
        $("#theTable").append("<tr></tr>");
        var results = checkLetter();
        for (var i = 0; i < inputsize; i++) {
            $("#theTable tr:last").append("<td>" + input.charAt(i) + "</td>");
            $("#theTable tr:last td:eq("+i+")").attr("class",results[i]);
        }
        for (var i = inputsize; i < 10; i++) {
            $("#theTable tr:last").append("<td></td>");
        }
        $("#wordguess").val("");
        $("#wordguess").focus();
        currentGuess++;
        clearInterval(gameTimer);
        var corrects = $("#theTable tr:last [class=correct]");
        if (corrects.length == 5) roundWon = true;
        if (roundWon || currentGuess == 6) {
            inprogress = false;
            processResults();
        }
        else {
            secondValue = 15;
            $("#timeleft").html("15");
            gameTimer = setInterval(function() {updateTime()}, 1000);
        }
    }
    else {
        alert("Please start a game first.");
    }
}

function checkLetter() {
    var guessWord = $("#wordguess").val();
    var curWord = theWord[wordCount-1];
    var found = [false,false,false,false,false];
    var result = ["notexist","notexist","notexist","notexist","notexist"];
    for (var i = 0; i < guessWord.length; i++) {
        for (var j = 0; j < curWord.length; j++) {
        	if (!found[j]) {
        		if (guessWord.charAt(i) == curWord.charAt(j)) {
        			if (i == j) result[i] = "correct";
        			else result[i] = "wrongplace";
        			found[j] = true;
					break;
        		}
        	}
        }
    }
    return result;
}

function LogOut() {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var data = "action=logout";
    httpRequest.open('POST','redirect.php',true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            location.reload(true);
    	}
    };
    httpRequest.send(data);
}