<?php
    session_start();
    include 'dbconnect.php';
    
    $user = $_POST['user'];
    $result = $_POST['result'];
    $query = mysql_query("SELECT Users.Played, Users.Won FROM Users WHERE Users.UserID='$user'") or die(mysql_error());
    $row = mysql_fetch_array($query);
    $played = $row['Played'];
    $won = $row['Won'];
    $played++;
    if (strcmp($result, "win") == 0):
        $won++;
    endif;
    mysql_query("LOCK TABLES Users WRITE");
    mysql_query("UPDATE Users SET Played=$played, Won=$won WHERE Users.UserID='$user'") or die(mysql_error());
    mysql_query("UNLOCK TABLES");
    header("Content-type: application/json");
    $response = array("status"=>"Success","played"=>$played,"won"=>$won);
    echo json_encode($response);
?>
