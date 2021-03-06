<?php
	include('login.php');

	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "blog";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	if (isset($_POST['submit'])){
		$reporter=$_POST['username'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
		$session_id = session_id();
		
    	$sql = "INSERT INTO entry (session_id, reporter, subject, content) VALUES ('$session_id', '$reporter', '$subject', '$content')";
	
		if ($conn->query($sql) === TRUE) {
			$error = "New entry created successfully";
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
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

	<h1>Create Entry</h1>
	<br>
	<div id="entry">
			<form id="form1" action="" method="post">
				<table id="formtable">
				<tr>
					<td>User</td>
					<td>
						<input id="name" name="username" placeholder="username" type="text">
					</td>
				</tr>
				<tr>
					<td>Subject</td>
					<td>
						<input id="subject" name="subject" placeholder="subject" type="text">
					<td>
				</tr>
				<tr>
					<td>Content</td>
					<td>
						<textarea id="textarea" name="content" placeholder="Blog bla bla.." cols="50" rows="10" form="form1"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input id="submit" name="submit" type="submit" value="Create">
						<a id = "back" href="/">Back</a>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div class="feedback">
							<?php echo $error; ?>
						</div>
					</td>
				</tr>
				</table>
			</form>
		</div>
</body>
</html>