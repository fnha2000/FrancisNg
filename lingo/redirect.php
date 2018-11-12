<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['Lingo'];
    include 'dbconnect.php';
    
    $action = $_POST["action"];
    if (strcmp($action,"logout") == 0):
        unset($_SESSION['status']);
        session_destroy();
        setcookie("Lingo[id]", $userinfo['id'], time()-600);
        setcookie("Lingo[email]", $userinfo['email'], time()-600);
        header("Location: login.php");
        exit;
    elseif (isset($_POST['diffid'])):
        setcookie("Lingo[id]", $_POST['id'], time()-600);
        setcookie("Lingo[email]", $_POST['email'], time()-600);
        header("Location: login.php");
        exit;
    elseif (strcmp($_SESSION['status'], "idnotexist") == 0):
        $_SESSION['status'] = "";
        show_header();
        ?>
        <p>Sorry, that ID does not exist.</p>
        <?php
        show_end();
        exit;
    elseif (strcmp($_SESSION['status'], "wrongpwd") == 0):
        $_SESSION['status'] = "";
        show_header();
        ?>
        <p>Sorry, you entered the wrong password.</p>
        <?php
        show_end();
        exit;
    elseif (strcmp($_SESSION['status'], "wrongemail") == 0):
        $_SESSION['status'] = "";
        show_header();
        ?>
        <p>Sorry, you entered the wrong email.</p>
        <?php
        show_end();
        exit;
    endif;
    
    function show_header() {
        ?>
        <!DOCTYPE HTML>
        <html>
            <head>
                <title>Lingo</title>
                <link rel="stylesheet" type="text/css" href="css/style.css" />
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
    
    function show_end2() {
        ?>
                <a href="register.php">Go back to register</a>
            </section></body>
        </html>
        <?php
    }
?>
