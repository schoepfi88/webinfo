<?php
	include('parseHtml.php');
	include('db.php');

    @$foo="Create";
    $change = false;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
    $usr = "";
    $subj ="";
    $keyw ="";
    $cont ="";


    if(@$_GET['action'] == 'change') {
        $change = true;
        $sql =  "SELECT entry_id, reporter, subject, content, keyword, created_at FROM entry WHERE entry_id = ".$_GET['index'];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        $usr = $row["reporter"];
        $subj =$row["subject"];
        $keyw =$row["keyword"];
        $cont =$row["content"];
        $foo ="Change";
    }


    if (isset($_POST['submit'])){
		$reporter=$_POST['username'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
        $keyword=$_POST['keyword'];
		$session_id = session_id();

		// replace < and > in reporter and subject
		$reporter = eliminateHtml($reporter);
		$subject = eliminateHtml($subject);
        $keyword = eliminateHtml($keyword);
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
        if($change == false){
            if ($resultcheck->num_rows > 0){
                // priv must be greater than 6
                if ($rowcheck['priv'] > 6){
                    $sql = "INSERT INTO entry (session_id, reporter, subject, keyword, content) VALUES ('$session_id', '$reporter', '$subject', '$keyword', '$content')";
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
        }else{
            if ($resultcheck->num_rows > 0){
                // priv must be greater than 6
                if ($rowcheck['priv'] > 6){
                    $sql = "UPDATE entry SET session_id = '$session_id', reporter = '$reporter', subject = '$subject', keyword = '$keyword',content = '$content' WHERE entry_id= ".$_GET['index'];
                    if ($conn->query($sql) === TRUE)
                        $error = "Entry updated successfully";
                    $usr = "";
                    $subj = "";
                    $keyw = "";
                    $cont = "";
                } else {
                    $error = "Error: Entry not changed - Privileges are insufficient";
                }
            } else {
                $error = "Error: Entry not changed - Privileges are insufficient";
            }
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

    <body onload="hideFunctions()">
        <div id="menu">
            <ul id="menubar">
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
                            <input class="nameForm" name="username" placeholder="username" type="text" value="<?php echo $usr; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>
                            <input class="subjectForm" name="subject" placeholder="subject" type="text" value="<?php echo $subj; ?>">
                            <td>
                    </tr>
                    <tr>
                        <td>Keyword</td>
                        <td>
                            <input class="subjectForm" name="keyword" placeholder="keyword" type="text" value="<?php echo $keyw; ?>">
                            <td>
                    </tr>
                    <tr>
                        <td>Content</td>
                        <td>
                            <textarea id="textarea" name="content" placeholder="Type your text..." cols="50" rows="10" form="form1"><?php echo $cont;?></textarea>
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
                            <input id="submit" name="submit" type="submit" value="<?php echo $foo ?>">
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