function displayTab(tabname) {
    var container = document.getElementById("container");
    var list = container.querySelector(".tabs ul");
    var current = list.getAttribute("current-tab");
    if (document.getElementById(current + "_tab") != null) {
        document.getElementById(current + "_tab").removeAttribute("class");
    }
    document.getElementById(current + "_content").style.display="none";
    var tab = document.getElementById(tabname + "_tab");
    tab.setAttribute("class","activetab");
    document.getElementById(tabname + "_content").style.display="block";
    list.setAttribute("current-tab",tabname);
    if (tabname == "search") {
        var oldTable = document.getElementById("resultTable");
        var resultPage = document.getElementById("search_content");
        if (oldTable != null) {
            resultPage.removeChild(oldTable);
        }
    }
    if (tabname == "admin") {
        var oldTable = document.getElementById("userTable");
        var resultPage = document.getElementById("admin_content");
        if (oldTable != null) {
            resultPage.removeChild(oldTable);
        }
    }
}

function showPage(pagename) {
	var container = document.getElementById("container");
	var contents = container.querySelectorAll(".tabcontent");
	for (var i = 0; i < contents.length; i++) {
		var id = contents[i].id.split("_")[0];
		if (id == pagename) {
			contents[i].style.display = "block";
		}
		else {
			contents[i].style.display = "none";	
		}
	}
	var list = container.querySelector(".tabs ul");
	var current = list.getAttribute("current-tab");
	if (document.getElementById(current + "_tab") != null) {
		document.getElementById(current + "_tab").removeAttribute("class");
	}
	list.setAttribute("current-tab",pagename);
}

function search(searchtype) {
    var form = document.getElementById("searchform");
    var query = form.query.value;
    if (searchtype == "search" && query == "") {
        alert("No query entered.");
        form.query.focus();
    }
    else {
        var httpRequest;
        if (window.XMLHttpRequest) {
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
            }
        }
        else if (window.ActiveXObject) {
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e) {}
            }
        }
        if (!httpRequest) {
            alert("Cannot create XMLHTTP instance");
        }
        var type = form.type.value;
        var data;
        if (searchtype == "search") {
            data = "op=search&type=" + type + "&value=" + query;
        }
        else if (searchtype == "mybooks") {
            data = "op=mybooks";
        }
        httpRequest.open('POST', 'search.php', true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                form.query.value = "";
                var result = eval(httpRequest.responseText);
                bookresults = result;
                buildResultTable();
            }
        };
        httpRequest.send(data);
    }
}

function buildResultTable() {
    var oldTable = document.getElementById("resultTable");
    var resultPage = document.getElementById("search_content");
    if (oldTable != null) {
        resultPage.removeChild(oldTable);
    }
    if (bookresults[0].id == -1) {
        var report = document.createElement('p');
        report.setAttribute('id', 'resultTable');
        var text = document.createTextNode("Sorry, the search did not find any matches.");
        report.appendChild(text);
        resultPage.appendChild(report);
    }
    else {
        var newTable = document.createElement('table');
        newTable.setAttribute('id','resultTable');
        resultPage.appendChild(newTable);
        var hrow = newTable.insertRow(0);
        var cell = document.createElement('th');
        var cellContents = document.createTextNode('ISBN');
        cell.appendChild(cellContents);
        hrow.appendChild(cell);
        cell = document.createElement('th');
        var link = document.createElement("span");
        link.setAttribute("class", "tablelink");
        link.setAttribute("onClick", "sort('subject')");
        cellContents = document.createTextNode('Subject(sort)');
        link.appendChild(cellContents);
        cell.appendChild(link);
        hrow.appendChild(cell);
        cell = document.createElement('th');
        link = document.createElement("span");
        link.setAttribute("class", "tablelink");
        link.setAttribute("onClick", "sort('author')");
        cellContents = document.createTextNode('Author(sort)');
        link.appendChild(cellContents);
        cell.appendChild(link);
        hrow.appendChild(cell);
        cell = document.createElement('th');
        link = document.createElement("span");
        link.setAttribute("class", "tablelink");
        link.setAttribute("onClick", "sort('title')");
        cellContents = document.createTextNode('Title(sort)');
        link.appendChild(cellContents);
        cell.appendChild(link);
        hrow.appendChild(cell);
        cell = document.createElement('th');
        cellContents = document.createTextNode('Owner');
        cell.appendChild(cellContents);
        hrow.appendChild(cell);
        cell = document.createElement('th');
        cellContents = document.createTextNode('Select');
        cell.appendChild(cellContents);
        hrow.appendChild(cell);
        for (var i = 0; i < bookresults.length; i++) {
            hrow = newTable.insertRow(i+1);
            cell = hrow.insertCell(0);
            cellContents = document.createTextNode(bookresults[i].isbn);
            cell.appendChild(cellContents);
            cell = hrow.insertCell(1);
            cellContents = document.createTextNode(bookresults[i].subject);
            cell.appendChild(cellContents);
            cell = hrow.insertCell(2);
            cellContents = document.createTextNode(bookresults[i].author);
            cell.appendChild(cellContents);
            cell = hrow.insertCell(3);
            cellContents = document.createTextNode(bookresults[i].title);
            cell.appendChild(cellContents);
            cell = hrow.insertCell(4);
            cellContents = document.createTextNode(bookresults[i].owner);
            cell.appendChild(cellContents);
            cell = hrow.insertCell(5);
            cellContents = document.createElement("input");
            cellContents.setAttribute('type', 'button');
            cellContents.setAttribute('value', 'Select');
            cellContents.setAttribute("onclick", "viewEntry(" + i + ")");
            cell.appendChild(cellContents);
        }
    }
}

function sort(type) {
    if (type == "author") bookresults.sort(by_author);
    else if (type == "subject") bookresults.sort(by_subject);
    else bookresults.sort(by_title);
    buildResultTable();
}

function viewEntry(index) {
    showPage("entry");
    var theTable = document.getElementById("entrytable");
    var newText = document.createTextNode(bookresults[index].isbn);
    var oldText = theTable.rows[0].cells[1].childNodes[0];
    theTable.rows[0].cells[1].replaceChild(newText, oldText);
    newText = document.createTextNode(bookresults[index].subject);
    oldText = theTable.rows[1].cells[1].childNodes[0];
    theTable.rows[1].cells[1].replaceChild(newText, oldText);
    newText = document.createTextNode(bookresults[index].author);
    oldText = theTable.rows[2].cells[1].childNodes[0];
    theTable.rows[2].cells[1].replaceChild(newText, oldText);
    newText = document.createTextNode(bookresults[index].title);
    oldText = theTable.rows[3].cells[1].childNodes[0];
    theTable.rows[3].cells[1].replaceChild(newText, oldText);
    newText = document.createTextNode(bookresults[index].owner);
    oldText = theTable.rows[4].cells[1].childNodes[0];
    theTable.rows[4].cells[1].replaceChild(newText, oldText);
    
    var form = document.getElementById("purchaseform");
    if (form.comments != null) {
        form.removeChild(form.comments);
    }
    if (form.buybutton != null) {
        form.removeChild(form.buybutton);
    }
    if (form.childNodes[0] != null) {
        form.removeChild(form.childNodes[0]);
    }
    
    if (isOwner(bookresults[index].owner) || isAdmin()) {
        var text = document.createTextNode("Edit entry");
        var link = document.createElement("span");
        link.setAttribute("class", "link");
        link.setAttribute("onClick", "editEntry(" + index + ")");
        link.appendChild(text);
        form.appendChild(link);
    }
    var br = document.createElement("br");
    form.appendChild(br);
    if (!isOwner(bookresults[index].owner)) {
        br = document.createElement("br");
        form.appendChild(br);
        var textbox = document.createElement("textarea");
        textbox.setAttribute('name', 'comments');
        textbox.setAttribute('rows', '5');
        textbox.setAttribute('cols', '30');
        var instruc = document.createTextNode("Enter your message here.");
        textbox.appendChild(instruc);
        form.appendChild(textbox);
        var button = document.createElement("input");
        button.setAttribute("name", "buybutton");
        button.setAttribute("type", "button");
        button.setAttribute("value", "Purchase");
        button.setAttribute("onClick", "purchase(" + index + ")");
        form.appendChild(button);
    }
}

function purchase(index) {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var form = document.getElementById("purchaseform");
    var message = form.comments.childNodes[0].nodeValue;
    var isbn = bookresults[index].isbn;
    var subject = bookresults[index].subject;
    var author = bookresults[index].author;
    var title = bookresults[index].title;
    var owner = bookresults[index].owner;
    var data = "isbn=" + isbn + "&subject=" + subject + "&author=" + author + "&title=" + title + "&owner=" + owner + "&message=" + message;
    httpRequest.open('POST','purchase.php',true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var response = httpRequest.responseText;
            if (response == "Success") {
                alert("Your purchase notification has been sent.");
            }
            else {
                alert("There was a problem sending the request. Please try again.");
            }
        }
    };
    httpRequest.send(data);
}

function editEntry(index) {
    showPage("edit");
    var form = document.getElementById("editform");
    if (form.deletelink != null) {
        form.removeChild(form.deletelink);
    }
    var isbn = bookresults[index].isbn;
    form.setAttribute("isbn", isbn);
    var subject = bookresults[index].subject;
    var author = bookresults[index].author;
    var title = bookresults[index].title;
    form.subject.value = subject;
    form.author.value = author;
    form.title.value = title;
    var button = document.createElement("span");
    button.setAttribute("name", "deletelink");
    button.setAttribute("class", "link");
    button.setAttribute("onClick", "deleteEntry(" + index + ")");
    var text = document.createTextNode("Delete entry");
    button.appendChild(text);
    form.appendChild(button);
    form.subject.focus();
}

function deleteEntry(index) {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var data = "op=delete" + "&id=" + bookresults[index].id;
    httpRequest.open('POST','bookops.php',true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var response = httpRequest.responseText;
            if (response == "Success") {
                displayTab("search");
                alert("The entry has been successfully deleted.");
            }
            else {
                alert("There was a problem deleting your entry. Please try again.");
            }
    	}
    };
    httpRequest.send(data);
}

function submitISBN() {
    var form = document.getElementById("isbnform");
    var isbn = form.isbn.value;
    if (isbn.length == 10 || isbn.length == 13) {
        var regex = new RegExp("/^[0-9]+&/");
        if (/^[0-9]+$/.test(isbn)) {
            var httpRequest;
            if (window.XMLHttpRequest) {
                httpRequest = new XMLHttpRequest();
                if (httpRequest.overrideMimeType) {
                        httpRequest.overrideMimeType('text/xml');
                }
            }
            else if (window.ActiveXObject) {
                try {
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {}
                }
            }
            if (!httpRequest) {
                alert("Cannot create XMLHTTP instance");
            }
            var data = "op=exists" + "&isbn=" + isbn;
            form = document.getElementById("bkdetailform");
            form.setAttribute("isbn", isbn);
            httpRequest.open('POST','search.php',true);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            showPage('bkdetail');
            httpRequest.onreadystatechange = function() {
                if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                    var response = eval(httpRequest.responseText);
                    if (response[0].isbn == -1) {
                        var fields = form.getElementsByTagName("input");
                        for (var i = 0; i < fields.length; i++) {
                            fields[i].value = "";
                        }
                        form.subject.focus();
                    }
                    else {
                        form.subject.value = response[0].subject;
                        form.author.value = response[0].author;
                        form.title.value = response[0].title;
                        form.subject.focus();
                    }
                }
            };
            httpRequest.send(data);
        }
        else {
            alert("Please enter only digits for the ISBN.");
            form.isbn.focus();
        }
    }
    else {
        alert("ISBN must be either 10 or 13 digits long.");
        form.isbn.focus();
    }
}

function processXML(httpRequest) {
    if (httpRequest.readyState == 4 && httpRequest.status == 200) {
        var root = httpRequest.responseXML.documentElement;
        var count = root.getElementsByTagName('BookList')[0].attributes.getNamedItem("total_results").value;
        showPage('bkdetail');
        var form = document.getElementById("bkdetailform");
        if (count < 1) {
            var httpRequest2;
            if (window.XMLHttpRequest) {
                httpRequest2 = new XMLHttpRequest();
                if (httpRequest2.overrideMimeType) {
                        httpRequest2.overrideMimeType('text/xml');
                }
            }
            else if (window.ActiveXObject) {
                try {
                    httpRequest2 = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        httpRequest2 = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {}
                }
            }
            if (!httpRequest2) {
                alert("Cannot create XMLHTTP instance");
            }
            var isbn = form.getAttribute("isbn");
            var data = "op=exists" + "&isbn=" + isbn;
            httpRequest2.open('POST','search.php',true);
            httpRequest2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest2.onreadystatechange = function() {
                if (httpRequest2.readyState == 4 && httpRequest2.status == 200) {
                    var response = eval(httpRequest2.responseText);
                    if (response[0].isbn == -1) {
                        var fields = form.getElementsByTagName("input");
                        for (var i = 0; i < fields.length; i++) {
                            fields[i].value = "";
                        }
                        form.subject.focus();
                    }
                    else {
                        form.subject.value = response[0].subject;
                        form.author.value = response[0].author;
                        form.title.value = response[0].title;
                        form.subject.focus();
                    }
                }
            }
            httpRequest2.send(data);
        }
        else {
            var isbn = root.getElementsByTagName("BookData")[0].attributes.getNamedItem("isbn").value;
            form.setAttribute("isbn",isbn);
            form.subject.value = "";
            var author = root.getElementsByTagName('AuthorsText')[0].childNodes[0];
            if (author != null) {
                form.author.value = author.nodeValue;
            }
            var title = root.getElementsByTagName('Title')[0].childNodes[0];
            if (title != null) {
                form.title.value = title.nodeValue;
            }
            form.subject.focus();
        }
    }
}

function submitDetails(op) {
    var form;
    if (op == "post") form = document.getElementById("bkdetailform");
    else if (op == "edit") form = document.getElementById("editform");
    var fields = form.getElementsByTagName("input");
    var noempty = true;
    for (var i = 0; i < fields.length; i++) {
        if (fields[i].value == "") {
            alert("Please do not leave any fields blank.");
            fields[i].focus();
            noempty = false;
            break;
        }
    }
    if (noempty) {
        var httpRequest;
        if (window.XMLHttpRequest) {
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                    httpRequest.overrideMimeType('text/xml');
            }
        }
        else if (window.ActiveXObject) {
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e) {}
            }
        }
        if (!httpRequest) {
            alert("Cannot create XMLHTTP instance");
        }
        var isbn = form.getAttribute("isbn");
        var subject = form.subject.value;
        var author = form.author.value;
        var title = form.title.value;
        var data = "op=" + op + "&isbn=" + isbn + "&subject=" + subject + "&author=" + author + "&title=" + title;
        httpRequest.open('POST','bookops.php',true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                var response = httpRequest.responseText;
                if (response == "Success") {
                    for (var i = 0; i < fields.length; i++) {
                        fields[i].value = "";
                    }
                    form.removeAttribute("isbn");
                    if (op == "post") alert("Your book has been successfully posted.");
                    else if (op == "edit") alert("The entry has been successfully updated.");
                }
                else {
                    if (op == "post") alert("There was an error posting your book. Please try again.");
                    else if (op == "edit") alert("There was an error updating your book. Please try again.");
                }
            }
        }
        httpRequest.send(data);
    }
}

function checkPwd() {
	var form = document.getElementById("chpwform");
	var pw1 = form.newpw.value;
	var pw2 = form.newpwver.value;
	if (pw1 != pw2) {
		var warning = document.getElementById("newpwalert");
		warning.innerHTML = "New passwords do not match.";
		return false;
	}
	else {
		var warning = document.getElementById("newpwalert");
		warning.innerHTML = "";
		return true;
	}
}

function checkPwForm() {
	var form = document.getElementById("chpwform");
	var fields = form.getElementsByTagName("input");
	var noempty = true;
	for (var i = 0; i < fields.length; i++) {
		if (fields[i].value == "") {
			alert("Please do not leave any fields blank.");
			fields[i].focus();
			noempty = false;
			break;
		}
	}
	if (noempty && checkPwd()) {
		var curpwd = form.curpw.value;
		var newpwd = form.newpw.value;
		submitPwd(curpwd, newpwd);
	}
}

function submitPwd(curpwd, newpwd) {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var data = "op=chpw&curpwd=" + curpwd + "&newpwd=" + newpwd;
    httpRequest.open('POST','changepw.php',true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var response = httpRequest.responseText;
            if (response == "WrongPassword") {
                alert("Your password is wrong.");
                var form = document.getElementById("chpwform");
                form.curpw.focus();
            }
            else if (response == "Success") {
                alert("Password successfully changed.");
                var form = document.getElementById("chpwform");
                var fields = form.getElementsByTagName("input");
                for (var i = 0; i < fields.length; i++) {
                    fields[i].value = "";
                }
            }
        }};
    httpRequest.send(data);
}

function viewUsers() {
    var oldTable = document.getElementById("userTable");
    var resultPage = document.getElementById("admin_content");
    if (oldTable != null) {
        resultPage.removeChild(oldTable);
    }
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var data = "op=users";
    httpRequest.open('POST','search.php',true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var response = eval(httpRequest.responseText);
            var oldTable = document.getElementById("userTable");
            var resultPage = document.getElementById("admin_content");
            if (oldTable != null) {
                resultPage.removeChild(oldTable);
            }
            var newTable = document.createElement("table");
            newTable.setAttribute('id','userTable');
            resultPage.appendChild(newTable);
            var hrow = newTable.insertRow(0);
            var cell = document.createElement("th");
            var cellContents = document.createTextNode("User ID");
            cell.appendChild(cellContents);
            hrow.appendChild(cell);
            cell = document.createElement("th");
            cellContents = document.createTextNode("Email");
            cell.appendChild(cellContents);
            hrow.appendChild(cell);
            cell = document.createElement("th");
            cellContents = document.createTextNode("Delete User");
            cell.appendChild(cellContents);
            hrow.appendChild(cell);
            cell = document.createElement("th");
            cellContents = document.createTextNode("Delete User's Books");
            cell.appendChild(cellContents);
            hrow.appendChild(cell);
            for (var i = 0; i < response.length; i++) {
                hrow = newTable.insertRow(i+1);
                cell = hrow.insertCell(0);
                cellContents = document.createTextNode(response[i].id);
                cell.appendChild(cellContents);
                cell = hrow.insertCell(1);
                cellContents = document.createTextNode(response[i].email);
                cell.appendChild(cellContents);
                cell = hrow.insertCell(2);
                cellContents = document.createElement("input");
                cellContents.setAttribute('type', 'button');
                cellContents.setAttribute('value', 'Delete user');
                cellContents.setAttribute("onclick", "adminDelete('user','" + response[i].id + "')");
                cell.appendChild(cellContents);
                cell = hrow.insertCell(3);
                cellContents = document.createElement("input");
                cellContents.setAttribute('type', 'button');
                cellContents.setAttribute('value', 'Delete user\'s books');
                cellContents.setAttribute("onclick", "adminDelete('userbooks','" + response[i].id + "')");
                cell.appendChild(cellContents);
            }
    	}
    };
    httpRequest.send(data);
}

function adminDelete(op, userid) {
    var verify, form;
    if (op == "user"){
        verify = confirm("Are you sure you want to delete the user " + userid + "?");
    }
    else if (op == "userbooks") {
        verify = confirm("Are you sure you want to delete all books posted by the user " + userid + "?");
    }
    else if (op == "books") {
        form = document.getElementById("deleteform");
        verify = confirm("Are you sure you want to delete all books with " + form.type.value + " " + form.delquery.value + "?");
    }
    if (verify) {
        var httpRequest;
        if (window.XMLHttpRequest) {
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
            }
        }
        else if (window.ActiveXObject) {
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e) {}
            }
        }
        if (!httpRequest) {
            alert("Cannot create XMLHTTP instance");
        }
        var data;
        if (op == "user" || op == "userbooks") {
            data = "op=" + op + "&id=" + userid;
        }
        else {
            data = "op=" + op + "&type=" + form.type.value + "&query=" + form.delquery.value;
        }
        httpRequest.open('POST','delete.php',true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                var response = httpRequest.responseText;
                if (response == "Success") {
                    if (op == "user" || op == "userbooks") viewUsers();
                    else alert("Entries successfully deleted");
                }
                else {
                    if (op == "books" && response == "Not found") {
                        alert(response);
                        //alert("There were no matches for the query you entered.");
                    }
                    else {
                        alert(response);
                        //alert("There was a problem with the request, please try again.");
                    }
                }
            }
        };
        httpRequest.send(data);
    }
}

function LogOut() {
    var httpRequest;
    if (window.XMLHttpRequest) {
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
        }
    }
    else if (window.ActiveXObject) {
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }
    if (!httpRequest) {
        alert("Cannot create XMLHTTP instance");
    }
    var data = "action=logout";
    httpRequest.open('POST','redirect.php',true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            location.reload(true);
    	}
    };
    httpRequest.send(data);
}

function isAdmin() {
    var container = document.getElementById("container");
    var list = container.querySelectorAll(".tabs ul li");
    if (list.length == 4) {
        return true;
    }
    else {
        return false;
    }
}

function isOwner(owner) {
    var user = document.getElementById("currentuser").childNodes[0].nodeValue;
    if (user == owner) {
        return true;
    }
    else {
        return false;
    }
}

function by_author(a, b) {
    if (a.author.toLowerCase() < b.author.toLowerCase()) return -1;
    else if (a.author.toLowerCase() == b.author.toLowerCase()) return 0;
    else return 1;
}

function by_title(a, b) {
    if (a.title.toLowerCase() < b.title.toLowerCase()) return -1;
    else if (a.title.toLowerCase() == b.title.toLowerCase()) return 0;
    else return 1;
}

function by_subject(a, b) {
    if (a.subject.toLowerCase() < b.subject.toLowerCase()) return -1;
    else if (a.subject.toLowerCase() == b.subject.toLowerCase()) return 0;
    else return 1;
}