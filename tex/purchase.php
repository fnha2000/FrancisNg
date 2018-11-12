<?php
    session_start();
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    $isbn = $_POST['isbn'];
    $subject = $_POST['subject'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $recipient = $_POST['owner'];
    $result = mysql_query("SELECT Users.Email FROM Users WHERE Users.UserID='$recipient'") or die(mysql_error());
    $row = mysql_fetch_array($result);
    $email = $row["Email"];
    $mailsubject = $userinfo['id']." would like to purchase your book.";
    $message = $userinfo['id']." would like to purchase the following book:\n\nISBN: $isbn\nSubject: $subject\nAuthor: $author\nTitle: $title\n\nComments from ".$userinfo['id'].":\n".$_POST['message'];
    mail($email,$mailsubject,$message,"From: ".$userinfo['email']);
    echo "Success";
?>
