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
			echo "New entry created successfully";
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Blog Entry</title>
</head>
<body>

<h1>Create Entry</h1>
<div id="entry">
	<form action="" method="post">
	<label>Reporter :</label>
	<input id="name" name="username" placeholder="username" type="text">
	<label>Subject :</label>
	<input id="subject" name="subject" placeholder="subject" type="text">
	<label>Content :</label>
	<input id="content" name="content" placeholder="content" type="text">
	<input name="submit" type="submit" value=" Create ">
	<span><?php echo $error; ?></span>
</form>

</div>
</body>
</html>