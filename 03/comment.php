<?php
	include('parseHtml.php');
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
	if ($_POST['action'] == "create"){
		$name = $_POST['name'];
		$text = $_POST['text'];

		$name = eliminateHtml($name);
		$text = parseContent($text);

		$sql = "INSERT into comment (entry_id, reporter, text) values ($id, '$name' , '$text')";
		$result = $conn->query($sql);
		
		$sql1 = "SELECT comment_id, created_at, reporter, text from comment where entry_id = '$id' ORDER BY comment_id desc LIMIT 1";
		$result1 = $conn->query($sql1);
		$response = "";
		while($row = $result1->fetch_assoc()){
			$response = $response . $row['comment_id'] . "#?#" . $row['reporter']  . "#?#" . $row['text'] . "#?#" . $row['created_at'];
		}
		echo $response;
	}

	if ($_POST['action'] == "delete"){
		$sql = "DELETE from comment WHERE comment_id = '$id'";
		$result = $conn->query($sql);
		echo $id;
	}

	$conn->close();
?>