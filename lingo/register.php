<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['Lingo'];
    include 'dbconnect.php';
    
    show_header();
    if (isset($_POST['register'])):
        $id = $_POST['id'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $ans1 = $_POST['ans1'];
        $ans2 = $_POST['ans2'];
        $ques1 = $_POST['ques1'];
        $ques2 = $_POST['ques2'];
        $idexists = false;
        $invalidmail = false;
        $result = mysql_query("SELECT Users.UserID FROM Users WHERE Users.UserID='$id'") or die(mysql_error());
        if (mysql_num_rows($result) > 0) $idexists = true;
        $mailcomp = explode("@",$email);
        if (!checkdnsrr($mailcomp[1], "A")) $invalidmail = true;
        if ($idexists || $invalidmail):
            if ($idexists) {
                ?><p class="alert">The selected user ID already exists.</p><?php
            }
            if ($invalidmail) {
                ?><p class="alert">The email address you entered is invalid.</p><?php
            }
            $result = mysql_query("SELECT * FROM Questions") or die(mysql_error());
            $rows = mysql_num_rows($result);
            ?>
            <p>Please enter your information.</p><br/>
            <form id="regform"
                action="register.php"
                method="POST"
                onSubmit="return checkForm()">
                ID: <input type="text" name="id"/><br/>
                Password: <input type="password" name="password"/><br/>
                Email: <input type="text" name="email"/><br/><br/>
                Security question 1: <select name="ques1">
                    <?php
                    for ($i = 0; $i < $rows; $i++):
                        $row = mysql_fetch_array($result);
                        ?>
                        <option value=<?php echo $row["ID"]?>><?php echo $row["Question"]?></option>
                        <?php
                    endfor;
                    ?>
                </select><br/>
                Answer 1: <input type="text" name="ans1"/><br/><br/>
                <?php
                $result = mysql_query("SELECT * FROM Questions") or die(mysql_error());
                ?>
                Security question 2: <select name="ques2">
                    <?php
                    for ($i = 0; $i < $rows; $i++):
                        $row = mysql_fetch_array($result);
                        ?>
                        <option value=<?php echo $row["ID"]?>><?php echo $row["Question"]?></option>
                        <?php
                    endfor;
                    ?>
                </select><br/>
                Answer 2: <input type="text" name="ans2"/><br/>
                <input type="submit" name="register" value="Submit"/>
            </form>
            <?php
        else:
            $password = crypt($password);
            $ans1 = crypt($ans1);
            $ans2 = crypt($ans2);
            $admin = 0;
            mysql_query("LOCK TABLES Users WRITE");
            mysql_query("INSERT INTO Users VALUE('$id','$password','$email','$ques1','$ans1','$ques2','$ans2',0,0)") or die("Invalid insert " . mysql_error());
            mysql_query("UNLOCK TABLES");
            echo "<p>You have been successfully registered.</p>";
        endif;
    else:
        $result = mysql_query("SELECT * FROM Questions") or die(mysql_error());
        $rows = mysql_num_rows($result);
        ?>
        <p>Please enter your information.</p><br/>
        <form id="regform"
            action="register.php"
            method="POST"
            onSubmit="return checkForm()">
            ID: <input type="text" name="id"/><br/>
            Password: <input type="password" name="password"/><br/>
            Email: <input type="text" name="email"/><br/><br/>
            Security question 1: <select name="ques1">
                <?php
                for ($i = 0; $i < $rows; $i++):
                    $row = mysql_fetch_array($result);
                    ?>
                    <option value=<?php echo $row["ID"]?>><?php echo $row["Question"]?></option>
                    <?php
                endfor;
                ?>
            </select><br/>
            Answer 1: <input type="text" name="ans1"/><br/><br/>
            <?php
            $result = mysql_query("SELECT * FROM Questions") or die(mysql_error());
            ?>
            Security question 2: <select name="ques2">
                <?php
                for ($i = 0; $i < $rows; $i++):
                    $row = mysql_fetch_array($result);
                    ?>
                    <option value=<?php echo $row["ID"]?>><?php echo $row["Question"]?></option>
                    <?php
                endfor;
                ?>
            </select><br/>
            Answer 2: <input type="text" name="ans2"/><br/>
            <input type="submit" name="register" value="Submit"/>
        </form>
        <?php
    endif;
    show_end();
    
    function show_header() {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>Lingo</title>
                <link rel="stylesheet" type="text/css" href="css/style.css" />
                <script type="text/javascript">
                    function checkForm() {
                        var form = document.getElementById("regform");
                        var fields = form.getElementsByTagName("input");
                        for (var i = 0; i < fields.length; i++) {
                            if (fields[i].value == "") {
                                alert("Please do not leave fields blank.");
                                fields[i].focus();
                                return false;
                            }
                        }
                        if (form.ques1.value == form.ques2.value) {
                            alert("Please do not select the same security questions.");
                            return false;
                        }
                        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9_]+.[a-zA-Z0-9._]+$/.test(form.email.value)) {
                            alert("Please enter a proper email.");
                            form.email.focus();
                            return false;
                        }
                        return true;
                    }
                </script>
            </head>
            <body><section class="main">
                    <header>Lingo</header>
        <?php
    }
    
    function show_end() {
        ?>
                <a href="login.php">Go back to login</a>
            </section></body>
        </html>
        <?php
    }
?>
