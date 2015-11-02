<?php
include('db.php');
$error ="";
$isSearch = false;
if(@$_GET['action'] == 'delete') {
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
        // priv must be greater than 7
        if ($rowcheck['priv'] > 7){
			$sql = "DELETE FROM entry WHERE entry_id = ".$_GET['index'];
			
			if ($conn->query($sql) === TRUE) {
				$error = "Entry deleted successfully";
					
			} else {
				$error = "Error: " . $sql . "<br>" . $conn->error;
			}
		} else {
			$error = "Error: Entry not deleted - Privileges are insufficient";
		}
	} else {
		$error = "Error: Entry not deleted - Privileges are insufficient";
	}
}



if (isset($_POST['submit'])){
    
    
    $keyword=$_POST['search'];
    $isSearch=true;

    
    header("url=index.php");

}




?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>My Blog</title>

        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <script language="javascript" type="text/javascript" src="/script/control.js"></script>
    </head>

    <body onload="hideFunctions()">
        <div id="menu">
            <ul id="menubar">
                <li><a href="/">Home</a></li>
                <li><a href="/new.php">Create Entry</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/login.html">Login</a></li>
            </ul>
        </div>
        <?php
        
        if($isSearch == false){
            echo "<h1 class=\"header1\">My Blog</h1>";
        }else{
           echo "<h1 class=\"header1\">Search:$keyword</h1>";
        }
        
        ?>

            <br>
            <form id="searchForm" method="post">
                <input class="subject" name="search" type="text" placeholder="Keyword.." required>
                <input id="submit" name="submit" type="submit" value="Search">

            </form>
            <div class="feedback" id="feed" style="text-align: center;">
                <?php echo $error;?>
            </div>
            <br>
            <?php

		include('db.php');
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
        if($isSearch == false){
            $sql = "SELECT entry_id, reporter, subject, 
		content, keyword, created_at FROM entry order by created_at desc";
        }else{
            $sql =  "SELECT entry_id, reporter, subject, content, keyword, created_at FROM entry WHERE keyword = '$keyword' order by created_at desc";
        }
    
        
		
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
            echo"<td>#".$row["keyword"]."</td>";
			echo"<td><a class = \"del\" name = \"del\" href=\"/api/entry/delete/".$row["entry_id"]."\"> Delete </a>";
			echo"<a id = \"more\" href=\"/api/entry/more/".$row["entry_id"]."\"> More </a>";
			echo"</td></tr></table>";
			echo "<p>";
		}
		$conn->close();
		?>
    </body>

    </html>