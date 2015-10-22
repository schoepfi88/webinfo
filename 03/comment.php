<?php

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

	$id = $_POST['id'];
	$name = $_POST['name'];
	$text = $_POST['text'];

	$sql = "INSERT into comment (entry_id, reporter, text) values ($id, '$name' , '$text')";
	$result = $conn->query($sql);

	// TODO
	//if (result != true)
	//	return fail
	
	$sql1 = "SELECT comment_id, created_at, reporter, text from comment where entry_id = '$id' ORDER BY comment_id desc LIMIT 1";
	$result1 = $conn->query($sql1);
	$test = "";
	while($row = $result1->fetch_assoc()){
		$test = $test . $row['comment_id'] . "#?#" . $row['reporter']  . "#?#" . $row['text'] . "#?#" . $row['created_at'];
	}
	echo $test;

	$conn->close();
?>