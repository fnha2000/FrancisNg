<!DOCTYPE HTML>
<html>
    <head>
        <title>TextExchangeV3 Initialization</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
<?php
	include 'dbconnect.php';
	mysql_query("DROP TABLE Users");
	mysql_query("DROP TABLE Books");
	mysql_query("DROP TABLE Questions");
        mysql_query("DROP TABLE Posts");
	$result = mysql_query("CREATE TABLE Users(UserID VARCHAR(20) PRIMARY KEY NOT NULL, Password TEXT NOT NULL, Email CHAR(30) NOT NULL, Question1 INT NOT NULL, Answer1 TEXT NOT NULL, Question2 INT NOT NULL, Answer2 TEXT NOT NULL, Administrator INT NOT NULL)");
	$fp = fopen("users.flat", "r");
	while (!feof($fp)):
		$line = fgets($fp);
		$line = trim($line);
		$line = explode(",", $line);
                $password = crypt($line[1]);
                $ans1 = crypt($line[4]);
                $ans2 = crypt($line[6]);
		$query = "INSERT INTO Users VALUE('$line[0]','$password','$line[2]','$line[3]','$ans1','$line[5]','$ans2','$line[7]')";
		mysql_query($query) or die("Invalid insert " . mysql_error());
	endwhile;
	fclose($fp);
	
	$result = mysql_query("CREATE TABLE Books(ISBN CHAR(13) PRIMARY KEY NOT NULL, Subject CHAR(30) NOT NULL, Author CHAR(30) NOT NULL, Title CHAR(30) NOT NULL, FULLTEXT(Subject,Author,Title))");
	$fp = fopen("books.flat", "r");
	while (!feof($fp)):
		$line = fgets($fp);
		$line = trim($line);
		$line = explode(",", $line);
		$query = "INSERT INTO Books VALUE('$line[0]','$line[1]','$line[2]','$line[3]')";
		mysql_query($query) or die("Invalid insert " . mysql_error());
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
        
        $result = mysql_query("CREATE TABLE Posts(ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT, UserID VARCHAR(20) NOT NULL, ISBN CHAR(13) NOT NULL)");
        $fp = fopen("posts.flat", "r");
	while (!feof($fp)):
		$line = fgets($fp);
		$line = trim($line);
                $line = explode(",",$line);
		$query = "INSERT INTO Posts VALUE(NULL,'$line[0]','$line[1]')";
		mysql_query($query) or die("Invalid insert " . mysql_error());
	endwhile;
	fclose($fp);
        
        $tables = array("Users"=>array("UserID","Password","Email","Question1","Answer1","Question2","Answer2","Administrator"),
            "Books"=>array("ISBN","Subject","Author","Title"),
            "Questions"=>array("ID","Question"),
            "Posts"=>array("ID","UserID","ISBN"));
        foreach ($tables as $curr_table=>$curr_keys):
            $query = "SELECT * FROM ".$curr_table;
            $result = mysql_query($query);
            $rows = mysql_num_rows($result);
            $keys = $curr_keys;
            ?>
            <table>
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