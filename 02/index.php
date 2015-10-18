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

        $sql = "SELECT reporter, subject, 
            content FROM entry WHERE  session_id='$session_id'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
        //echo"es is grosser als 0";
        }
            while($row = $result->fetch_assoc()){
                echo "<table class=\"tableHead\">";
                echo "<tr>";
                echo "<td class=\"reporter\">".$row["reporter"]."</td>";
                echo "<td class=\"subject\">".$row["subject"]."</td>";
                echo "<td class=\"time\">13:12 pm </td>";
                echo "</tr>";
                echo"</table>";
                echo"<table class=\"tableBody\">";
                echo"<tr>";
                echo"<td>".$row["content"]."</td>";
                echo"</table>";
                echo "<p>";
        
            }
        $conn->close();
        ?>

            <!--
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
-->
            <tr>
                <td>
                    <?php echo session_id(); ?>
                </td>
            </tr>
            </table>
    </body>

    </html>