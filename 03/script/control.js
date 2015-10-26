function hideFunctions(){
	console.log("hide");
	var priv = readCookie('login');
	if (priv == null){
		priv = 1;
	}
	console.log(priv);
	// not delete (only admin)
	if (priv < 14){
		var delButtons = document.getElementsByName("del");
		for (var i = delButtons.length - 1; i >= 0; i--) {
			hideElement(delButtons[i]);
		};
	}
	// show logout
	if (priv > 6){
		var menubar = document.getElementById("menubar");
		menubar.innerHTML = "<li><a href=\"/\">Home</a></li>" +
		"<li><a href=\"new.php\">Create Entry</a></li>" +
		"<li><a href=\"/\">About</a></li>" +
		"<li><a onclick=\"logout()\">Logout</a></li>";
	}

	// not post (only admin and author)
	if (priv < 6 && priv >1){
		var menubar = document.getElementById("menubar");
		menubar.innerHTML = "<li style=\"width: 33%\"><a href=\"/\">Home</a></li>" +
		"<li style=\"width: 33%\"><a href=\"/\">About</a></li>" +
		"<li style=\"width: 34%\"><a onclick=\"logout()\">Logout</a></li>";
	}
	// not comment for guest
	if (priv == 1){
		var commentButton = document.getElementById("toggle");
		if (commentButton != null)
			hideElement(commentButton);
	}

	if (priv == 1){
		var menubar = document.getElementById("menubar");
		menubar.innerHTML = "<li style=\"width: 33%\"><a href=\"/\">Home</a></li>" +
		"<li style=\"width: 33%\"><a href=\"/\">About</a></li>" +
		"<li style=\"width: 34%\"><a href=\"/loginn.php\">Login</a></li>";
	}


}

function login(){
	var user = document.getElementById('username').value;
	var pw = document.getElementById('password').value;
    var hr = new XMLHttpRequest();
	var url = "loginn.php";
    var vars = "action=login&user=" + user + "&password=" + pw;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function () {
		if (hr.readyState == 4 && hr.status == 200) {
			var privilege = parseInt(hr.responseText);
			console.log(privilege);
			createCookie('login', privilege, 30);
			location.href = "index.php";
		}
	}
    hr.send(vars);

}

function createCookie(name,priv,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name +"="+priv+expires+"; path=/";
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' '){
        	c = c.substring(1,c.length);
        	if (c.indexOf(nameEQ) == 0) 
        		return c.substring(nameEQ.length,c.length);
        }
    }
    return null;
}

function toggleVisibility() {
    var commentDiv = document.getElementById('comment');
    if (commentDiv.style.visibility == 'visible')
        commentDiv.style.visibility = 'hidden';
    else
        commentDiv.style.visibility = 'visible';
}

function comment() {
    var name = document.getElementById('name').value;
    var text = document.getElementById('textarea').value;
    var id = document.location.href.toString().split("&")[1].split("=")[1]; // parse index from url 
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var url = "comment.php";
    var vars = "action=create&id=" + id + "&name=" + name + "&text=" + text;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function () {
            if (hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                console.log(return_data);
                // parse response
                var comment_id = return_data.split("#?#")[0];
                var reporter = return_data.split("#?#")[1];
                var time = return_data.split("#?#")[3];
                var text = return_data.split("#?#")[2];


                // head
                var table = document.createElement("TABLE");
                table.setAttribute("class", "tableHead");
                table.setAttribute("id", "commHead" + comment_id);
                var tr = document.createElement("TR");
                var td1 = document.createElement("TD");
                var td2 = document.createElement("TD");
                td1.setAttribute("class", "reporter");
                td2.setAttribute("class", "time");
                td1.innerHTML = reporter;
                td2.innerHTML = time;
                tr.appendChild(td1);
                tr.appendChild(td2);
                table.appendChild(tr);
                document.getElementById('comments').appendChild(table);

                // body
                table = document.createElement("TABLE");
                table.setAttribute("class", "tableBody");
                table.setAttribute("id", "commBody" + comment_id);
                tr = document.createElement("TR");
                td1 = document.createElement("TD");
                td2 = document.createElement("TD");
                td1.setAttribute("class", "content");
                td1.innerHTML = text;
                var delButton = document.createElement("BUTTON");
                delButton.setAttribute("onclick", "deleteComment("+comment_id+")");
                delButton.setAttribute("type", "button");
                delButton.setAttribute("name", "del");
                delButton.innerHTML = "Delete";
                td2.appendChild(delButton);
                tr.appendChild(td1);
                tr.appendChild(td2);
                table.appendChild(tr);
                document.getElementById('comments').appendChild(table);

                // br
                var br = document.createElement("BR");
                document.getElementById('comments').appendChild(br);
                hideFunctions();
            }
        }
        // Send the data to PHP
    hr.send(vars);
    clear();
}

function deleteComment(id) {
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var url = "comment.php";
    var vars = "action=delete&id=" + id;
    console.log(vars);
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function () {
            if (hr.readyState == 4 && hr.status == 200) {
                var response = hr.responseText;
                hideElement(document.getElementById("commHead" + response));
                hideElement(document.getElementById("commBody" + response));
            }
        }
        // Send the data to PHP
    hr.send(vars);
    clear();
}

function aTag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<a href=\" URL \"> NAME </a>" + afterCursor;
}

function bTag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<b> TEXT </b>" + afterCursor;
}

function iTag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<i> TEXT </i>" + afterCursor;
}

function fontSizeTag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<font size=\"SIZE\"> TEXT </font>" + afterCursor;
}

function uTag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<u> TEXT </u>" + afterCursor;
}

function h1Tag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<h1> TEXT </h1>" + afterCursor;
}

function h2Tag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<h2> TEXT </h2>" + afterCursor;
}

function h3Tag() {
    var cursorPos = document.getElementById("textarea").selectionStart;
    var currentValue = document.getElementById("textarea").value;
    var beforCursor = currentValue.substring(0, cursorPos);
    var afterCursor = currentValue.substring(cursorPos, currentValue.lenght);
    document.getElementById("textarea").value = beforCursor + "<h3> TEXT </h3>" + afterCursor;
}

function clear() {
    document.getElementById('name').value = "";
    document.getElementById('textarea').value = "";
}

function hideElement(elem){
	elem.style.display = "block";
    elem.style.lineHeight = 0;
    elem.style.height = 0;
    elem.style.overflow = "hidden";
    elem.style.border = 0;
    elem.style.margin = 0;
    elem.style.width = 0;
    elem.style.padding = 0;
}

function logout(){
	console.log("logout");
	eraseCookie("login");
	location.href = "/";
}