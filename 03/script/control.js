function toggleVisibility () {
	var commentDiv = document.getElementById('comment');
	if (commentDiv.style.visibility == 'visible')
		commentDiv.style.visibility='hidden';
	else 
		commentDiv.style.visibility='visible';
}

function comment () {
	var name = document.getElementById('name').value;
	var text = document.getElementById('textarea').value;
	var id = document.location.href.toString().split("&")[1].split("=")[1];			// parse index from url 
	// Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var url = "comment.php";
    console.log(url);
    var vars = "id="+id+"&name="+name+"&text="+text;
    console.log(vars);
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
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
			tr = document.createElement("TR");
			td1 = document.createElement("TD");
			td2 = document.createElement("TD");
			td1.setAttribute("class", "text");
			td1.innerHTML = text;
			var delButton = document.createElement("BUTTON");
			delButton.setAttribute("onclick", "deleteComment()");
			delButton.innerHTML = "Delete";
			td2.appendChild(delButton);
			tr.appendChild(td1);
			tr.appendChild(td2);
			table.appendChild(tr);
			document.getElementById('comments').appendChild(table);
			
			// br
			var br = document.createElement("BR");
			document.getElementById('comments').appendChild(br);
	    }
    }
    // Send the data to PHP
    hr.send(vars);
    
}
