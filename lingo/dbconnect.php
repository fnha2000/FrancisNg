<?php
    $db = mysql_connect('localhost', 'francisn_francis', 'iM@S4y0u');
    if ($db):
            mysql_select_db('francisn_db');
    else:
            die("Could not connect to db " . mysql_error());
    endif;
?>
