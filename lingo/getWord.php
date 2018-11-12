<?php
    session_start();
    include 'dbconnect.php';
    
    $result = mysql_query("SELECT * FROM Words ORDER BY RAND() LIMIT 1") or die(mysql_error());
    header("Content-type: application/json");
    $row = mysql_fetch_array($result);
    $value = array("word" => $row['Word']);
    echo json_encode($value);
?>
