<?php
    session_start();
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    $op = $_POST['op'];
    if (strcmp($op, "post") == 0):
        $isbn = $_POST['isbn'];
        $subject = $_POST['subject'];
        $author = $_POST['author'];
        $title = $_POST['title'];
        $userid = $userinfo['id'];
        $result = mysql_query("SELECT * FROM Books WHERE Books.ISBN='$isbn'") or die(mysql_error());
        if (mysql_num_rows($result) == 0):
            mysql_query("LOCK TABLES Books WRITE");
            mysql_query("INSERT INTO Books VALUE('$isbn','$subject','$author','$title')") or die(mysql_error());
            mysql_query("UNLOCK TABLES");
        endif;
        mysql_query("LOCK TABLES Posts WRITE");
        mysql_query("INSERT INTO Posts VALUE(NULL,'$userid','$isbn')") or die(mysql_error());
        mysql_query("UNLOCK TABLES");
        echo "Success";
    elseif (strcmp($op, "edit") == 0):
        $isbn = $_POST['isbn'];
        $subject = $_POST['subject'];
        $author = $_POST['author'];
        $title = $_POST['title'];
        mysql_query("LOCK TABLES Books WRITE") or die(mysql_error());
        mysql_query("UPDATE Books SET Subject='$subject',Author='$author',Title='$title' WHERE Books.ISBN='$isbn'") or die(mysql_error());
        mysql_query("UNLOCK TABLES");
        echo "Success";
    elseif (strcmp($op, "delete") == 0):
        $id = $_POST['id'];
        mysql_query("LOCK TABLES Posts WRITE");
        mysql_query("DELETE FROM Posts WHERE Posts.ID=$id") or die(mysql_error());
        mysql_query("UNLOCK TABLES");
        echo "Success";
    endif;
?>
