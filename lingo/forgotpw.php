<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['Lingo'];
    include 'dbconnect.php';

    show_header();
    if (isset($_POST['anssubmit'])):
        $userid = $userinfo['id'];
        $result = mysql_query("SELECT Users.Answer1, Users.Answer2 FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
        $row = mysql_fetch_array($result);
        $ans1 = $_POST['ans1'];
        $ans2 = $_POST['ans2'];
        if (crypt($ans1,$row["Answer1"]) == $row["Answer1"] && crypt($ans2,$row["Answer2"]) == $row["Answer2"]):
            $result = mysql_query("SELECT Users.Email FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
            $row = mysql_fetch_array($result);
            $usermail = $row["Email"];
            $url = "https://cs1520.cs.pitt.edu/~fhn1/php/lingo/resetpw.php?userid=$userid";
            $message = "You have requested to change your password. Please click the following link:\n$url";
            mail($usermail,"Password change request",$message,"From: Lingo");
            ?><p>An email has been sent to your email address. Please follow the instructions to reset your password.</p><?php
        else:
            $result = mysql_query("SELECT * FROM Users,Questions WHERE Users.UserID='$userid' AND (Users.Question1=Questions.ID OR Users.Question2=Questions.ID)") or die(mysql_error());
            $row1 = mysql_fetch_array($result);
            $row2 = mysql_fetch_array($result);
            ?>
            <form action="forgotpw.php"
                method="POST">
            <p>Please answer your two security questions.</p><br/>
            <?php
            if (crypt($ans1,$row["Answer1"]) != $row["Answer1"]):
                ?><p class="alert">The answer to the first question was wrong.</p><?php
            endif;
            ?>
            <h3>Question 1</h3>
            <p><?php echo $row1["Question"]?></p>
            <input type="text" name="ans1"/><br/>
            <?php
            if (crypt($ans2,$row["Answer2"]) != $row["Answer2"]):
                ?><p class="alert">The answer to the second question was wrong.</p><?php
            endif;
            ?>
            <h3>Question 2</h3>
            <p><?php echo $row2["Question"]?></p>
            <input type="text" name="ans2"/><br/>
            <input type="submit" name="anssubmit" value="Submit"/>
            </form>
            <?php
        endif;
    else:
        $userid = $userinfo['id'];
        $result = mysql_query("SELECT * FROM Users,Questions WHERE Users.UserID='$userid' AND (Users.Question1=Questions.ID OR Users.Question2=Questions.ID)") or die(mysql_error());
        $row1 = mysql_fetch_array($result);
        $row2 = mysql_fetch_array($result);
        ?>
        <form action="forgotpw.php"
              method="POST">
        <p>Please answer your two security questions.</p><br/>
        <h3>Question 1</h3>
        <p><?php echo $row1["Question"]?></p>
        <input type="text" name="ans1"/><br/>
        <h3>Question 2</h3>
        <p><?php echo $row2["Question"]?></p>
        <input type="text" name="ans2"/><br/>
        <input type="submit" name="anssubmit" value="Submit"/>
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
            </head>
            <body><section class="main">
                    <header>Lingo</header>
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