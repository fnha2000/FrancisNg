<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    $op = $_POST['op'];
    if (strcmp($op,"chpw") == 0):
        $id = $userinfo['id'];
        $oldpwd = $_POST['curpwd'];
        $result = mysql_query("SELECT Users.Password FROM Users WHERE Users.UserID='$id'") or die(mysql_error());
        $row = mysql_fetch_array($result);
        if (crypt($oldpwd,$row["Password"]) == $row["Password"]):
            mysql_query("LOCK TABLES Users WRITE");
            $newpwd = crypt($_POST['newpwd']);
            mysql_query("UPDATE Users SET Password='$newpwd' WHERE Users.UserID='$id'");
            mysql_query("UNLOCK TABLES");
            echo "Success";
        else:
            echo "WrongPassword";
        endif;
    endif;
?>
