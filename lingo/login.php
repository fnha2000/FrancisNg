<?php
    session_start();
    $userinfo = $_COOKIE['Lingo'];
    include 'dbconnect.php';
    
    if (isset($_POST['pwdlogin'])):
        verify_password();
    elseif (isset($_POST['reglogin'])):
        login_user();
    endif;
	
	if (isset($_POST['pwdlogin'])):
        verify_password();
    elseif (isset($_POST['reglogin'])):
        login_user();
    endif;
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Lingo</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript">
		function redirect(target) {
			window.location = target + ".php";
		}
		
		function checkLogin() {
			var form = $("#loginform");
			var fields = $("#loginform input");
			for (var i = 0; i < fields.length; i++) {
				if (fields[i].value == "") {
					alert("Please do not leave any fields blank");
					fields[i].focus();
					return false;
				}
			}
			if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9_]+.[a-zA-Z0-9._]+$/.test(form.email.value)) {
				alert("Please enter a proper email");
				form.email.focus();
				return false;
			}
			return true;
		}
		
		function checkPwd() {
			var form = $("#pwlogin");
			if (form.password.value == "") {
				alert("Please enter your password");
				form.password.focus();
				return false;
			}
			return true;
		}
		</script>
    </head>
    
    <body>
    	<section class="main">
        <header>Lingo</header>
    	<?php 
		if (!$userinfo):
			?>
        <p style="color:RED;">NOTICE: This host does not support secure connections. This project is for demonstration purposes only, do not use the same password as for your important accounts.</p>
            <p>Welcome to Lingo!<br/>
            	If you are a returning user please enter your login information.<br/>
            	If this is your first visit, please click the register link.
            </p>
            <h3>Login</h3>
            <form id ="loginform"
                  action ="login.php"
                  method ="POST"
                  onSubmit="return checkLogin()">
                <table border="0" style="width:50%;margin:0px auto;">
                <tr><td>ID:</td> <td><input type="text" name="id" value=""/></td></tr>
                <tr><td>Password:</td> <td><input type="password" name="password" value=""/></td></tr>
                <tr><td>Email address:</td> <td><input type="text" name="email" value=""/></td></tr>
                </table>
                <input type="submit" name="reglogin" value="Submit"/>
            </form>
            <span class="link" onClick="redirect('register')">Register new user</span>
            <?php
		else:
			$name = $userinfo['id'];
			?>
              <p>Welcome back, <span style="font-weight:bold"><?php echo $name?></span>.<br/>Please enter your password.</p>
              <form id="pwlogin"
                  action="login.php"
                  method="POST"
                  onSubmit="return checkPwd()">
                  Password: <input type="password" name="password" value=""/><br/>
                  <input type="submit" name="pwdlogin" value="Submit"/>
              </form>
              <br/>
              <span class="link" onClick="redirect('forgotpw')">Forgot Password</span><br/>
              <form name="diffuser"
                  action="redirect.php"
                  method="POST">
                  <input type="submit" name="diffid" value="Different User"/><br/>
              </form>
            <?php
		endif;
		?>
        </section>
    </body>
</html>

<?php
	function verify_password() {
        global $userinfo;
        $password = $_POST['password'];
        $userid = $userinfo['id'];
        $result = mysql_query("SELECT Users.UserID, Users.Password FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
        $row = mysql_fetch_array($result);
        $matchpwd = $row["Password"];
        if (crypt($password, $matchpwd) == $matchpwd) {
            header("Location: lingo.php");
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
        $result = mysql_query("SELECT Users.UserID, Users.Password, Users.Email FROM Users WHERE Users.UserID='$userid'") or die(mysql_error());
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
                setcookie("Lingo[id]", $_POST['id'], time()+3600);
                setcookie("Lingo[email]", $_POST['email'], time()+3600);
                header("Location: lingo.php");
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