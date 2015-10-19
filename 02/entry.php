<?php
include('login.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My Blog</title>
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<script language="javascript" type="text/javascript" src="script/control.js"></script>
	</head>

	<body>
	<div id="menu">
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="new.php">Create Entry</a></li>
			<li><a href="/">About</a></li>
		</ul>
	</div>

	<h1>My Blog</h1>
	<br>
	<br>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "blog";
	
	$session_id = session_id();
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	if($_GET['action'] == 'more') {
		$sql = "SELECT entry_id, reporter, subject, content, created_at FROM entry WHERE entry_id=".$_GET['index']; 
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
			echo"<td class=\"content\">".$string."</td>";
			echo"<td><a id = \"del\" href=\"/index.php?action=delete&index=".$row["entry_id"]."\"> Delete </a>";
			echo"</tr></table>";
			echo "<p>";
		}
	}
	
	$conn->close();
	?>
	</body>
</html>