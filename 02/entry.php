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

$var = $GET['var'];
$sql = "SELECT reporter, subject, 
            content,created_at FROM entry WHERE  entry_id='$var'";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    //echo"es is grosser als 0";
}
    $row = $result->fetch_assoc()
    echo "<table class=\"tableHead\">";
    echo "<tr>";
    echo "<td class=\"reporter\">".$row["reporter"]."</td>";
    echo "<td class=\"subject\">".$row["subject"]."</td>";
    echo "<td class=\"time\">".$row["created_at"]."</td>";
    echo "</tr>";
    echo"</table>";
    echo"<table class=\"tableBody\">";
    echo"<tr>";
    echo"<td>".$row["content"]."</td>";
    echo"</table>";
    echo "<p>";


$conn->close();
    ?>


            </table>
    </body>

    </html>