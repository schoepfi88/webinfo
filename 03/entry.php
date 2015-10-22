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
			echo"<button onclick=\"toggleVisibility()\"> Comment </button>";
			echo"</tr></table>";
			echo "<p>";
		}
	}
	
	$conn->close();
	?>

	<div id="comments" class="comments">
		<br>
		<h2> Comments </h2>
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
			$sql = "SELECT comment_id, reporter, text, created_at FROM comment WHERE entry_id=".$_GET['index']; 
			$result = $conn->query($sql);
			
			while($row = $result->fetch_assoc()){
				echo "<table class=\"tableHead\">";
				echo "<tr>";
				echo "<td class=\"reporter\">".$row["reporter"]."</td>";
				echo "<td class=\"time\">".$row["created_at"]."</td>";
				echo "</tr>";
				echo"</table>";
				echo"<table class=\"tableBody\">";
				echo"<tr>";
				$string =$row["text"];
				echo"<td class=\"content\">".$string."</td>";
				echo"<td><button onclick=\"deleteComment(".$row["comment_id"].")\">Delete</button>";
				echo"</td></tr></table>";
				echo "<p>";
			}
		}
		
		$conn->close();
		?>
	</div>

	<div id="comment">
			<table id="formtable">
			<tr>
				<td>User</td>
				<td>
					<input id="name" name="username" placeholder="username" type="text">
				</td>
			</tr>
			<tr>
				<td>Comment</td>
				<td>
					<textarea id="textarea" name="content" placeholder="Blog bla bla.." cols="50" rows="5" form="form1"></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button id="submit" onclick="comment()">Comment</button>
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
	</div>



	</body>
</html>