<?php
    session_start();
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    $op = $_POST['op'];
    if (strcmp($op, "search") == 0):
        $type = $_POST['type'];
        $value = $_POST['value'];
        $result;
        if (strcmp($type, "ISBN") == 0):
            $result = mysql_query("SELECT Posts.ID,Posts.UserID,Books.ISBN,Books.Subject,Books.Author,Books.Title FROM Books,Posts WHERE Books.ISBN=Posts.ISBN AND Books.ISBN='$value'") or die(mysql_error());
        elseif (strcmp($type, "Subject") == 0):
            $result = mysql_query("SELECT Posts.ID,Posts.UserID,Books.ISBN,Books.Subject,Books.Author,Books.Title FROM Books,Posts WHERE Books.ISBN=Posts.ISBN AND Books.Subject='$value'") or die(mysql_error());
        elseif (strcmp($type, "Author") == 0):
            $result = mysql_query("SELECT Posts.ID,Posts.UserID,Books.ISBN,Books.Subject,Books.Author,Books.Title FROM Books,Posts WHERE Books.ISBN=Posts.ISBN AND Books.Author='$value'") or die(mysql_error());
        elseif (strcmp($type, "keyword") == 0):
            $result = mysql_query("SELECT Posts.ID,Posts.UserID,Books.ISBN,Books.Subject,Books.Author,Books.Title FROM Books,Posts WHERE Books.ISBN=Posts.ISBN AND MATCH(Books.Subject,Books.Author,Books.Title) AGAINST('$value')") or die(mysql_error());
        endif;
        $rows = mysql_num_rows($result);
        $bookdata = NULL;
        if ($rows == 0):
            $bookdata[] = array("id" => -1,"isbn" => "","subject" => "","author" => "","title" => "","owner" => "");
        endif;
        for ($i = 0; $i < $rows; $i++):
            $row = mysql_fetch_array($result);
            $book = array("id" => $row['ID'],"isbn" => $row['ISBN'],"subject" => $row['Subject'],"author" => $row['Author'],"title" => $row['Title'],"owner" => $row['UserID']);
            $bookdata[] = $book;
        endfor;
        echo json_encode($bookdata);
    elseif (strcmp($op, "mybooks") == 0):
        $userid = $userinfo['id'];
        $result = mysql_query("SELECT Posts.ID,Posts.UserID,Books.ISBN,Books.Subject,Books.Author,Books.Title FROM Books,Posts WHERE Books.ISBN=Posts.ISBN AND Posts.UserID='$userid'") or die(mysql_error());
        $rows = mysql_num_rows($result);
        $bookdata = NULL;
        if ($rows == 0):
            $bookdata[] = array("id" => -1,"isbn" => "","subject" => "","author" => "","title" => "","owner" => "");
        endif;
        for ($i = 0; $i < $rows; $i++):
            $row = mysql_fetch_array($result);
            $book = array("id" => $row['ID'],"isbn" => $row['ISBN'],"subject" => $row['Subject'],"author" => $row['Author'],"title" => $row['Title'],"owner" => $row['UserID']);
            $bookdata[] = $book;
        endfor;
        echo json_encode($bookdata);
    elseif (strcmp($op, "exists") == 0):
        $isbn = $_POST['isbn'];
        $result = mysql_query("SELECT * FROM Books WHERE Books.ISBN='$isbn'");
        $rows = mysql_num_rows($result);
        $bookdata = NULL;
        if ($rows == 0):
            $bookdata[] = array("isbn" => -1, "subject" => "", "author" => "", "title" => "");
        else:
            $row = mysql_fetch_array($result);
            $bookdata[] = array("isbn" => $row['ISBN'], "subject" => $row["Subject"], "author" => $row['Author'], "title" => $row['Title']);
        endif;
        echo json_encode($bookdata);
    elseif (strcmp($op, "users") == 0):
        $result = mysql_query("SELECT Users.UserID, Users.Email FROM Users") or die(mysql_error());
        $rows = mysql_num_rows($result);
        $users = NULL;
        for ($i = 0; $i < $rows; $i++):
            $row = mysql_fetch_array($result);
            $users[] = array("id" => $row['UserID'], "email" => $row['Email']);
        endfor;
        echo json_encode($users);
    endif;
?>
