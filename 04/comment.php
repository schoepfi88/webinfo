<?php
	include('parseHtml.php');
	include('db.php');
	include('checkPrivileges.php');
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	if (isset($_COOKIE['login'])){
		$priv = $_COOKIE['login'];
	} else {
		$priv = "0";
	}
	if (isset($_COOKIE["PHPSESSID"])){
		$sessionid = $_COOKIE["PHPSESSID"];
	} else {
		$sessionid = "0";
	}

	$sqlcheck = "SELECT priv FROM authorize WHERE session_id ='$sessionid' AND priv = '$priv'";
	$resultcheck = $conn->query($sqlcheck);
	$rowcheck = $resultcheck->fetch_assoc();
	if ($resultcheck->num_rows > 0){
		// priv must be greater than 2
		if ($rowcheck['priv'] > 2){
			if ($_POST['action'] == "create"){
				$id = explode("#", $_POST['id'])[0];		// if anchor stands behind the id
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
		} else {
			echo "405";
		}
		
		// priv must be greater than 7
		if ($rowcheck['priv'] > 7){
			if ($_GET['action'] == "delete"){
				$id = $_GET['id'];
				$sql = "DELETE from comment WHERE comment_id = '$id'";
				$result = $conn->query($sql);
				echo "Comment with ID: ".$id." successfully deleted";
			}
		} else {
			echo "405";
		}
	}

	$conn->close();
?>