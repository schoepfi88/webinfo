<?php
include('login.php');
?>
<!DOCTYPE html>
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
<table id="tableHead">
	<tr>
		<td id="reporter">Hermann Maier</td>
		<td id="subject">Training</td>
		<td id="time">13:12 pm</td>
  	</tr>
</table>
<table id="tableBody">
	<tr>
		<td>tesjafsldfj asdflj asdlfja sdlfj asasdfa sasdf asdf asdf ldfj asldfj </td>
  	</tr>
</table>
<br>

<table id="tableHead">
	<tr>
		<td id="reporter">Hermann Maier</td>
		<td id="subject">Training</td>
		<td id="time">13:12 pm</td>
  	</tr>
</table>
<table id="tableBody">
	<tr>
		<td> <?php echo session_id(); ?></td>
  	</tr>
</table>
</body>
</html>