<?php
	session_start();// Starting Session
	include('db.php');
	header('Content-type: application/json');
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$post = file_get_contents('php://input');
		$data = json_decode($post);
		$reporter= $data->user;
		$password= $data->password;
		$sql ="SELECT privilege FROM user WHERE  name='$reporter' AND password='$password'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$priv = $row["privilege"];
			$session_id = session_id();
			$sql = "SELECT priv FROM authorize WHERE session_id ='$session_id' AND priv = '$priv' LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows == 0){
				$sql = "INSERT INTO authorize (session_id, priv) VALUES ('$session_id', '$priv')";
				$result = $conn->query($sql);
			}
			echo json_encode(array('priv' => $priv));
		} else {
			$error = "login fail";
			echo json_encode(array('priv' => 1 ));
		}
	}
?>