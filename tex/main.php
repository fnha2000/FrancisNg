<?php
    session_start();
    $session = $_SESSION['status'];
    $userinfo = $_COOKIE['TextExchange'];
    include 'dbconnect.php';
    
    if (!$userinfo) header("Location: login.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>TextExchangeV3</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript" src="js/scripts.js"></script>
    </head>
    <body><section class="main">
        <header>TextExchangeV3</header>
        <section id="container">
            <div class="tabs">
                <ul>
                    <li id="main_tab" onClick="displayTab('main')">Main</li>
                    <li id="post_tab" onClick="displayTab('post')">Post</li>
                    <li id="search_tab" onClick="displayTab('search')">Search</li>
                    <?php 
                    if ($_SESSION['admin'] == 1):
                    ?>
                    <li id="admin_tab" onClick="displayTab('admin')">Admin</li>
                    <?php
                    endif;
                    ?>
                </ul>
            </div>
            <div class="contents">
                <section class="tabcontent" id="main_content">
                    <h3 id="currentuser"><?php echo $userinfo['id']?></h3>
                    <span class="link" onClick="showPage('chpw')">Change password</span><br/>
                    <span class="link" onClick="LogOut()">Log out</span><br/>
                </section>
                <section class="tabcontent" id="post_content">
                    <p>Please enter the ISBN of your book.</p>
                    <form id="isbnform">
                        <input type="text" name="isbn" value=""/>
                        <span class="link" onClick="submitISBN()">Submit</span>
                    </form>
                </section>
                <section class="tabcontent" id="search_content">
                    <form id="searchform">
                        <select name="type">
                            <option value="ISBN">ISBN</option>
                            <option value="Subject">Subject</option>
                            <option value="Author">Author</option>
                            <option value="keyword">Keyword</option>
                        </select>
                        <input type="text" name="query" value=""/><br/>
                        <span class="link" onClick="search('search')">Search</span><br/><br/>
                        <span class="link" onClick="search('mybooks')">Show my books</span>
                    </form>
                </section>
                <?php
                if ($_SESSION['admin'] == 1):
                ?>
                <section class="tabcontent" id="admin_content">
                    <span class="link" onClick="viewUsers()">View user accounts</span><br/><br/>
                    <form id="deleteform">
                        <select name="type">
                            <option value="Author">Author</option>
                            <option value="keyword">Keyword</option>
                        </select>
                        <input type="text" name="delquery" value=""/>
                        <span class="link" onClick="adminDelete('books','')">Delete books</span><br/>
                    </form>
                </section>
                <?php
                endif;
                ?>
                <section class="tabcontent" id="chpw_content">
                    <form id="chpwform">
                        <span class="alert" id="newpwalert"></span><br/>
                        Current password: <input type="password" name="curpw" value=""/><br/>
                        New password: <input type="password" name="newpw" value=""/><br/>
                        Re-enter new password: <input type="password" name="newpwver" value="" onBlur="checkPwd()"/><br/>
                        <span class="link" onClick="checkPwForm()">Submit</span>
                    </form>
                </section>
                <section class="tabcontent" id="bkdetail_content">
                    <form id="bkdetailform">
                    	Subject: <input type="text" name="subject" value=""/><br/>
                        Author: <input type="text" name="author" value=""/><br/>
                        Title: <input type="text" name="title" value=""/><br/>
                        <span class="link" onClick="submitDetails('post')">Submit</span>
                    </form>
                </section>
                <section class="tabcontent" id="entry_content">
                    <h3>You have selected:</h3>
                    <table id="entrytable">
                        <tr><th>ISBN</th><td name="isbn">null</td></tr>
                        <tr><th>Subject</th><td name="subject">null</td></tr>
                        <tr><th>Author</th><td name="author">null</td></tr>
                        <tr><th>Title</th><td name="title">null</td></tr>
                        <tr><th>Owner</th><td name="owner">null</td></tr>
                    </table>
                    <form id="purchaseform"></form>
                </section>
                <section class="tabcontent" id="edit_content">
                    <h3>Edit entry:</h3>
                    <form id="editform">
                    	Subject: <input type="text" name="subject" value=""/><br/>
                        Author: <input type="text" name="author" value=""/><br/>
                        Title: <input type="text" name="title" value=""/><br/>
                        <span class="link" onClick="submitDetails('edit')">Submit</span><br/>
                    </form>
                </section>
            </div>
        </section>
    </section>
    <script type="text/javascript">
		var bookresults;
        window.onload = function() {
            var container = document.getElementById("container");
            var tabs = container.querySelectorAll(".tabs ul li");
            var id = tabs[0].id.split("_")[0];
            tabs[0].parentNode.setAttribute("current-tab",id);
            tabs[0].setAttribute("class","activetab");
            var contents = container.querySelectorAll(".tabcontent");
            contents[0].style.display="block";
            for (var i = 1; i < contents.length; i++) {
                contents[i].style.display="none";
            }
        }
    </script>
    </body>
</html>
