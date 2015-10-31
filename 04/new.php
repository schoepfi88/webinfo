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
	if (isset($_POST['submit'])){
		$reporter=$_POST['username'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
		$session_id = session_id();

		// replace < and > in reporter and subject
		$reporter = eliminateHtml($reporter);
		$subject = eliminateHtml($subject);
		// parse content part
		$content = parseContent($content);
        // check if privileges are correct
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
            // priv must be greater than 6
            if ($rowcheck['priv'] > 6){
            	$sql = "INSERT INTO entry (session_id, reporter, subject, content) VALUES ('$session_id', '$reporter', '$subject', '$content')";
        		if ($conn->query($sql) === TRUE) {
        			$error = "New entry created successfully";
        		} else {
        			$error = "Error: " . $sql . "<br>" . $conn->error;
        		}
            } else {
                $error = "Error: Entry not created - Privileges are insufficient";
            }
        } else {
            $error = "Error: Entry not created - Privileges are insufficient";
        }
	}
	$conn->close();
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>My Blog</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="/css/theme.css">
        <script language="javascript" type="text/javascript" src="/script/control.js"></script>
    </head>

    <body>
        <div id="menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/api/entry/create">Create Entry</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/login.html">Login</a></li>
            </ul>
        </div>

        <h1 class="header1">Create Entry</h1>
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
                            <input id="submit" name="submit" type="submit" value="Create">
                            <a id="back" href="/">Back</a>
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