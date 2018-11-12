<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['Lingo'];
    include 'dbconnect.php';
    
    show_header();
    if ($_GET['userid']):
        $userid = $_GET['userid'];
        $_SESSION['status'] = $userid;
        $result = mysql_query("SELECT * FROM Users,Questions WHERE Users.UserID='$userid' AND (Users.Question1=Questions.ID OR Users.Question2=Questions.ID)") or die(mysql_error());
        $row1 = mysql_fetch_array($result);
        $row2 = mysql_fetch_array($result);
        ?>
        <form name="secQues"
              action="resetpw.php"
              method="POST"
              onSubmit="return checkAns()">
        <p>Please answer your two security questions.</p><br/>
        <h3>Question 1</h3>
        <p><?php echo $row1["Question"]?></p>
        <input type="text" name="ans1" value=""/><br/>
        <h3>Question 2</h3>
        <p><?php echo $row2["Question"]?></p>
        <input type="text" name="ans2" value=""/><br/>
        <input type="submit" name="anssubmit" value="Submit"/>
        </form>
        <?php
    elseif (isset($_POST['anssubmit'])):
        $userid = $_SESSION['status'];
        $result = mysql_query("SELECT Users.Answer1, Users.Answer2 FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
        $row = mysql_fetch_array($result);
        $ans1 = $_POST['ans1'];
        $ans2 = $_POST['ans2'];
        if (crypt($ans1,$row["Answer1"]) == $row["Answer1"] && crypt($ans2,$row["Answer2"]) == $row["Answer2"]):
            ?>
            <form action="resetpw.php"
                  method="POST">
                New password: <input type="password" name="pwd"/><br/>
                Re-enter new password: <input type="password" name="pwdvrfy"/><br/>
                <input type="submit" name="pwdsubmit" value="Submit"/>
            </form>
            <?php
        else:
            $result = mysql_query("SELECT * FROM Users,Questions WHERE Users.UserID='$userid' AND (Users.Question1=Questions.ID OR Users.Question2=Questions.ID)") or die(mysql_error());
            $row1 = mysql_fetch_array($result);
            $row2 = mysql_fetch_array($result);
            ?>
            <form name="secQues"
                action="resetpw.php"
                method="POST"
                onSubmit="return checkAns()">
            <p>Please answer your two security questions.</p><br/>
            <?php
            if (crypt($ans1,$row["Answer1"]) != $row["Answer1"]):
                ?><p class="alert">The answer to the first question was wrong.</p><?php
            endif;
            ?>
            <p>Question 1</p>
            <p><?php echo $row1["Questions.Question"]?></p>
            <input type="text" name="ans1" value=""/><br/>
            <?php
            if (crypt($ans2,$row["Answer2"]) != $row["Answer2"]):
                ?><p class="alert">The answer to the second question was wrong.</p><?php
            endif;
            ?>
            <p>Question 2</p>
            <p><?php echo $row2["Questions.Question"]?></p>
            <input type="text" name="ans2" value=""/><br/>
            <input type="submit" name="anssubmit" value="Submit"/>
            </form>
            <?php
        endif;
    elseif (isset($_POST['pwdsubmit'])):
        $userid = $_SESSION['status'];
        if ($_POST['pwd'] != $_POST['pwdvrfy']):
            ?>
            <p class="alert">Your passwords did not match.</p>
            <form name="newPwForm"
                  action="resetpw.php"
                  method="POST"
                  onSubmit="return checkNewPw()">
                New password: <input type="password" name="pwd" value=""/><br/>
                Re-enter new password: <input type="password" name="pwdvrfy" value=""/><br/>
                <input type="submit" name="pwdsubmit" value="Submit"/>
            </form>
            <?php
        else:
            if (strlen($_POST['pwd']) == 0):
                ?>
                <p class="alert">Please do not enter blank passwords.</p>
                <form name="newPwForm"
                      action="resetpw.php"
                      method="POST"
                      onSubmit="return checkNewPw()">
                    New password: <input type="password" name="pwd" value=""/><br/>
                    Re-enter new password: <input type="password" name="pwdvrfy" value=""/><br/>
                    <input type="submit" name="pwdsubmit" value="Submit"/>
                </form>
                <?php
            else:
                mysql_query("LOCK TABLES Users WRITE");
                $newpassword = crypt($_POST['pwd']);
                mysql_query("UPDATE Users SET Password='$newpassword' WHERE Users.UserID='$userid'") or die(mysql_error());
                mysql_query("UNLOCK TABLES");
                echo "<p>Your password has been changed.</p>";
            endif;
        endif;
    elseif (isset($_POST['pwdchange'])):
        $userid = $userinfo['id'];
        $oripwd = $_POST['oripwd'];
        $newpwd = $_POST['newpwd'];
        $vfypwd = $_POST['vfypwd'];
        $result = mysql_query("SELECT Users.Password FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
        $row = mysql_fetch_array($result);
        if (crypt($oripwd,$row["Password"]) == $row["Password"]):
            if ($newpwd == $vfypwd):
                if (strlen($newpwd) == 0):
                    ?>
                    <p class="alert">Please do not enter blank passwords.</p>
                    <form name="checkPwd"
                    action="resetpw.php"
                    method="POST"
                    onSubmit="return checkPwd()">
                        Current password: <input type="password" name="oripwd" value=""/><br/>
                        New password: <input type="password" name="newpwd" value=""/><br/>
                        Re-enter new password: <input type="password" name="vfypwd" value=""/><br/>
                        <input type="submit" name="pwdchange" value="Submit"/>
                    </form>
                    <?php
                else:
                    mysql_query("LOCK TABLES Users WRITE");
                    $newpassword = crypt($newpwd);
                    mysql_query("UPDATE Users SET Password='$newpassword' WHERE Users.UserID='$userid'") or die(mysql_error());
                    mysql_query("UNLOCK TABLES");
                    echo "<p>Your password has been changed.</p>";
                endif;
            else:
                ?>
                <p class="alert">Your new passwords do not match.</p>
                <form name="checkPwd"
                action="resetpw.php"
                method="POST"
                onSubmit="return checkPwd()">
                    Current password: <input type="password" name="oripwd" value=""/><br/>
                    New password: <input type="password" name="newpwd" value=""/><br/>
                    Re-enter new password: <input type="password" name="vfypwd" value=""/><br/>
                    <input type="submit" name="pwdchange" value="Submit"/>
                </form>
                <?php
            endif;
        else:
            ?>
            <p class="alert">You entered the wrong password.</p>
            <form name="checkPwd"
              action="resetpw.php"
              method="POST"
              onSubmit="return checkPwd()">
                Current password: <input type="password" name="oripwd" value=""/><br/>
                New password: <input type="password" name="newpwd" value=""/><br/>
                Re-enter new password: <input type="password" name="vfypwd" value=""/><br/>
                <input type="submit" name="pwdchange" value="Submit"/>
            </form>
            <?php
        endif;
    else:
        ?>
        <form name="checkPwd"
              action="resetpw.php"
              method="POST"
              onSubmit="return checkPwd()">
            Current password: <input type="password" name="oripwd" value=""/><br/>
            New password: <input type="password" name="newpwd" value=""/><br/>
            Re-enter new password: <input type="password" name="vfypwd" value=""/><br/>
            <input type="submit" name="pwdchange" value="Submit"/>
        </form>
        <?php
    endif;
    show_end();

    function show_header() {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>Lingo</title>
                <link rel="stylesheet" type="text/css" href="css/style.css" />
                <script type="text/javascript">
				function checkAns() {
					if (document.secQues.ans1.value == "") {
							alert("Please enter your answer.");
							document.secQues.ans1.focus();
							return false;
					}
					if (document.secQues.ans2.value == "") {
							alert("Please enter your answer.");
							document.secQues.ans2.focus();
							return false;
					}
					return true;
				}
				
				function checkNewPw() {
					if (document.newPwForm.pwd.value == "") {
							alert("Please enter a password.");
							document.newPwForm.pwd.focus();
							return false;
					}
					if (document.newPwForm.pwdvrfy.value == "") {
							alert("Please re-enter your password.");
							document.newPwForm.pwdvrfy.focus();
							return false;
					}
					return true;
				}
				
				function checkPwd() {
					if (document.checkPwd.oripwd.value == "") {
							alert("Please enter your current password.");
							document.checkPwd.oripwd.focus();
							return false;
					}
					if (document.checkPwd.newpwd.value == "") {
							alert("Please enter your new password.");
							document.checkPwd.newpwd.focus();
							return false;
					}
					if (document.checkPwd.vfypwd.value == "") {
							alert("Please re-enter your new password.");
							document.checkPwd.vfypwd.focus();
							return false;
					}
					return true;
				}
				</script>
            </head>
            <body><section class="main">
                    <header>Lingo</header>
                    <h3>Change Password</h3>
        <?php
    }

    function show_end() {
        ?>
                <br/>
                <footer><a href="login.php">Back</a></footer>
            </section></body>
        </html>
        <?php
    }
?>
