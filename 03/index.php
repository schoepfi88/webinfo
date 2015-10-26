<?php
include('login.php');
include('db.php');

if($_GET['action'] == 'delete') {
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "DELETE FROM entry WHERE entry_id = ".$_GET['index'];
	
	if ($conn->query($sql) === TRUE) {
		$error = "Entry deleted successfully";
			
	} else {
		$error = "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>My Blog</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/theme.css">
        <script language="javascript" type="text/javascript" src="script/control.js"></script>
    </head>

    <body onload="hideFunctions()">
        <div id="menu">
            <ul id="menubar">
                <li><a href="/">Home</a></li>
                <li><a href="new.php">Create Entry</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/loginn.php">Login</a></li>
            </ul>
        </div>

        <h1 class="header1">My Blog</h1>
        <br>
        <br>
        <?php

		include('db.php');
		$session_id = session_id();
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT entry_id, reporter, subject, 
		content,created_at FROM entry WHERE  session_id='$session_id' order by created_at desc";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			echo "<table class=\"tableHead\">";
			echo "<tr>";
			echo "<td class=\"reporter\">".$row["reporter"]."</td>";
			echo "<td class=\"subject\">".$row["subject"]."</td>";
			echo "<td class=\"time\">".$row["created_at"]."</td>";
			echo "</tr>";
			echo"</table>";
			echo"<table class=\"tableBody\">";
			echo"<tr>";
			$string =$row["content"];
			$string = (strlen($string) > 25) ? substr($string,0,20).'...' : $string;
			echo"<td class=\"content\">".$string."</td>";
			echo"<td><a id = \"del\" name = \"del\" href=\"/index.php?action=delete&index=".$row["entry_id"]."\"> Delete </a>";
			echo"<a id = \"more\" href=\"/entry.php?action=more&index=".$row["entry_id"]."\"> More </a>";
			echo"</td></tr></table>";
			echo "<p>";
		}
		$conn->close();
		?>
    </body>

    </html>