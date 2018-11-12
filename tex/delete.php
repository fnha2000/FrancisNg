<?php
    session_start();
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    $op = $_POST['op'];
    if (strcmp($op, "user") == 0):
        $id = $_POST['id'];
        mysql_query("LOCK TABLES Users WRITE");
        mysql_query("DELETE FROM Users WHERE Users.UserID='$id'") or die(mysql_error());
        mysql_query("UNLOCK TABLES");
        mysql_query("LOCK TABLES Posts WRITE");
        mysql_query("DELETE FROM Posts WHERE Posts.UserID='$id'") or die(mysql_error());
        mysql_query("UNLOCK TABLES");
        echo "Success";
    elseif (strcmp($op, "userbooks") == 0):
        $id = $_POST['id'];
        mysql_query("LOCK TABLES Posts WRITE");
        mysql_query("DELETE FROM Posts WHERE Posts.UserID='$id'") or die(mysql_error());
        mysql_query("UNLOCK TABLES");
        echo "Success";
    elseif (strcmp($op, "books") == 0):
        $type = $_POST['type'];
        $keyword = $_POST['query'];
        if (strcmp($type, "Author") == 0):
            $result = mysql_query("SELECT Books.ISBN FROM Books WHERE Books.Author='$keyword'") or die(mysql_error());
            $rows = mysql_num_rows($result);
            if ($rows == 0):
                die("Not found");
            endif;
            for ($i = 0; $i < $rows; $i++):
                $row = mysql_fetch_array($result);
                $isbn = $row["ISBN"];
                mysql_query("LOCK TABLES Books WRITE");
                mysql_query("DELETE FROM Books WHERE Books.ISBN='$isbn'") or die(mysql_error());
                mysql_query("UNLOCK TABLES");
                mysql_query("LOCK TABLES Posts WRITE");
                mysql_query("DELETE FROM Posts WHERE Posts.ISBN='$isbn'") or die(mysql_error());
                mysql_query("UNLOCK TABLES");
            endfor;
        elseif (strcmp($type, "keyword") == 0):
            $result = mysql_query("SELECT Books.ISBN FROM Books WHERE MATCH(Books.Subject,Books.Author,Books.Title) AGAINST('$search')");
            $rows = mysql_num_rows($result);
            if ($rows == 0):
                die("Not found");
            endif;
            for ($i = 0; $i < $rows; $i++):
                $row = mysql_fetch_array($result);
                $isbn = $row["ISBN"];
                mysql_query("LOCK TABLES Books WRITE");
                mysql_query("DELETE FROM Books WHERE Books.ISBN='$isbn'") or die(mysql_error());
                mysql_query("UNLOCK TABLES");
                mysql_query("LOCK TABLES Posts WRITE");
                mysql_query("DELETE FROM Posts WHERE Posts.ISBN='$isbn'") or die(mysql_error());
                mysql_query("UNLOCK TABLES");
            endfor;
        endif;
        echo "Success";
    endif;
?>
