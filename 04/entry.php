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
                <li><a href="/api/entry/create">Create Entry</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/login.html">Login</a></li>
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
				echo"<td><a id = \"del\" name=\"del\" href=\"/index.php?action=delete&index=".$row["entry_id"]."\"> Delete </a>";
				echo"<button id=\"toggle\" type=\"button\" onclick=\"toggleVisibility(".$row["entry_id"].")\"> Comment </button>";
				echo"</tr></table>";
				echo "<p>";
			}
		}
		
		$conn->close();
		?>

        <div id="comments" class="comments">
            <?php
			include('db.php');
			$session_id = session_id();
			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			
			if($_GET['action'] == 'more') {
                echo "<br>";
                echo "<h2 class=\"header2\"> Comments </h2>";
                echo "<br>";    
				$sql = "SELECT comment_id, reporter, text, created_at FROM comment WHERE entry_id=".$_GET['index']; 
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()){
					echo "<table class=\"tableHead\" id=\"commHead".$row["comment_id"]."\">";
					echo "<tr>";
					echo "<td class=\"reporter\">".$row["reporter"]."</td>";
					echo "<td class=\"time\">".$row["created_at"]."</td>";
					echo "</tr>";
					echo"</table>";
					echo"<table class=\"tableBody\" id=\"commBody".$row["comment_id"]."\">";
					echo"<tr>";
					$string =$row["text"];
					echo"<td class=\"content\">".$string."</td>";
					echo"<td><button type=\"button\" name=\"del\" onclick=\"deleteComment(".$row["comment_id"].")\">Delete</button>";
					echo"</td></tr></table>";
				}
			}
			
			$conn->close();
			?>
        </div>

        <div id="comment">
            <br>
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
                        <button class="tags" type="button" onclick="bTag()">bold</button>
                        <button class="tags" type="button" onclick="iTag()">cursiv</button>
                        <button class="tags" type="button" onclick="aTag()">link</button>
                        <button class="tags" type="button" onclick="uTag()">underline</button>
                        <button class="tags" type="button" onclick="fontSizeTag()">font size</button>
                        <button class="tags" type="button" onclick="h1Tag()">h1</button>
                        <button class="tags" type="button" onclick="h2Tag()">h2</button>
                        <button class="tags" type="button" onclick="h3Tag()">h3</button>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button id="submit" name="comment" onclick="comment()">Comment</button>
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