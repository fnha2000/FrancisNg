<!DOCTYPE HTML>
<html>
    <head>
        <title>Lingo Initialization</title>
        <style type="text/css">
		body {
			background-color:white;
		}
		
		table {
			border-collapse:collapse;
		}
		</style>
    </head>
    <body>
<?php
	include 'dbconnect.php';
	mysql_query("DROP TABLE Users");
	mysql_query("DROP TABLE Words");
	mysql_query("DROP TABLE Questions");
	$result = mysql_query("CREATE TABLE Users(UserID VARCHAR(20) PRIMARY KEY NOT NULL, Password TEXT NOT NULL, Email CHAR(30) NOT NULL, Question1 INT NOT NULL, Answer1 TEXT NOT NULL, Question2 INT NOT NULL, Answer2 TEXT NOT NULL, Played INT NOT NULL, Won INT NOT NULL)") or die(mysql_error());
	$fp = fopen("users.flat", "r");
	while (!feof($fp)):
            $line = fgets($fp);
            $line = trim($line);
            $line = explode(",", $line);
        $password = crypt($line[1]);
		$ans1 = crypt($line[4]);
		$ans2 = crypt($line[6]);
        mysql_query("INSERT INTO Users VALUE('$line[0]','$password','$line[2]','$line[3]','$ans1','$line[5]','$ans2',0,0)") or die(mysql_error());
	endwhile;
	fclose($fp);
   
        $result = mysql_query("CREATE TABLE Words(Word CHAR(5) PRIMARY KEY NOT NULL)") or die(mysql_error());
        $fp = fopen("words5.txt", "r");
	while (!feof($fp)):
            $line = fgets($fp);
            $line = trim($line);
            if (strcmp($line,"") != 0) mysql_query("INSERT INTO Words VALUE('$line')") or die(mysql_error());
	endwhile;
	fclose($fp);
	
	$result = mysql_query("CREATE TABLE Questions(ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT, Question TEXT NOT NULL)");
	$fp = fopen("questions.flat", "r");
	while (!feof($fp)):
		$line = fgets($fp);
		$line = trim($line);
		$query = "INSERT INTO Questions VALUE(NULL,'$line')";
		mysql_query($query) or die("Invalid insert " . mysql_error());
	endwhile;
	fclose($fp);
        
        $tables = array("Users"=>array("UserID","Password","Email","Question1","Answer1","Question2","Answer2","Played","Won"),
			"Questions"=>array("ID","Question"),
            "Words"=>array("Word"));
        foreach ($tables as $curr_table=>$curr_keys):
            $query = "SELECT * FROM ".$curr_table;
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);
            $keys = $curr_keys;
            ?>
            <table border="1">
                <h4><?php echo $curr_table?></h4>
                <tr>
                    <?php
                    foreach ($keys as $next_key):
                        echo "<th>$next_key</th>";
                    endforeach;
                    echo "</tr>";
                    for ($i = 0; $i < $rows; $i++):
                        echo "<tr>";
                        $row = mysql_fetch_array($result);
                        foreach ($keys as $next_key):
                            echo "<td> $row[$next_key] </td>";
                        endforeach;
                        echo "</tr>";
                    endfor;
                    ?>
                </tr>
            </table>
            <?php
        endforeach;
?>
    </body>
</html>