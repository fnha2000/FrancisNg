<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    if (isset($_POST['pwdlogin'])):
        verify_password();
    elseif (isset($_POST['reglogin'])):
        login_user();
    endif;

    if (!$userinfo):
        show_header();
        ?>
        <p style="color:RED;">NOTICE: This host does not support secure connections. This project is for demonstration purposes only, do not use the same password as for your important accounts.</p>
        <p>Welcome to TextExchange!<br/>
            If you are a returning user please enter your login information.<br/>
            If this is your first visit, please click the register link.
        </p>
        <h3 id="loginlabel">Login</h3>
        <form name ="loginform"
              action ="login.php"
              method ="POST">
            ID: <input type="text" name="id"/><br/>
            Password: <input type="password" name="password"/><br/>
            Email address: <input type="text" name="email"/><br/>
            <input type="submit" name="reglogin" value="Submit"/>
        </form>
        <a href="register.php">Register new user</a>
        <?php
    elseif ($userinfo):
        $name = $userinfo['id'];
        show_header();
        ?><p><?php echo "Welcome back, $name.";?></p>
        <p>Please enter your password.</p>
        <form name="pwlogin"
            action="login.php"
            method="POST">
            Password: <input type="password" name="password"/><br/>
            <input type="submit" name="pwdlogin" value="Submit"/>
        </form>
        <form name="forgotpwd"
            action="forgotpw.php"
            method="POST">
            <input type="submit" name="forgotpw" value="Forgot Password"/><br/>
        </form>
        <form name="diffuser"
            action="redirect.php"
            method="POST">
            <input type="submit" name="diffid" value="Different User"/><br/>
        </form>
        <?php
    endif;
    
    function show_header() {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>TextExchangeV3</title>
                <link rel="stylesheet" type="text/css" href="css/style.css" />
            </head>
            <body><section class="main">
                    <header>TextExchangeV3</header>
        <?php
    }
    
    function show_end() {
        ?>
            </section></body>
        </html>
        <?php
    }

    function verify_password() {
        global $userinfo;
        $password = $_POST['password'];
        $userid = $userinfo['id'];
        $result = mysql_query("SELECT Users.UserID, Users.Password, Users.Administrator FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
        $row = mysql_fetch_array($result);
        $matchpwd = $row["Password"];
        if (crypt($password, $matchpwd) == $matchpwd) {
            $_SESSION['admin'] = $row['Administrator'];
            header("Location: main.php");
            exit;
        }
        else {
            $_SESSION['status'] = "wrongpwd";
            header("Location: redirect.php");
            exit;
        }
    }

    function login_user() {
        $userid = $_POST['id'];
        $result = mysql_query("SELECT Users.UserID, Users.Password, Users.Email, Users.Administrator FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
        if (mysql_num_rows($result) == 0):
            $_SESSION['status'] = "idnotexist";
            header("Location: redirect.php");
            exit;  
        else:
            $password = $_POST['password'];
            $email = $_POST['email'];
            $row = mysql_fetch_array($result);
            $matchpwd = $row["Password"];
            $password = crypt($password,$matchpwd);
            if ($password == $matchpwd && strcmp($email,$row["Email"]) == 0) {
                setcookie("TextExchange[id]", $_POST['id'], time()+3600);
                setcookie("TextExchange[email]", $_POST['email'], time()+3600);
                $_SESSION['admin'] = $row['Administrator'];
                header("Location: main.php");
                exit;
            }
            elseif ($password != $matchpwd) {
                $_SESSION['status'] = "wrongpwd";
                header("Location: redirect.php");
                exit;
            }
            else {
                $_SESSION['status'] = "wrongemail";
                header("Location: redirect.php");
                exit;
            }
                
        endif;
    }
?>
